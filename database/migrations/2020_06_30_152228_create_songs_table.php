<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('duration');
            $table->text('song_path');
            $table->foreignId('playlist_id');
            $table->float('upload_duration');
            $table->bigInteger('likes');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('songs');
    }
} // END OF MIGRATION
