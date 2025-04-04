{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <!-- Form Tambah Kategori -->
<div class="bg-white shadow rounded p-4 mt-6">
    <h3 class="text-lg font-bold mb-4">Tambah Kategori Baru</h3>
    <form action="{{ route('categories.store') }}" method="POST"  enctype="multipart/form-data">
        @csrf

        <!-- Nama Kategori -->
        <div class="mb-4">
            <label for="nama_category" class="block text-gray-700 font-bold mb-2">Nama Kategori</label>
            <input type="text" name="nama_category" id="nama_category" placeholder="Masukkan Nama Kategori" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
        </div>

        <!-- Image -->
        <div class="mb-4">
            <label for="image">Upload Gambar</label>
            <input type="file" name="image" accept="image/*">
        </div>


        <!-- Tombol Submit -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Kategori</button>
    </form>
</div>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-900 flex items-center justify-center h-screen">

    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <button class="text-white bg-blue-900 px-4 py-2 rounded mb-4 flex items-center"onclick="window.location.href='{{ url()->previous() }}'">
            <span class="mr-2">⬅</span> Kembali
        </button>
        <!-- Form Tambah Kategori -->
        <h2 class="text-lg font-bold mb-4">Tambah Kategori</h2>

        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama Kategori -->
            <div class="mb-4">
                <label for="nama_category" class="block text-gray-700 font-bold mb-2">Nama Kategori</label>
                <input type="text" name="nama_category" id="nama_category" class="w-full px-4 py-2 border border-gray-300 rounded bg-gray-100" required>
            </div>

            <!-- Gambar Kategori -->
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-bold mb-2">Gambar Kategori</label>
                <div class="flex items-center">
                    <input type="file" name="image" id="image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded bg-gray-100">
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end mt-4">
                <a href="{{ url ('/admin/category') }}"  type="button" class="px-4 py-2 border border-gray-500 rounded text-black mr-2">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>

</body>
</html>
