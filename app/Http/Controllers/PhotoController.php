<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController
{

    public function index (Request $request) {
        $albumId = $request->query('albumId');

        return view('photos.create', ['albumId' => $albumId]); 
    }

    public function add(Request $request) {    
        $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'albumId' => 'required|uuid'
        ]);

        // Store each uploaded photo
        
        if ($request->file('img')) {
            $path = $request->file('img')->store('images', 'public');

            $filename = basename($path);

            // You can save the $path to the database if needed
            Photo::create([
                'name' => $request->name,
                'path' => $filename,
                'album_id' => $request->albumId
            ]);

            // return back()->with('success', 'Image uploaded successfully.')->with('image', $path);
            return redirect()->route('albums', ['albumId' => $request['albumId']]);
        }

        return back()->with('error', 'Failed to upload image.');
        
    }
}