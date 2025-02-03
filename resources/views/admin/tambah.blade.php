<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto p-6">
        <div class="bg-white shadow rounded p-6">
            <h1 class="text-2xl font-bold mb-4">Tambah Produk</h1>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nama Produk</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                    <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required></textarea>
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-bold mb-2">Harga (IDR)</label>
                    <input type="number" id="price" name="price" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
                </div>

                <!-- Category -->
                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700 font-bold mb-2">Kategori</label>
                    <select id="category_id" name="category_id" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->nama_category }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Image -->
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-bold mb-2">Gambar Produk</label>
                    <input type="file" id="image" name="image" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" accept="image/*">
                </div>

                <!-- Blender -->
                <div class="mb-4">
                    <label for="blender" class="block text-gray-700 font-bold mb-2">Blender File</label>
                    <input type="file" id="blender" name="blender" accept=".blend,.zip,.rar" class="w-full border px-3 py-2 rounded">
                    @error('blender')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Tambah Produk</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
