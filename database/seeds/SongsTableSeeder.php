<?php

use Illuminate\Database\Seeder;

class SongsTableSeeder extends Seeder
{
    public function run()
    {
        \App\Playlist::find(1)->songs()->create([
            'name' => 'test song',
            'duration' => 100,
            'song_path' => 'zedd.mp3',
        ]);

        \App\Playlist::find(1)->songs()->create([
            'name' => 'test song 2',
            'duration' => 331,
            'song_path' => 'bnow.mp3',
        ]);
    }
} // END OF SEEDER
