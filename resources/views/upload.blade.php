DOCTYPE html
html lang "en"

<head>
    <meta charset='UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Upload</h1>
    <form method="POST" action="/upload" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image">
        <input type="submit" name="Upload">
    </form>
    </hr>
    <ul>
        @foreach ($photos as photo)
        <li>{{ $photo->name }}<img src="{{ asset('storage/images/', $photo->name)}"</li>
        @endforeach
    </ul>
    </body>

    </html>