<!-- resources/views/albums/show.blade.php -->
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
    <h1>{{ $album['name'] }}</h1>

    <h2>Photos</h2>
    @if ($album['photos']->count() > 0)
    <div class="photo-gallery">
        @foreach ($album['photos'] as $photo)
        <img src="{{ asset($photo->image_path) }}" alt="{{ $photo->title }}">
        @endforeach
    </div>
    @else
    <p>No photos found for this album.</p>
    @endif
</body>

</html>