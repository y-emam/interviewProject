<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $album['name'] }} Album</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .album-details {
        background-color: #fff;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .album-details h1 {
        margin: 0;
        color: #333;
    }

    .photo-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .photo-gallery img {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .add-image-link {
        display: inline-block;
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 20px;
    }

    .add-image-link:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="album-details">
            <h1>{{ $album['name'] }}</h1>
        </div>

        <h2>Photos</h2>
        @if ($photos->count() > 0)
        <div class="photo-gallery">
            @foreach ($photos as $photo)
            <img src="{{ asset('storage/images/' . $photo->path) }}" alt="{{ $photo->name }}">
            @endforeach
        </div>
        @else
        <p>No photos found for this album.</p>
        @endif
        <a href="{{ route('photos.create.get', ['albumId' => $album['id']]) }}" class="add-image-link">Add an Image</a>
        <!-- add a button on every image to be able to delete it -->
        <!-- add a button to delete the whole album with all images -->
        <form action="{{ route('albums.all.delete') }}" method="POST">
            @csrf
            <input type="hidden" name="albumId" id="albumId" class="form-control" value='{{$album['id']}}'>
            @method('DELETE')
            <button type="submit" class="delete-button">Delete Album and Photos</button>
        </form>
        <!-- add a button to delete the whole album but move photos to another album -->
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
            <input type="hidden" name="oldAlbumId" id="albumId" class="form-control" value='{{$album['id']}}'>
            <button type="submit" class="delete-button">Delete Album and move Photos</button>
        </form>
    </div>
</body>

</html>