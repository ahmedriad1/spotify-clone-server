<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        \App\User::create([
            'name' => 'Admin',
            'email' => 'admin@app.com',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);
    }
} // END OF SEEDER
