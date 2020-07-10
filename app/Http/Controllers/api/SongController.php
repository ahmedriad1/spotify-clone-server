<?php

namespace App\Http\Controllers\api;

use App\Song;
use App\Jobs\StreamSong;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\Song as ResourcesSong;
use App\Http\Resources\SongLike;
use App\SongLike as AppSongLike;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return SongLike::collection(Song::latest()->with('playlist')->paginate());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'song' => 'required|mimes:mpga',
            'playlist_id' => ['required', Rule::exists('playlists', 'id')],
        ]);
        $songName = $request->file('song')->hashName();
        $request->file('song')->storeAs('public/songs', $songName);
        $data = [
            'name' => $request->name,
            'song_path' => $songName,
            'playlist_id' => $request->playlist_id
        ];
        if ($request->artist) $data['artist'] = $request->artist;
        $song = Song::create($data);
        dispatch(new StreamSong($song));
        return response()->json([
            'status' => 200,
            'message' => 'Song created successfully !'
        ]);
    }


    public function show(Song $song)
    {
        //
    }


    public function edit(Song $song)
    {
        return new SongLike($song);
    }


    public function update(Request $request, Song $song)
    {
        $request->validate([
            'name' => 'required',
            'playlist_id' => ['required', Rule::exists('playlists', 'id')],
        ]);
        $data = [
            'name' => $request->name,
            'playlist_id' => $request->playlist_id,
            'artist' => $request->artist
        ];
        if ($request->hasFile('song')) {
            $request->validate(['song' => 'required|mimes:mpga']);
            Storage::disk('public')->delete('songs/' . $song->song_path);
            $songName = $request->file('song')->hashName();
            $request->file('song')->storeAs('public/songs', $songName);
            $data['song_path'] = $songName;
        }
        $song->update($data);
        if ($request->hasFile('song')) dispatch(new StreamSong($song));
        return response()->json([
            'status' => 200,
            'message' => 'Song updated successfully !'
        ]);
    }

    public function destroy(Song $song)
    {
        Storage::disk('public')->delete('songs/' . $song->song_path);
        AppSongLike::where('song_id', $song->id)->delete();
        $song->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Song deleted successfully !'
        ]);
    }
} // END OF CONTROLLER
