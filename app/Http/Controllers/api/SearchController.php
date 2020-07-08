<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Song as ResourcesSong;
use App\Http\Resources\SongCollection;
use App\Http\Resources\SongLike;
use App\Playlist;
use App\Song;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $songs = Song::orderBy('likes', 'DESC')->when($request->q, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->q . '%')
                ->orWhere('artist', 'like', '%' . $request->q . '%');
        })->with('playlist')->limit(4)->get();

        $playlists = Playlist::orderBy('likes', 'DESC')->when($request->q, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->q . '%')
                ->orWhere('description', 'like', '%' . $request->q . '%')
                ->orWhere('artist', 'like', '%' . $request->q . '%');
        })->limit(7)->get();
        return response()->json([
            'songs' => SongLike::collection($songs),
            'playlists' => $playlists,
        ]);
    }

    public function indexSongs(Request $request)
    {
        $songs = Song::orderBy('likes', 'DESC')->with('playlist')
            ->when($request->q, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->q . '%')
                    ->orWhere('artist', 'like', '%' . $request->q . '%');
            })->paginate();
        return response()->json($songs);
    }

    public function indexPlaylists(Request $request)
    {
        $playlists = Playlist::orderBy('likes', 'DESC')
            ->when($request->q, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->q . '%')
                    ->orWhere('description', 'like', '%' . $request->q . '%')
                    ->orWhere('artist', 'like', '%' . $request->q . '%');
            })->paginate();
        return response()->json($playlists);
    }
}
