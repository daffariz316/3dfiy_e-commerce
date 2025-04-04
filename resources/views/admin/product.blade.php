<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="flex flex-col lg:flex-row">
        <!-- Sidebar -->
        <div class="w-64 h-screen bg-gray-800 text-white flex flex-col fixed lg:relative transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out" id="sidebar">
            <div class="px-4 py-6 flex justify-between items-center">
                <h1 class="text-2xl font-bold">Admin Dashboard</h1>
                <button id="closeSidebar" class="lg:hidden text-white text-2xl">&times;</button>
            </div>
            <nav class="flex-1 px-4 py-4">
                <ul>
                    <li class="mb-2">
                        <a href="{{ route('admin-dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Dashboard</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/admin/product') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Produk</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/admin/transaction') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Riwayat Transaksi</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/admin/category') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Kategori</a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-50 p-4">
            <div class="bg-white shadow p-4 flex justify-between items-center flex-wrap">
                <button id="openSidebar" class="lg:hidden text-gray-800 text-2xl">
                    <i class="fas fa-bars"></i>
                </button>
                <h2 class="text-xl font-bold"> Halaman Produk</h2>
                <!-- Admin Session -->
                <div class="relative">
                    <button class="focus:outline-none" id="adminDropdownButton">
                        <i class="fa fa-user sm:mr-1"></i>
                        <span class="hidden sm:inline">{{ session('admin')->email }}</span>
                    </button>
                    <div id="adminDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg p-4">
                        <a href="{{ route('admin-signup') }}" class="flex items-center px-4 py-2 text-blue-600 hover:bg-gray-200">
                            <i class="fas fa-user-plus mr-2 text-blue-600"></i>
                            Sign Up
                        </a>
                        <a href="{{ route('admin-logout') }}" class="flex items-center px-4 py-2 text-red-500 hover:bg-gray-200">
                            <i class="fas fa-sign-out-alt mr-2 text-red-500"></i>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
            <div class="p-6 overflow-x-auto">
                <div class="bg-white shadow rounded p-4">
                    <div class="flex justify-between items-center mb-4 flex-wrap">
                        <h3 class="text-lg font-bold"> List Produk</h3>
                        <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            + Tambah Produk
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-200 text-sm">
                            <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="border border-gray-300 px-2 py-2">Number</th>
                                    <th class="border border-gray-300 px-2 py-2">Nama Produk</th>
                                    <th class="border border-gray-300 px-2 py-2">Deskripsi Produk</th>
                                    <th class="border border-gray-300 px-2 py-2">Harga Produk</th>
                                    <th class="border border-gray-300 px-2 py-2">Gambar Produk</th>
                                    <th class="border border-gray-300 px-2 py-2">File Blender</th>
                                    <th class="border border-gray-300 px-2 py-2">Nama Kategori</th>
                                    <th class="border border-gray-300 px-2 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $index => $product)
                                <tr>
                                    <td class="border border-gray-300 px-2 py-2">{{ $index + 1 }}</td>
                                    <td class="border border-gray-300 px-2 py-2">{{ $product->name }}</td>
                                    <td class="border border-gray-300 px-2 py-2 truncate max-w-xs">{{ $product->description }}</td>
                                    <td class="border border-gray-300 px-2 py-2">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="border border-gray-300 px-2 py-2">
                                        @if($product->image)
                                        <img src="{{ asset('/images/' . $product->image) }}" alt="Product Image" class="w-10 h-10 object-cover">
                                        @else
                                        <span>No Image</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-2 py-2">
                                        @if($product->blender_file)
                                            <a href="{{ url('/download/blender/' . $product->blender_file) }}"
                                               class="text-blue-500 hover:underline">
                                                Download
                                            </a>
                                        @else
                                            <span>No File</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-2 py-2">{{$product->category->nama_category }}</td>
                                    <td class="border border-gray-300 px-2 py-2">
                                        <a href="{{ route('products.edit', $product->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                                        <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="text-red-500 hover:underline" onclick="confirmDelete({{ $product->id }})">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          <!-- Footer -->
          <footer class="bg-gray-900 text-white p-6 mt-auto">
            <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p> &copy; {{ date('Y') }} 3Dify. All rights reserved.</p>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="text-white hover:text-gray-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-white hover:text-gray-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-white hover:text-gray-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </footer>
        </div>
    </div>
    <script>
        document.getElementById("openSidebar").addEventListener("click", function() {
            document.getElementById("sidebar").classList.remove("-translate-x-full");
        });
        document.getElementById("closeSidebar").addEventListener("click", function() {
            document.getElementById("sidebar").classList.add("-translate-x-full");
        });

        function confirmDelete(productId) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${productId}`).submit();
                }
            });
        }

        document.getElementById('adminDropdownButton').addEventListener('click', function () {
            document.getElementById('adminDropdown').classList.toggle('hidden');
        });
    </script>
</body>
</html>
