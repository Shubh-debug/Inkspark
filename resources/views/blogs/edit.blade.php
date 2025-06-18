<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
</head>
<body>
    <h1>Edit Blog</h1>
    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ $blog->name }}" required><br><br>
    <input type="text" name="short_description" value="{{ $blog->short_description }}"><br><br>
    <textarea name="description">{{ $blog->description }}</textarea><br><br>
    <input type="text" name="author" value="{{ $blog->author }}"><br><br>
    <input type="text" name="category" value="{{ $blog->category }}"><br><br>

     @if($blog->featured_images)
        <p>Current Image:</p>
        <img src="{{ asset('storage/' . $blog->featured_images) }}" width="150"><br><br>
    @endif

    <input type="file" name="featured_images"><br><br>

    <button type="submit">Update Blog</button>
    </form>
</body>
</html>