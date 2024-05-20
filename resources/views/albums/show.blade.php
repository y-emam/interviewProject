<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $album['name'] }} Album</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 900px;
        margin: 20px auto;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .album-details {
        text-align: center;
        margin-bottom: 20px;
    }

    .album-details h1 {
        font-size: 2.5em;
        margin: 0;
    }

    h2 {
        font-size: 1.8em;
        margin-bottom: 10px;
        color: #333;
    }

    .photo-gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .photo-gallery img {
        max-width: 700px;
        max-height: 700px;
        object-fit: cover;
        border-radius: 4px;
    }

    .add-image-link,
    .delete-button {
        display: inline-block;
        padding: 10px 20px;
        margin: 10px 0;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        cursor: pointer;
    }

    .delete-button {
        background-color: #dc3545;
        color: #fff;
    }

    .add-image-link:hover,
    .delete-button:hover {
        background-color: #0056b3;
    }

    .delete-button:hover {
        background-color: #c82333;
    }

    .form-control,
    .dropdown {
        padding: 10px;
        width: 100%;
        max-width: 300px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    form {
        margin-bottom: 20px;
    }

    p {
        font-size: 1.2em;
        color: #666;
    }

    .delete-button-small {
        display: block;
        margin-top: 5px;
        padding: 5px 10px;
        font-size: 0.8em;
        background-color: #dc3545;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        color: white
    }

    .delete-button-small:hover {
        background-color: #c82333;
    }

    .photo-container {
        position: relative;
    }

    .photo-container img {
        display: block;
    }

    .photo-container form {
        position: absolute;
        top: 5px;
        right: 5px;
    }

    a.back-link {
        display: inline-block;
        margin-bottom: 20px;
        color: #007bff;
        text-decoration: none;
    }

    a.back-link:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="album-details">
            <h1>{{ $album['name'] }}</h1>
        </div>

        <a href="{{ route("albums") }}" class="back-link">Back</a>

        <h2>Photos</h2>
        @if ($photos->count() > 0)
        <div class="photo-gallery">
            @foreach ($photos as $photo)
            <div class="photo-container">
                <img src="{{ asset('storage/images/' . $photo->path) }}" alt="{{ $photo->name }}">
                <form action="{{ route('photos.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $photo->id }}">
                    <button type="submit" class="delete-button-small">Delete</button>
                </form>
            </div>
            @endforeach
        </div>
        @else
        <p>No photos found for this album.</p>
        @endif
        <a href="{{ route('photos.create.get', ['albumId' => $album['id']]) }}" class="add-image-link">Add an Image</a>

        <form action="{{ route('albums.all.delete') }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="albumId" value="{{ $album['id'] }}">
            <button type="submit" class="delete-button">Delete Album and Photos</button>
        </form>

        <form action="{{ route('albums.only.delete') }}" method="POST">
            @csrf
            @method('DELETE')
            <select name="newAlbumId" class="dropdown">
                @foreach ($allAlbums as $albumItr)
                @if ($albumItr->id != $album['id'])
                <option value="{{ $albumItr->id }}">{{ $albumItr->name }}</option>
                @endif
                @endforeach
            </select>
            <input type="hidden" name="oldAlbumId" value="{{ $album['id'] }}">
            <button type="submit" class="delete-button">Delete Album and Move Photos</button>
        </form>
        <!-- add a button on every image to be able to delete it -->
    </div>
</body>

</html>