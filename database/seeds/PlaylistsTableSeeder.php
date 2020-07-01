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
        $exploded_name = explode('.', $original_name);
        $name = hash('sha256', $exploded_name[0] . strval(time()));
        $image = Image::make(storage_path('app/public/defaults/' . $original_name))
            ->resize(300, 300)
            ->save(storage_path('app/public/playlists/' . $name . '.' . $exploded_name[count($exploded_name) - 1]));
        \App\Category::find(1)->playlists()->create([
            'name' => 'Test',
            'description' => 'this is a test',
            'image' => $name,
        ]);

        $original_name = '1.jpg';
        $exploded_name = explode('.', $original_name);
        $name = hash('sha256', $exploded_name[0] . strval(time()));
        $image = Image::make(storage_path('app/public/defaults/' . $original_name))
            ->resize(300, 300)
            ->save(storage_path('app/public/playlists/' . $name . '.' . $exploded_name[count($exploded_name) - 1]));
        \App\Category::find(1)->playlists()->create([
            'name' => 'Test',
            'description' => 'this is a test',
            'image' => $name,
        ]);
    }
}
