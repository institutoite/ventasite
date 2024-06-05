<!DOCTYPE html>
<html>
<head>
    <title>Upload Profile Images</title>
</head>
<body>
    <form action="{{ route('guardarProducto') }}" method="post" enctype="multipart/form-data">
        @csrf
        @foreach (session('users', []) as $index => $user)
            <div>
                <label for="profile_image_{{ $index }}">Upload image for {{ $user['name'] }}</label>
                <input type="file" name="profile_images[{{ $index }}]" id="profile_image_{{ $index }}" required>
            </div>
        @endforeach
        <button type="submit">Upload Images</button>
    </form>
</body>
</html>