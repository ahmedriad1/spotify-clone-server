<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistsTable extends Migration
{
    public function up()
    {
        Schema::create('playlists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('artist');
            $table->text('description');
            $table->text('image');
            $table->bigInteger('likes')->default(0);
            $table->foreignId('category_id');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('playlists');
    }
} // END OF MIGRATION
