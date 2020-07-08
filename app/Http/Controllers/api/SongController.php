<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Jobs\StreamSong;
use App\Song;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SongController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        //
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
            'playlist_id' => ['required', Rule::exists('playlists', 'id')]
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
        //
    }


    public function update(Request $request, Song $song)
    {
        //
    }

    public function destroy(Song $song)
    {
        //
    }
} // END OF CONTROLLER
