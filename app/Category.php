<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }
} // END OF MODEL
