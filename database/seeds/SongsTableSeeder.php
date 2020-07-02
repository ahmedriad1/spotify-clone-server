<?php

use App\Jobs\StreamSong;
use Illuminate\Database\Seeder;

class SongsTableSeeder extends Seeder
{
    public function run()
    {
        $song = \App\Playlist::find(1)->songs()->create([
            'name' => 'test song',
            'song_path' => 'zedd.mp3',
        ]);
        dispatch(new StreamSong($song));

        $song = \App\Playlist::find(1)->songs()->create([
            'name' => 'test song 2',
            'song_path' => 'bnow.mp3',
            'artist' => 'test artist 1 feat. test 2'
        ]);
        dispatch(new StreamSong($song));
    }
} // END OF SEEDER
