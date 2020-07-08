<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SongLike as ResourcesSongLike;
use App\Playlist;
use App\Song;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function index()
    {
        return response()->json([
            'songs' => ResourcesSongLike::collection(Auth::user()->songLikes()->with('playlist')->get()),
            'playlists' => Auth::user()->playlistLikes()->get()
        ]);
    }


    public function likeSong(Song $song)
    {
        $exists = Auth::user()->songLikes()->where('song_id', $song->id)->exists();
        if ($exists) {
            Auth::user()->songLikes()->detach($song->id);
            $song->update(['likes' => $song->likes - 1]);
            return response()->json([
                'status' => 200,
                'message' => 'Song unliked !',
                'song' => new ResourcesSongLike($song)
            ], 200);
        }
        Auth::user()->songLikes()->attach($song->id);
        $song->update(['likes' => $song->likes + 1]);
        return response()->json([
            'status' => 200,
            'message' => 'Song liked !',
            'song' => new ResourcesSongLike($song)
        ]);
    }

    public function likePlaylist(Playlist $playlist)
    {
        $exists = Auth::user()->playlistLikes()->where('playlist_id', $playlist->id)->exists();
        if ($exists) {
            Auth::user()->playlistLikes()->detach($playlist->id);
            $playlist->update(['likes' => $playlist->likes - 1]);
            return response()->json([
                'status' => 200,
                'message' => 'Playlist unliked !',
                'playlist' => $playlist
            ], 200);
        }
        Auth::user()->playlistLikes()->attach($playlist->id);
        $playlist->update(['likes' => $playlist->likes + 1]);
        return response()->json([
            'status' => 200,
            'message' => 'Playlist liked !',
            'playlist' => $playlist
        ]);
    }
} // END OF CONTROLLER
