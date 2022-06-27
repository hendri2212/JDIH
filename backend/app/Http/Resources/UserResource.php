<?php

namespace App\Http\Resources;

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
            'id' => $this->id_user,
            'name' => $this->name,
            'photo' => $this->photo,
            'username' => $this->username,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'fraction' => $this->fraction != null ? new FractionResource($this->fraction) : null
        ];
    }
}
