<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{

    public function index(Request $request) {
        if ($request->has('albumId')) {
            $albumId = $request->query('albumId');

            $album = Album::find($albumId)->attributesToArray();

            $photos = Photo::where('album_id', $albumId)->get();

            $allAlbums = Album::all();

            return view('albums.show', ['album' => $album, 'photos' => $photos, 'allAlbums' => $allAlbums]);
        }else {
            $allAlbums = Album::all();

            return view('index', ['albums' => $allAlbums]);
        }
        
    }

    public function create(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Album::create([
            'name' => $request->name,
        ]);
        

        return redirect()->route('albums')->with('success', 'Album created successfully.');
    }

    public function deleteAlbumAndPhotos(Request $request) {
        $request->validate([
            'albumId' => 'required|uuid',
        ]);
    
        $albumId = $request->albumId;
    
        $photosArr = Photo::where('album_id', $albumId)->get()->toArray();

        // delete images from local files
        foreach ($photosArr as $photo) {

            $filepath = 'public/images/'.$photo['path'];
            if (Storage::exists($filepath)) {
                Storage::delete($filepath);
            }
        }

        // delete photos from database
        Photo::where('album_id', $albumId)->delete();

        // delete Album from database
        Album::where('id', $albumId)->delete();

        return redirect()->route('albums')->with('success', 'Album created successfully.');
    }

    public function deleteOnlyAlbum(Request $request) {
        $request->validate([
            'oldAlbumId' => 'required|uuid',
            'newAlbumId' => 'required|uuid',
        ]);

        $oldAlbumId = $request->oldAlbumId;
        $newAlbumId = $request->newAlbumId;

        if ($oldAlbumId == $newAlbumId) {
            return back()->with('error', 'Failed to Delete Images.');
        }

        Photo::where('album_id', $oldAlbumId)->update(['album_id' => $newAlbumId]);

        Album::where('id', $oldAlbumId)->delete();

        return redirect()->route('albums')->with('success', 'Album created successfully.');
    }
}