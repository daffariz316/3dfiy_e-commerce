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
    <!-- Navbar -->
    <nav class="bg-white shadow-md p-4 flex justify-between items-center flex-wrap gap-y-2">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('assets/images/logo_3difyy.png') }}" alt="3DIFY Logo" class="h-10">
            <span class="font-bold text-lg">3DIFY</span>
        </div>
        <div class="hidden md:flex space-x-6 w-full md:w-auto justify-center md:justify-start mt-2 md:mt-0">
            <a href="#" class="font-semibold text-black">Beranda</a>
            <a href="{{url('/categories')}}" class="text-gray-600">Kategori</a>
            <a href="{{url('/products')}}" class="text-gray-600">Produk</a>
            <a href="{{url('/teams')}}" class="text-gray-600">Team</a>
        </div>
        <div class="flex items-center space-x-4">
            @if(Auth::check())
                <a href="{{ url ('/profile') }}">
                    <i class="bx bxs-user-circle cursor-pointer text-[40px] md:text-[100px] lg:text-[40px]"></i>
                </a>
            @else
                <a href="{{ url('/login') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Login</a>
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="relative w-full h-[500px] flex items-center text-white px-6">
        <img src="{{ asset('assets/images/banner.png') }}"
             alt="Banner 3DIFY"
             class="absolute w-full h-full object-cover rounded-b-[50px] top-0 left-0">

        <div class="relative z-10 max-w-xl ml-0 md:ml-15 md:pl-8 px-4 text-center md:text-left">
            <p class="text-2xl md:text-4xl font-bold mb-2">Solusi Praktis Kebutuhan Asset 3D Blender</p>
            <p class="text-base md:text-xl">3Dify memudahkan Anda menemukan dan membeli asset 3D berkualitas tinggi, khusus untuk furniture dan alat tulis sekolah.</p>
            <div class="mt-4 flex flex-col md:flex-row justify-center md:justify-start items-center gap-4">
                <a href="{{url('/categories')}}" class="bg-blue-600 px-4 py-2 rounded-md text-white" type="button">Jelajahi Kategori</a>
                <a href="{{url('/products')}}" class="bg-white text-blue-600 px-4 py-2 rounded-md border border-blue-600" type="button">Temukan Produk</a>
            </div>
        </div>
    </header>

    <!-- Trending Categories -->
    <section class="container mx-auto mt-10 p-6 text-center">
        <h2 class="text-xl font-semibold mb-4">Trending Categories</h2>
        <div class="flex justify-center gap-4 flex-wrap">
            @foreach($categories as $cat)
                <div class="flex flex-col items-center mb-4">
                    <div class="p-4 rounded-lg shadow-md" style="background: linear-gradient(135deg, #3064B1, #1A1F55);">
                        <a href="{{ route('categories1.products', $cat->id) }}"
                           class="block w-40 h-40 rounded-md overflow-hidden">
                            <img src="{{ asset('images1/' . $cat->image) }}" alt="{{ $cat->nama_category }}"
                                 class="w-full h-full object-contain">
                        </a>
                    </div>
                    <span class="text-center text-black mt-2 font-bold text-lg">{{ $cat->nama_category }}</span>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Product Section -->
    <div class="container mx-auto mb-20 px-4">
        <h1 class="text-3xl font-bold mb-6">Produk Kami</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <button class="product-button bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
                    <a href="{{ url('/product/'.$product->id) }}">
                        @if($product->image)
                            <img src="{{ asset('/images/' . $product->image) }}" alt="Product Image" class="mb-4">
                        @else
                            <span class="w-full h-32 flex items-center justify-center bg-gray-200 text-gray-500 mb-4">No Image Available</span>
                        @endif
                    </a>
                    <div class="text-left mt-2">
                        <a href="{{ url('/product/'.$product->id) }}" class="block">
                            <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                        </a>
                        <p class="text-gray-500">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </button>
            @endforeach
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white py-8">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-start gap-8 px-4">
            <div class="flex flex-col space-y-2">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('assets/images/logo_3difyy.png') }}" alt="3DIFY Logo" class="h-10">
                    <span class="text-2xl font-bold">3DIFY</span>
                </div>
                <p class="italic text-blue-800 font-semibold">Solusi Praktis Kebutuhan Asset 3D Blender</p>
            </div>

            <div class="flex flex-col sm:flex-row sm:space-x-16 gap-4">
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
    <!-- Hamburger toggle script -->
<script>
    const toggleBtn = document.getElementById('menu-toggle');
    const navLinks = document.getElementById('nav-links');

    toggleBtn.addEventListener('click', () => {
      navLinks.classList.toggle('hidden');
    });
  </script>

</body>
</html>
