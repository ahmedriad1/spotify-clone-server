<?php

namespace App\Http\Controllers\api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\Playlist as PlaylistResource;
use App\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaylistController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            new CategoryCollection(
                Category::latest()->with(['playlists' => function ($query) {
                    return $query->limit(6);
                }])->paginate()
            ),
        );
    }

    public function show(Playlist $playlist)
    {
        return new PlaylistResource($playlist);
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
