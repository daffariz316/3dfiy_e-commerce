<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <!-- Form Tambah Kategori -->
<div class="bg-white shadow rounded p-4 mt-6">
    <h3 class="text-lg font-bold mb-4">Tambah Kategori Baru</h3>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <!-- Nama Kategori -->
        <div class="mb-4">
            <label for="nama_category" class="block text-gray-700 font-bold mb-2">Nama Kategori</label>
            <input type="text" name="nama_category" id="nama_category" placeholder="Masukkan Nama Kategori" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Kategori</button>
    </form>
</div>
</body>
</html>
