<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PlaylistsTableSeeder extends Seeder
{
    public function run()
    {
        $original_name = '1.jpg';
        $name = hash('sha256', $original_name . strval(time()));
        $image = Image::make('https://i.scdn.co/image/ab67706f000000021333364f5d4af194c49a69ed')
            ->resize(300, 300)
            ->save(public_path('storage\playlists\\' . $name . '.jpg'));
        \App\Category::find(1)->playlists()->create([
            'name' => 'Test',
            'description' => 'this is a test',
            'image' => $name,
        ]);
    }
}
