<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaylistController extends Controller
{
    public function index(Request $request)
    {
    }

    public function show(Playlist $playlist)
    {
    }

    public function create(Request $request)
    {
    }

    public function store(Request $request)
    {
    }

    public function edit(Playlist $playlist)
    {
    }

    public function update(Request $request, Playlist $playlist)
    {
    }

    public function delete(Playlist $playlist)
    {
        Storage::disk('public')->delete('playlists/' . $playlist->image);
        $playlist->delete();
    }
} // END OF CONTROLLER
