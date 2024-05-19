<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $album['name'] }} Album</title>
    <style>
    </style>
</head>

<body>
    <div class="album-details">
        <h1>{{ $album['name'] }}</h1>
    </div>

    <h2>Photos</h2>
    @if ($photos->count() > 0)
    <div class="photo-gallery">
        @foreach ($photos as $photo)
        <img src="{{ asset($photo->path) }}" alt="{{ $photo->name }}">
        @endforeach
    </div>
    @else
    <p>No photos found for this album.</p>
    @endif
    <a href="{{ route('photos.create.get', ['albumId' => $album['id']]) }}">Add an Image</a>
    <!-- add a button on every image to be able to delete it -->
    <!-- add a button to delete the whole album with all images -->
    <!-- add a button to delete the whole album but move photos to another album -->
</body>

</html>