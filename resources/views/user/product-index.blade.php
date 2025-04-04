<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3DIFY Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('assets/images/logo_3difyy.png') }}" alt="3DIFY Logo" class="h-8">
            <span class="font-bold text-lg">3DIFY</span>
        </div>
        <div class="space-x-6 hidden md:flex">
            <a href="{{url('/dashboard')}}" class="text-gray-600">Beranda</a>
            <a href="{{url('/categories')}}" class="text-gray-600">Kategori</a>
            <a href="{{url('/products')}}" class="font-semibold text-black">Produk</a>
            <a href="{{url('/teams')}}" class="text-gray-600">Team</a>
        </div>
        <div class="flex items-center space-x-4">
            @if(Auth::check())
            <a href="{{ url ('/profile') }}">
                <i class="bx bxs-user-circle cursor-pointer text-[40px] md:text-[100px] lg:text-[40px]"></i> <!-- Ikon profile -->
            </a>
                {{-- <form action="{{ url('/logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">Logout</button>
                </form> --}}
            @else
                <a href="{{ url('/login') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Login</a>
                {{-- <a href="{{ url('/signup') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md">Register</a> --}}
            @endif
        </div>
    </nav>


    <div class="max-w-5xl mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Produk Furnitur</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-blue-900 p-4 rounded-lg text-white text-center">
                <img src="#" alt="Pencil" class="mx-auto mb-2">
                <h3>Pensil</h3>
                <p>Rp. 15.000</p>
                <button class="mt-2 bg-white text-blue-900 px-4 py-2 rounded">Beli Produk</button>
            </div>
            <div class="bg-blue-900 p-4 rounded-lg text-white text-center">
                <img src="#" alt="Buku" class="mx-auto mb-2">
                <h3>Buku</h3>
                <p>Rp. 18.000</p>
                <button class="mt-2 bg-white text-blue-900 px-4 py-2 rounded">Beli Produk</button>
            </div>
            <div class="bg-blue-900 p-4 rounded-lg text-white text-center">
                <img src="#" alt="Pulpen" class="mx-auto mb-2">
                <h3>Pulpen</h3>
                <p>Rp. 16.000</p>
                <button class="mt-2 bg-white text-blue-900 px-4 py-2 rounded">Beli Produk</button>
            </div>
            <div class="bg-blue-900 p-4 rounded-lg text-white text-center">
                <img src="#" alt="Penghapus" class="mx-auto mb-2">
                <h3>Penghapus</h3>
                <p>Rp. 12.000</p>
                <button class="mt-2 bg-white text-blue-900 px-4 py-2 rounded">Beli Produk</button>
            </div>
        </div>

        <h2 class="text-2xl font-bold my-4">Produk Alat Tulis</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-blue-900 p-4 rounded-lg text-white text-center">
                <img src="#" alt="Kursi" class="mx-auto mb-2">
                <h3>Kursi</h3>
                <p>Rp. 22.000</p>
                <button class="mt-2 bg-white text-blue-900 px-4 py-2 rounded">Beli Produk</button>
            </div>
            <div class="bg-blue-900 p-4 rounded-lg text-white text-center">
                <img src="#" alt="Meja" class="mx-auto mb-2">
                <h3>Meja</h3>
                <p>Rp. 20.000</p>
                <button class="mt-2 bg-white text-blue-900 px-4 py-2 rounded">Beli Produk</button>
            </div>
            <div class="bg-blue-900 p-4 rounded-lg text-white text-center">
                <img src="#" alt="Lemari" class="mx-auto mb-2">
                <h3>Lemari</h3>
                <p>Rp. 22.000</p>
                <button class="mt-2 bg-white text-blue-900 px-4 py-2 rounded">Beli Produk</button>
            </div>
            <div class="bg-blue-900 p-4 rounded-lg text-white text-center">
                <img src="#" alt="Kasur" class="mx-auto mb-2">
                <h3>Kasur</h3>
                <p>Rp. 20.000</p>
                <button class="mt-2 bg-white text-blue-900 px-4 py-2 rounded">Beli Produk</button>
            </div>
        </div>
    </div>

    <footer class="bg-white py-8">
        <div class="container mx-auto flex justify-between items-start">
            <div class="flex flex-col space-y-2">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('assets/images/logo_3difyy.png') }}" alt="3DIFY Logo" class="h-10">
                    <span class="text-2xl font-bold">3DIFY</span>
                </div>
                <p class="italic text-blue-800 font-semibold">
                    Solusi Praktis Kebutuhan Asset 3D Blender
                </p>
            </div>

            <div class="flex space-x-16">
                <div>
                    <h3 class="font-semibold text-blue-800">Produk Kami</h3>
                    <ul class="mt-2 space-y-1">
                        <li>Pensil</li>
                        <li>Penghapus</li>
                        <li>Kursi</li>
                        <li>Meja</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-blue-800">Website 3Dify</h3>
                    <ul class="mt-2 space-y-1">
                        <li>Beranda</li>
                        <li>Kategori</li>
                        <li>Produk</li>
                        <li>Tim Kami</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
