<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
            'id'                => $this->id,
            'title'             => $this->title,
            'abbreviation'      => $this->abbreviation,
            'description'       => $this->description,
            'image'             => $this->image,
            'url'               => $this->url,
            'public_date'       => $this->public_date,
            'meta_title'        => $this->meta_title,
            'meta_keywords'     => $this->meta_keywords,
            'meta_description'  => $this->meta_description,
            'publish_tg'        => $this->publish_tg,
            'status'            => $this->status,
        ];
    }
}
