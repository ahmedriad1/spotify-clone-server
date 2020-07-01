<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Playlist extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'likes' => $this->likes,
            'image' => $this->image_path,
            'songs' => \App\Http\Resources\Song::collection($this->uploadedSongs),
            'category_id' => $this->category_id,
            'total_duration' => $this->uploadedSongs()->sum('duration')
        ];
    }
} // END OF RESOURCE
