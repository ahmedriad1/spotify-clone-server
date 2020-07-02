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
            $table->string('artist')->nullable();
            $table->float('duration')->default(0);
            $table->text('song_path');
            $table->foreignId('playlist_id');
            $table->float('upload_percent')->default(0);
            $table->bigInteger('likes')->default(0);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('songs');
    }
} // END OF MIGRATION
