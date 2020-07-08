<?php

use Illuminate\Database\Seeder;
use Intervention\Image\Facades\Image;

class PlaylistsTableSeeder extends Seeder
{
    public function run()
    {
        $original_name = '1.jpg';
        $exploded_name = explode('.', $original_name);
        $name = hash('sha256', $exploded_name[0] . strval(time())) . '.' . $exploded_name[count($exploded_name) - 1];
        $image = Image::make(storage_path('app/public/defaults/' . $original_name))
            ->resize(300, 300)
            ->encode('jpg')
            ->save(storage_path('app/public/playlists/' . $name));
        \App\Category::find(1)->playlists()->create([
            'name' => 'Test',
            'description' => 'this is a test',
            'image' => $name,
            'artist' => 'test artist'
        ]);

        $original_name = '1.jpg';
        $exploded_name = explode('.', $original_name);
        $name = hash('sha256', $exploded_name[0] . strval(time())) . '.' . $exploded_name[count($exploded_name) - 1];
        $image = Image::make(storage_path('app/public/defaults/' . $original_name))
            ->resize(300, 300)
            ->encode('jpg')
            ->save(storage_path('app/public/playlists/' . $name));
        \App\Category::find(1)->playlists()->create([
            'name' => 'Test 2',
            'description' => 'this is a test',
            'image' => $name,
            'artist' => 'test artist 2'
        ]);
    }
}
