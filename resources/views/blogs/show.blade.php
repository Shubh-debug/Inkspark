<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->name }}</title>
</head>
<body>
    <h1>{{ $blog->name }}</h1>
    <p><strong>Short Description:</strong> {{ $blog->short_description }}</p>
    <p><strong>Full Content:</strong> {{ $blog->description }}</p>
    <p><strong>Author:</strong> {{ $blog->author }}</p>
    <p><strong>Category:</strong> {{ $blog->category }}</p>

    @if($blog->featured_images)
        <p>
            <img src="{{ asset('storage/' . $blog->featured_images) }}" alt="Image" style="max-width: 300px;">
        </p>
    @endif

    <a href="{{ route('blogs.index') }}">← Back to All Blogs</a>
    
</body>
</html>