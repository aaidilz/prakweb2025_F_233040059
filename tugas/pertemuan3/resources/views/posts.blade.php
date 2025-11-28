<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Daftar Posts</title>
</head>

<body>
    <h1>Daftar Posts</h1>

    @foreach ($posts as $post)
        <article>
            @if($post->image_path)
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" style="max-width: 100%; height: auto;">
            @endif
            <h2><a href="/posts/{{ $post->slug }}">{{ $post->title }}</a></h2>
            <p>{{ $post->excerpt }}</p>
        </article>
    @endforeach
</body>

</html>
