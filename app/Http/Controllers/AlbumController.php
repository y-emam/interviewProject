<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Routing\Controller;

class AlbumController extends Controller
{
    public function index() {
        $allAlbums = Album::all();

        return view('index', ['albums' => $allAlbums]);
    }
}