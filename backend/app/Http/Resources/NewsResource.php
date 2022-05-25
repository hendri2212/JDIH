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
            'slug' => $this->slug,
            'title' => $this->title,
            'content' => $this->content,
            'author' => new AuthorResource($this->author)
        ];
    }
}
