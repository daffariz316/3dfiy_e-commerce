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
                        <a href="{{ route('admin-dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Dashboard</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/admin/product') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Product</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/admin/transaction') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Riwayat Transaksi</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/admin/category') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Kategori</a>
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

                <div class="flex items-center space-x-4">
                    <!-- Notification Icon -->
                    <div class="relative">
                        <button class="focus:outline-none" id="notificationButton">
                            <i class="fa fa-bell text-gray-600 text-xl"></i>
                            @if(isset($pendingTransactions) && $pendingTransactions->count() > 0)
                                <span class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                                    {{ $pendingTransactions->count() }}
                                </span>
                            @endif
                        </button>

                        <!-- Dropdown Notification -->
                        <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-64 bg-white shadow-lg rounded-lg p-4">
                            <h4 class="font-semibold text-gray-700">Notifikasi</h4>
                            <ul>
                                @forelse ($pendingTransactions as $transaction)
                                    <li class="border-b py-2">
                                        <p class="text-sm text-gray-600">Transaksi {{ $transaction->user->username }} sedang menunggu pembayaran.</p>
                                    </li>
                                @empty
                                    <li class="text-gray-500 text-sm">Tidak ada transaksi pending.</li>
                                @endforelse
                            </ul>
                            <div class="mt-3 text-center">
                                <a href="{{ url('/admin/transaction') }}" class="text-blue-600 font-semibold">Lihat Semua</a>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Session -->
                    <a href="../pages/sign-in.html" class="block px-0 py-2 font-semibold transition-all ease-nav-brand text-sm text-slate-500">
                        <i class="fa fa-user sm:mr-1"></i>
                        <span class="hidden sm:inline">{{ session('admin')->email }}</span>
                    </a>
                </div>
            </div>

            <div class="p-6">
                <div class="bg-white shadow rounded p-4">
                    <h3 class="text-lg font-bold">Main Content Area</h3>
                    <p class="text-gray-600">This is where the main content will appear.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Sound Script -->
    <script>
        // Fungsi untuk memutar suara notifikasi
        function playNotificationSound() {
            var audio = new Audio('{{ asset("sounds/notifikasi.mp3") }}');
            audio.play();
        }

        // Periksa apakah ada transaksi pending dan play suara
        @if(isset($pendingTransactions) && $pendingTransactions->count() > 0)
            playNotificationSound();
        @endif

        // Toggle notification dropdown
        document.getElementById('notificationButton').addEventListener('click', function () {
            let dropdown = document.getElementById('notificationDropdown');
            dropdown.classList.toggle('hidden');
        });
    </script>
</body>
</html>
