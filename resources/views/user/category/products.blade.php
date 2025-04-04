<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3DIFY - Solusi Praktis Asset 3D</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .product-button img {
            width: 100%;
            height: auto;
            max-height: 150px;
            object-fit: contain;
            border-radius: 0.5rem;
        }
    </style>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('assets/images/logo_3difyy.png') }}" alt="3DIFY Logo" class="h-8">
            <span class="font-bold text-lg">3DIFY</span>
        </div>
        <div class="space-x-6 hidden md:flex">
            <a href="{{url('/dashboard')}}" class="text-gray-600">Beranda</a>
            <a href="{{url('/categories')}}" class="font-semibold text-black">Kategori</a>
            <a href="#" class="text-gray-600">Produk</a>
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

      <!-- Konten -->
    <main class="flex-grow px-6 py-8 flex flex-col items-center">
        <div class="container mx-auto p-5">
            <!-- Header -->
            <div class="flex items-center mb-4">
                <a href="{{ url()->previous() }}" class="text-lg text-blue-600 font-semibold flex items-center">
                    ⬅ Kategori Produk {{ $category->nama_category }}
                </a>
            </div>

            <!-- Grid Produk -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($products as $product)
                <div class="p-5 rounded-lg shadow-lg text-center"
                    style="background: linear-gradient(135deg, #3064B1, #1A1F55);">
                    <img src="{{ asset('/images/' . $product->image) }}" alt="{{ $product->name }}" class="w-24 h-24 mx-auto">
                    <h2 class="text-lg font-semibold mt-3 text-white">{{ $product->name }}</h2>
                    <p class="text-white text-sm font-medium">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>

                @endforeach
            </div>
        </div>
    </main>


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
