<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistLikesTable extends Migration
{
    public function up()
    {
        Schema::create('playlist_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('playlist_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('playlist_likes');
    }
} // END OF MODEL
