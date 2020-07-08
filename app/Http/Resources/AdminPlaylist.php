<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminPlaylist extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'likes' => $this->likes,
            'image' => $this->image_path,
            'description' => $this->description,
            'songs' => $this->songs()->count(),
            'category' => $this->category,
            'total_duration' => $this->uploadedSongs()->sum('duration'),
            'artist' => $this->artist,
        ];
    }
} // END OF RESOURCE
