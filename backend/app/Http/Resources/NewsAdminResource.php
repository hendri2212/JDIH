<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsAdminResource extends JsonResource
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
            'tags' => $this->tags,
            'title' => $this->title,
            'photo' => $this->photo,
            'bannerCoordinates' => $this->bannerCoordinates,
            'thumbnailCoordinates' => $this->thumbnailCoordinates,
            'content' => $this->content,
            'author' => new AuthorResource($this->author),
            'created_at' => $this->created_at
        ];
    }
}
