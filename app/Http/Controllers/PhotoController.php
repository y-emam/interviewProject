<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController
{

    public function index (Request $request) {
        $albumId = $request->query('albumId');

        return view('photos.create', ['albumId' => $albumId]); 
    }

    public function add(Request $request) {    
        $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'albumId' => 'required|uuid'
        ]);

        // Store each uploaded photo
        
        if ($request->file('img')) {
            $path = $request->file('img')->store('images', 'public');

            $filename = basename($path);

            Photo::create([
                'name' => $request->name,
                'path' => $filename,
                'album_id' => $request->albumId
            ]);

            return redirect()->route('albums', ['albumId' => $request['albumId']]);
        }

        return back()->with('error', 'Failed to upload image.');
        
    }

    public function delete(Request $request) {
        $request->validate([
            'id' => 'required|uuid',
        ]);

        $photoId = $request->id;

        $photo = Photo::where('id', $photoId)->get()->toArray()[0];

        // delete image from local files
        $filepath = 'public/images/'.$photo['path'];

        if (Storage::exists($filepath)) {
            Storage::delete($filepath);
        }

        // delete photos from database
        Photo::where('id', $photoId)->delete();

        return back()->with('success', 'Deleted Photo Successfully.');
    }
}