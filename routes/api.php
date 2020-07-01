<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

Route::prefix('auth')->group(function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::put('/updateUserDetails', 'AuthController@updateUserDetails');
    Route::put('/updateUserPassword', 'AuthController@updateUserPassword');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::post('/me', 'AuthController@me');
});
