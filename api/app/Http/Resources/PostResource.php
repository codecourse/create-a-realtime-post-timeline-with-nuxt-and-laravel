<?php

namespace App\Http\Resources;

use App\Http\Resources\PublicUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'user' => new PublicUserResource($this->user),
            'created_at' => $this->created_at
        ];
    }
}
