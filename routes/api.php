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

Route::get('/file', function () {
    // $file = Storage::disk('local')->get('public/playlists/' . $filename);
    // $type = $file->mime_content_type;
    // $res = Response::make($file, 200);
    // $res->header("Content-Type", $type);
    $name = hash('sha256', 'public\defaults\1.jpg' . strval(time()));
    return strval(time());

    // if (!FacadesFile::exists($path)) {
    //     abort(404);
    // }

    // $file = FacadesFile::get($path);
    // $type = FacadesFile::mimeType($path);

    // $response = Response::make($file, 200);
    // $response->header("Content-Type", $type);

    // return $response;
});
