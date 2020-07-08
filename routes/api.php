<?php

use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;

Route::prefix('auth')->group(function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::put('/updateUserDetails', 'AuthController@updateUserDetails');
    Route::put('/updateUserPassword', 'AuthController@updateUserPassword');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::post('/me', 'AuthController@me');
});

Route::prefix('playlists')->group(function () {
    Route::get('/', 'PlaylistController@index');
    Route::get('/admin', 'PlaylistController@adminIndex');
    Route::get('/create', 'PlaylistController@create');
    Route::post('/', 'PlaylistController@store');
    Route::get('/{playlist:id}', 'PlaylistController@show');
    Route::post('/{playlist:id}/edit', 'PlaylistController@edit');
    Route::put('/{playlist:id}', 'PlaylistController@update');
    Route::delete('/{playlist:id}', 'PlaylistController@delete');
});

Route::prefix('categories')->group(function () {
    Route::get('/', 'CategoryController@index');
    Route::post('/', 'CategoryController@store');
    Route::post('/{category:id}/edit', 'CategoryController@edit');
    Route::put('/{category:id}', 'CategoryController@update');
    Route::delete('/{category:id}', 'CategoryController@delete');
    Route::get('/{category:id}', 'CategoryController@show');
});

Route::get('images/{image}', function ($image) {
    $storagePath = storage_path('app/public/playlists/' . $image . '.jpg');
    try {
        return Image::make($storagePath)->response();
    } catch (\Throwable $th) {
        return Image::make(storage_path('app/public/playlists/' . $image . '.jpeg'))->response();
    }
});

Route::prefix('likes')->group(function () {
    Route::get('/', 'LikeController@index');
    Route::post('/songs/{song:id}', 'LikeController@likeSong');
    Route::post('/playlists/{playlist:id}', 'LikeController@likePlaylist');
});

Route::prefix('search')->group(function () {
    Route::get('/', 'SearchController@index');
    Route::get('/songs', 'SearchController@indexSongs');
    Route::get('/playlists', 'SearchController@indexPlaylists');
});

Route::prefix('songs')->group(function () {
    Route::post('/', 'SongController@store');
});

Route::get('/test', function () {
})->middleware(['auth', 'admin']);
