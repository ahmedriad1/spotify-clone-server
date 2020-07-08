<?php

namespace App\Http\Controllers\api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminPlaylist;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\Playlist as PlaylistResource;
use App\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class PlaylistController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'show']);
    }


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

    public function adminIndex()
    {
        return AdminPlaylist::collection(Playlist::latest()->paginate());
    }

    public function create()
    {
        return response()->json([
            'categories' => Category::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|dimensions:ratio=0/0',
            'artist' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);
        $imageName = $request->file('image')->hashName();
        Image::make($request->file('image'))
            ->resize(300, 300)
            ->encode('jpg')
            ->save(storage_path('app/public/playlists/' . $imageName));
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName,
            'artist' => $request->artist,
            'category_id' => $request->category_id
        ];
        Playlist::create($data);
        return response()->json([
            'status' => 200,
            'message' => 'Playlist created successfully !'
        ]);
    }

    public function edit(Playlist $playlist)
    {
        return response()->json([
            'categories' => Category::latest()->get(),
            'playlist' => new AdminPlaylist($playlist),
        ]);
    }

    public function update(Request $request, Playlist $playlist)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'artist' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'artist' => $request->artist,
            'category_id' => $request->category_id
        ];
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|dimensions:ratio=0/0',
            ]);
            Storage::disk('public')->delete('playlists/' . $playlist->image);
            $imageName = $request->file('image')->hashName();
            Image::make($request->file('image'))
                ->resize(300, 300)
                ->encode('jpg')
                ->save(storage_path('app/public/playlists/' . $imageName));
            $data['image'] = $imageName;
        }

        $playlist->update($data);
        return response()->json([
            'status' => 200,
            'message' => 'Playlist updated successfully !'
        ]);
    }

    public function delete(Playlist $playlist)
    {
        Storage::disk('public')->delete('playlists/' . $playlist->image);
        $playlist->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Playlist deleted successfully !'
        ]);
    }
} // END OF CONTROLLER
