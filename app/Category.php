<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }
} // END OF MODEL
