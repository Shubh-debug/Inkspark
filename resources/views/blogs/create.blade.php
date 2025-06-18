<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog</title>
</head>
<body>
    <h1>Create New Blog</h1>

    <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="name" placeholder="Title" value="{{ old('name') }}" required><br>
        @error('name') <p style="color: red;">{{ $message }}</p> @enderror
        <br>

        <input type="text" name="short_description" placeholder="Short Description" value="{{ old('short_description') }}"><br>
        @error('short_description') <p style="color: red;">{{ $message }}</p> @enderror
        <br>

        <textarea name="description" placeholder="Full Blog Content">{{ old('description') }}</textarea><br>
        @error('description') <p style="color: red;">{{ $message }}</p> @enderror
        <br>

        <input type="text" name="author" placeholder="Author" value="{{ old('author') }}"><br>
        @error('author') <p style="color: red;">{{ $message }}</p> @enderror
        <br>

        <input type="text" name="category" placeholder="Category" value="{{ old('category') }}"><br>
        @error('category') <p style="color: red;">{{ $message }}</p> @enderror
        <br>

        <input type="file" name="featured_images"><br>
        @error('featured_images') <p style="color: red;">{{ $message }}</p> @enderror
        <br>

        <button type="submit">Create Blog</button>
    </form>
</body>
</html>
