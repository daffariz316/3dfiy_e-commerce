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
<body class="bg-gray-100 font-sans leading-normal tracking-normal flex flex-col min-h-screen">
    <div class="flex flex-col lg:flex-row flex-grow">
        <!-- Sidebar -->
        <div id="sidebar" class="w-64 min-h-screen bg-gray-800 text-white flex flex-col fixed md:relative md:block transition-transform transform -translate-x-full md:translate-x-0 overflow-y-auto">
            <div class="px-4 py-6 flex justify-between items-center">
                <h1 class="text-2xl font-bold">Admin Dashboard</h1>
                <button id="closeSidebar" class="md:hidden text-white text-2xl">&times;</button>
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
        <div class="flex-1 md:ml-50 p-4 flex flex-col">
            <div class="bg-white shadow p-4 flex justify-between items-center flex-wrap">
                <button id="openSidebar" class="lg:hidden text-gray-800 text-2xl">
                    <i class="fas fa-bars"></i>
                </button>
                <h2 class="text-xl font-bold"> Halaman Transaksi </h2>
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
            <div class="p-6 overflow-x-auto flex-grow">
                <div class="bg-white shadow rounded p-4">
                    <div class="flex justify-between items-center mb-4 flex-wrap">
                        <h3 class="text-lg font-bold">List Transaksi</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-200 text-sm">
                            <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="border border-gray-300 px-2 py-2">Number</th>
                                    <th class="border border-gray-300 px-2 py-2">Product Name</th>
                                    <th class="border border-gray-300 px-2 py-2">User ID</th>
                                    <th class="border border-gray-300 px-2 py-2">Username</th>
                                    <th class="border border-gray-300 px-2 py-2">Status</th>
                                    <th class="border border-gray-300 px-2 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $index => $transaction)
                                <tr>
                                    <td class="border border-gray-300 px-2 py-2">{{ $index + 1 }}</td>
                                    <td class="border border-gray-300 px-2 py-2">{{  $transaction->product->name }}</td>
                                    <td class="border border-gray-300 px-2 py-2 ">{{  $transaction->user_id }}</td>
                                    <td class="border border-gray-300 px-2 py-2">{{$transaction->user->username}}</td>
                                    <td class="border border-gray-300 px-2 py-2">{{ucfirst($transaction->status) }}</td>
                                    <td class="border border-gray-300 px-2 py-2">
                                        <a href="{{ route('transactions.edit', $transaction->id) }}" class="text-blue-500 hover:underline">Edit</a>
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
        document.getElementById('adminDropdownButton').addEventListener('click', function () {
            document.getElementById('adminDropdown').classList.toggle('hidden');
        });
    </script>
</body>
</html>
