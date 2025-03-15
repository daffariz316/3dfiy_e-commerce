<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

    <div class="container mx-auto p-6">
        <div class="bg-white shadow rounded p-6">
            <h1 class="text-2xl font-bold mb-4">Update Produk</h1>

            <!-- Menampilkan pesan sukses jika ada -->
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama Produk -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nama Produk</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
                </div>

                <!-- Deskripsi Produk -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                    <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Harga Produk -->
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-bold mb-2">Harga</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
                </div>

                <!-- Kategori Produk -->
                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700 font-bold mb-2">Kategori</label>
                    <select id="category_id" name="category_id" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                                {{ $category->nama_category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Gambar Produk Saat Ini -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Gambar Saat Ini</label>
                    @if($product->image)
                        <img src="{{ asset('images/'.$product->image) }}" alt="Produk Image" class="w-full h-40 object-cover rounded mb-2">
                    @else
                        <p class="text-gray-500 text-sm">Tidak ada gambar</p>
                    @endif
                </div>

                <!-- Input Upload Gambar Baru -->
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-bold mb-2">Upload Gambar Baru</label>
                    <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
                </div>

                <!-- File Blender Saat Ini -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">File Blender Saat Ini</label>
                    @if($product->blender_file)
                        <p class="text-blue-500">
                            <a href="{{ asset('folder_blender/'.$product->blender_file) }}" target="_blank" class="underline">
                                {{ $product->blender_file }}
                            </a>
                        </p>
                    @else
                        <p class="text-gray-500 text-sm">Tidak ada file Blender</p>
                    @endif
                </div>

                <!-- Input Upload File Blender Baru -->
                <div class="mb-4">
                    <label for="blender_file" class="block text-gray-700 font-bold mb-2">Upload File Blender Baru</label>
                    <input type="file" id="blender_file" name="blender_file" accept=".zip,.rar,.blend" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Update Produk</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
