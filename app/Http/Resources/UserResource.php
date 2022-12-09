<?php

namespace App\Http\Resources;

use App\Http\Resources\RoleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'surname'       => $this->surname,
            'name'          => $this->name,
            'patronymic'    => $this->patronymic,
            'phone'         => $this->phone,
            'email'         => $this->email,
            'avatar'        => $this->avatar,
            'role'          => new RoleResource($this->role),
        ];
    }
}
