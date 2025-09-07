<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Posts Index Page</h1>
    @foreach($posts as $post)
        <div class="post-card">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->description }}</p>
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" style="max-width: 200px;">
            @endif
        </div>
    @endforeach
</body>
</html>