<?php

use Illuminate\Support\Facades\Route;

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
    Route::get('/{playlist:id}', 'PlaylistController@show');
});
