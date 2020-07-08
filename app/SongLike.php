<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SongLike extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function song()
    {
        return $this->belongsTo(Song::class);
    }
} // END OF MODEL
