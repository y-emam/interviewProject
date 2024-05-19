<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AlbumController extends Controller
{

    public function index() {
        $allAlbums = Album::all();

        return view('index', ['albums' => $allAlbums]);
    }

    public function create(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new album
        Album::create([
            'name' => $request->name,
        ]);
        

        // Redirect back to the create form with a success message
        return redirect()->route('albums')->with('success', 'Album created successfully.');
    }
}