<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 h-screen bg-gray-800 text-white flex flex-col">
            <div class="px-4 py-6">
                <h1 class="text-2xl font-bold">Admin Dashboard</h1>
            </div>
            <nav class="flex-1 px-4 py-4">
                <ul>
                    <li class="mb-2">
                        <a href="{{url('/admin-dashboard')}}" class="block px-4 py-2 rounded hover:bg-gray-700">Dashboard</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{url('/admin/product')}}" class="block px-4 py-2 rounded hover:bg-gray-700">Product</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{url('/admin/transaction')}}" class="block px-4 py-2 rounded hover:bg-gray-700">Riwayat Transaksi</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{url('admin/dashboard')}}" class="block px-4 py-2 rounded hover:bg-gray-700">Settings</a>
                    </li>
                </ul>
                <!-- Logout Button -->
                <div class="mt-4">
                    <a href="{{ route('admin-logout') }}" class="block px-4 py-2 text-red-500 hover:bg-gray-700 rounded">Logout</a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <div class="bg-white shadow p-4 flex justify-between items-center">
                <h2 class="text-xl font-bold">Welcome to Admin Dashboard</h2>
                <!-- Admin Session -->
                <a href="../pages/sign-in.html" class="block px-0 py-2 font-semibold transition-all ease-nav-brand text-sm text-slate-500">
                    <i class="fa fa-user sm:mr-1"></i>
                    <span class="hidden sm:inline">{{ session('admin')->email }}</span>
                </a>
            </div>
            <div class="p-6">
                <div class="bg-white shadow rounded p-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">Product List</h3>
                        <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            + Tambah Produk
                        </a>
                    </div>
                    <table class="w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">Number</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Description</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Price</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Image</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Blender</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through product data -->
                            @foreach($products as $index => $product)
                            <tr>
                                <!-- Number column -->
                                <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $product->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $product->description }}</td>
                                <td class="border border-gray-300 px-4 py-2">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    @if($product->image)
                                    <img src="{{ asset('/images/' . $product->image) }}" alt="Product Image" class="w-16 h-16 object-cover">
                                    @else
                                    <span>No Image</span>
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    @if($product->blender_file)
                                        <a href="{{ url('/download/blender/' . $product->blender_file) }}"
                                           class="text-blue-500 hover:underline">
                                            Download Blender File
                                        </a>
                                    @else
                                        <span>No File</span>
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ route('products.edit', $product->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
