<?php

use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Route;


Route::get('/albums', [AlbumController::class, 'index'])->name('albums'); // shows all albums
Route::get('/albums/create', function () { return view('albums.create'); })->name('albums.create.get'); // a form to create new album
// Route::get('/edit',)

Route::post('/albums/create', [AlbumController::class, 'create'])->name('albums.create.post'); // creates new album


// Route::delete('/delete/photo', ); // deletes a photo from an album
// Route::delete('/deleteAllAlbum', );
// Route::delete('/deleteOnlyAlbum', );