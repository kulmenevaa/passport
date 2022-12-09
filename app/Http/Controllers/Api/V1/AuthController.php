<?php

namespace App\Http\Controllers\Api\V1;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\RecoveryPasswordRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request) 
    {
        $userByEmail = User::where('email', $request->email)->first();

        if(!$userByEmail) {
            return response()->json([
                'message' => 'This email was not found'
            ], 401);
        } 

        if(!Hash::check($request->password, $userByEmail->password)) {
            return response()->json([
                'message' => 'This password was not found'
            ], 401);
        }

        if(Auth::attempt($request->only(['email', 'password']))) {
            $user = $request->user();
            $permissions = $this->setPermissions($user->role->name);
            $tokenData = $user->createToken($user->email.'-'.Carbon::now(), $permissions);
            $token = $tokenData->token;
            
            if($request->remember_me) {
                $token->expires_at = Carbon::now()->addWeeks(1);
            }
            
            if($token->save()) {
                return response()->json([
                    'message' => 'good',
                    'user' => new UserResource($user),
                    'access_token' => $tokenData->accessToken,
                    'token_type' => 'Bearer',
                    'token_scope' => $token->scopes,
                    'expires_at' => Carbon::parse($user->expires_at)->toDateTimeString()
                ], 200);
            } 
            return response()->json([
                'message' => 'Internal Server Error'
            ], 500);
        }
    }

    public function recoveryPassword(RecoveryPasswordRequest $request) 
    {
        $user = User::where('email', $request->email)->first();
        if(!$user) {
            return response()->json([
                'message' => 'bad'
            ], 401);
        }

        $random = rand(000000, 999999);
        $user->verification_code = $random;
        if($user->save()) {
            Mail::to($request->email, $request->name)->send(new ResetPasswordMail([
                'email' => $user->email,
                'name' => $user->name,
                'random' => $random,
            ]));
            if(!Mail::failures()) {
                return response()->json([
                    'message' => 'good'
                ], 200);
            }
        }
        return response()->json([
            'message' => 'Internal Server Error'
        ], 500);
    }

    public function resetPassword(ResetPasswordRequest $request) 
    {
        $userByEmail = User::where('email', $request->email)->first();
        if(!$userByEmail) {
            return response()->json([
                'message' => trans('auth.email')
            ], 401);
        } 

        $userByCode = User::where('verification_code', $request->verification_code)->first();
        if(!$userByCode) {
            return response()->json([
                'message' => 'Bad code'
            ], 401);
        }
        
        $user = User::where('email', $request->email)
                    ->where('verification_code', $request->verification_code)
                    ->first();
        $user->password = Hash::make($request->password);
        $user->verification_code = null;
        if($user->save()) {
            return response()->json([
                'message' => 'Password reset successful'
            ], 200);
        } 
        return response()->json([
            'message' => 'Internal Server Error'
        ], 500);
    }

    public function logout(Request $request) 
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'good'
        ], 200);
    }

    protected function setPermissions($role) 
    {
        switch($role) {
            case 'admin':
                return ['party', 'moder', 'admin'];
                break;
            case 'moderator':
                return ['party', 'moder'];
                break;
            case 'participant':
                return ['party'];
                break;
        }
    }
}
