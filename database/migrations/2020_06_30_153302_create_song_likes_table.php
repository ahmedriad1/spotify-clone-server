<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongLikesTable extends Migration
{
    public function up()
    {
        Schema::create('song_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('song_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('song_likes');
    }
} // END OF MODEL
