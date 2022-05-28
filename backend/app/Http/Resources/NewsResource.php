<?php

namespace App\Http\Resources;

use App\Http\Resources\AuthorResource;

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
            'id' => $this->id_news,
            'slug' => $this->slug,
            'title' => $this->title,
            'photo' => $this->photo,
            'content' => $this->content,
            'author' => new AuthorResource($this->author),
            'created_at' => $this->created_at
        ];
    }
}
