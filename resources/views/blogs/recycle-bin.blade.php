<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recycle Bin</title>
</head>
<body>
    <h1>Recycle Bin</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @foreach($deletedBlogs as $blog)
        <div style="border: 1px solid #ccc; padding: 10px; margin: 10px 0;">
            <h3>{{ $blog->name }}</h3>
            <p>{{ $blog->short_description }}</p>

            <p>
                <a href="{{ route('blogs.restore', $blog->id) }}">Restore</a> |
                <a href="{{ route('blogs.force-delete', $blog->id) }}" 
                   onclick="return confirm('Permanently delete? This cannot be undone!')"
                   style="color: red;">Permanently Delete</a>
            </p>
        </div>
    @endforeach

    {{ $deletedBlogs->links() }}
</body>
</html>