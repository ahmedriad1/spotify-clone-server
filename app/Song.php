<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }
} // END OF MODEL
