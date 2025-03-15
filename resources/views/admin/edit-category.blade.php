{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">

    <div class="bg-white p-6 rounded shadow w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4">Edit Kategori</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('category.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama_category" class="block font-semibold">Nama Kategori</label>
                <input type="text" id="nama_category" name="nama_category" value="{{ old('nama_category', $category->nama_category) }}" class="w-full p-2 border rounded">
                @error('nama_category')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
            <a href="{{ route('categories.index') }}" class="text-gray-600 ml-2">Kembali</a>
        </form>
    </div>

</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">

    <div class="bg-white p-6 rounded shadow w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4">Edit Kategori</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Input Nama Kategori -->
            <div class="mb-4">
                <label for="nama_category" class="block font-semibold">Nama Kategori</label>
                <input type="text" id="nama_category" name="nama_category" value="{{ old('nama_category', $category->nama_category) }}" class="w-full p-2 border rounded">
                @error('nama_category')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Menampilkan Gambar Saat Ini -->
            <div class="mb-4">
                <label class="block font-semibold">Gambar Saat Ini</label>
                @if($category->image)
                    <img src="{{ asset('images1/'.$category->image) }}" alt="Kategori Image" class="w-full h-40 object-cover rounded">
                @else
                    <p class="text-gray-500 text-sm">Tidak ada gambar</p>
                @endif
            </div>

            <!-- Input Upload Gambar Baru -->
            <div class="mb-4">
                <label for="image" class="block font-semibold">Upload Gambar Baru</label>
                <input type="file" id="image" name="image" class="w-full p-2 border rounded" accept="image/*">
                @error('image')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Update -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
            <a href="{{ route('categories.index') }}" class="text-gray-600 ml-2">Kembali</a>
        </form>
    </div>

</body>
</html>
