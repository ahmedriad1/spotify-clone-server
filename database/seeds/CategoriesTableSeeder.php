<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        \App\Category::create([
            'name' => 'Focus',
            'description' => 'Music to help you concentrate'
        ]);

        \App\Category::create([
            'name' => 'Mood',
            'description' => 'Playlists to match your mood'
        ]);

        \App\Category::create([
            'name' => 'Soundtrack your home'
        ]);

        \App\Category::create([
            'name' => 'Kick back this Sunday...'
        ]);
    }
} // END OF SEEDER