<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $guarded = [];
    // protected $hidden = ['song_path'];
    // protected $appends = ['song_path'];

    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }

    // public function getSongPathAttribute()
    // {
    //     return url('/storage/songs/' . $this->song_path);
    // }
} // END OF MODEL
