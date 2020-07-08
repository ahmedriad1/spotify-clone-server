<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaylistLike extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }
} // END OF MODEL
