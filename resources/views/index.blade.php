<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albums</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Albums</h1>
        <div class="row">
            @foreach ($albums as $album)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $album->cover_image }}" class="card-img-top" alt="{{ $album->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $album->title }}</h5>
                        <p class="card-text">{{ $album->artist }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>

</html>