<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $guarded = [];
    protected $hidden = ['image'];
    protected $appends = ['image_path'];

    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function uploadedSongs()
    {
        return $this->songs()->where('upload_percent', '>=', 100);
    }

    public function getImagePathAttribute()
    {
        return url('/storage/playlists/' . $this->image);
    }

    public function getSongsAttribute()
    {
        return $this->songs()->where('upload_percent', '>=', 100);
    }
}
