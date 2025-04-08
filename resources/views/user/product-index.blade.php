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
        @foreach($categories as $category)
            <h2 class="text-2xl font-bold mb-4">Produk {{ $category->nama_category }}</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($category->products as $product)
                    <div class="bg-blue-900 p-4 rounded-lg text-white text-center">
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="mx-auto mb-2 h-20 object-contain">
                        <h3>{{ $product->name }}</h3>
                        <p class="text-sm italic">{{ $product->description }}</p>
                        <p>Rp. {{ number_format($product->price / 100, 0, ',', '.') }}</p>
                        <a href="{{ route('product.show', $product->id) }}" class="mt-2 bg-white text-blue-900 px-4 py-2 rounded inline-block">Beli Produk</a>
                        {{-- @if ($product->blender_file)
                            <a href="{{ asset('storage/' . $product->blender_file) }}" download class="mt-2 bg-white text-blue-900 px-4 py-2 rounded inline-block">Beli Produk</a>
                        @else
                            <span class="text-sm italic block mt-2">File tidak tersedia</span>
                        @endif --}}
                    </div>
                @endforeach
            </div>
        @endforeach
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
