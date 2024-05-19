<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albums</title>

    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 800px;
        margin: auto;
    }

    h1 {
        color: #333;
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        background-color: #fff;
        margin-bottom: 10px;
        padding: 15px;
        border: 1px solid #ddd;
        /* Add border around each album item */
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    li:hover {
        background-color: #f0f0f0;
    }

    .album-list li a {
        color: #333;
        text-decoration: none;
        font-weight: bold;
    }

    .album-list li a:hover {
        text-decoration: underline;
    }

    /* Album details styles */
    .album-details {
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .album-details h2 {
        margin-top: 0;
    }

    a {
        text-decoration: none;
        color: #333;
        transition: color 0.3s ease;
    }

    a:hover {
        color: #007bff;
    }
    </style>
</head>

<body>
    <h1>Albums</h1>

    @if ($albums->count() > 0)
    <ul>
        @foreach ($albums as $album)
        <a href="{{ route('albums', ['albumId' => $album->id]) }}">
            <li>{{ $album->name }}</li>
        </a>

        @endforeach
    </ul>
    @else
    <p>No albums found.</p>
    @endif
</body>

</html>