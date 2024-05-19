<?php

use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AlbumController::class, 'index']); // shows all albums
Route::get('/album/:id'); // show all photos in an album, todo: know how to make query parameter
// Route::get('/create', ); // a form to create new album
// Route::get('/edit',)

// Route::post('/create', ); // creates new album


// Route::delete('/delete/photo', ); // deletes a photo from an album
// Route::delete('/deleteAllAlbum', );
// Route::delete('/deleteOnlyAlbum', );