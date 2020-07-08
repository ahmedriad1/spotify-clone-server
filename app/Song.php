<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $guarded = [];
    protected $hidden = ['pivot', 'song_path'];
    protected $appends = ['song'];

    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'song_likes');
    }

    public function getSongAttribute()
    {
        return url('/storage/songs/' . $this->song_path);
    }
} // END OF MODEL
