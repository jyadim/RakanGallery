<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite('resources/css/app.css')

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albums</title>
</head>
<body>
    <x-navbar></x-navbar>
   <!-- In your Blade View -->
<h1>{{ $album->album_title }}'s Photos</h1>

<!-- Display album title -->
<h1>{{ $album->album_title }}'s Photos</h1>

<!-- Display message if no photos found -->
@if (session('message'))
    <p>{{ session('message') }}</p>
@endif

<!-- Display photos if they exist -->
@if ($photos && !$photos->isEmpty())
    <div class="grid grid-cols-3 gap-4">
        @foreach ($photos as $photo)
            <div class="photo-card">
                <img src="{{ $photo->image_url }}" alt="{{ $photo->title }}">
                <p>{{ $photo->title }}</p>
            </div>
        @endforeach
    </div>
@else
    <p>No photos available for this album.</p>
@endif

</body>
</html>
