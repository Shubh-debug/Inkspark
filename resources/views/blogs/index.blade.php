<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inkspark</title>
    
</head>
<body>
    <h1>All Blogs</h1>
    <a href="{{ route('blogs.recycle-bin') }}" style="color: red;">Recycle Bin</a>
    <br><br>
    <a href="{{ route('blogs.create') }}">Create New Blog</a>
    @if(session('success'))
    <p style="color: green">{{ session('success')}}</p>
    @endif
    @foreach($blogs as $blog)
    <div style="border: 1px solid #ccc; padding: 10px; margin: 10px 0;">
        <h3>{{ $blog->name }}</h3>
        <p>{{ $blog->short_description }}</p>

        @if($blog->featured_images)
            <img src="{{ asset('storage/' . $blog->featured_images) }}" alt="Featured Image" style="max-width: 200px; max-height: 200px;">
        @endif
        
        <p>
            <a href="{{ route('blogs.show', $blog->slug) }}">View</a>
            <a href="{{route('blogs.edit', $blog->slug)}}">Edit</a>
            <form action="{{ route('blogs.destroy', $blog->slug) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this blog?')">Delete</button>
            </form>
            @if($blog->deleted_at)
             <a href="{{ route('blogs.restore', $blog->id) }}" style="color: green;">Restore</a>
            @endif
        </p>
    </div>
    @endforeach

    @auth
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
@endauth

    {{ $blogs->links() }} <!-- Pagination links -->
    <style>
     .w-5.h-5{
        width: 20px;
     }
    </style>
</body>
</html>
