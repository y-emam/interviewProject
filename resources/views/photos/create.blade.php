<!DOCTYPE html>
<html>

<head>
    <title>Add Photo</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 10px 20px;
        color: #fff;
        cursor: pointer;
        border-radius: 4px;
        text-align: center;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Add New Photo</h1>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="/photo/create" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Photo Name</label>
                <input type="text" name="name" id="name" class="form-control" required
                    placeholder="Enter the Photo Name">
                <label for="name">Photo</label>
                <input type="file" name="img" id="img" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Photo</button>
        </form>
    </div>
</body>

</html>