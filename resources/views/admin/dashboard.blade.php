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
        {{-- <div id="sidebar" class="w-64 h-screen bg-gray-800 text-white flex flex-col fixed md:relative md:block transition-transform transform -translate-x-full md:translate-x-0">
            <div class="px-4 py-6 flex justify-between items-center">
                <h1 class="text-2xl font-bold">Admin Dashboard</h1>
                <button id="closeSidebar" class="md:hidden text-white text-2xl">&times;</button>
            </div>
            <nav class="flex-1  px-4 py-4">
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
            </nav>
        </div> --}}
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
                        <a href="{{ url('/admin/product') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Product</a>
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
            <div class="bg-white shadow p-4 flex justify-between items-center">
                <button id="openSidebar" class="md:hidden text-gray-700 text-2xl">
                    <i class="fa fa-bars"></i>
                </button>
                <h2 class="text-xl font-bold">Admin Dashboard</h2>
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

                    <!-- Admin Session Dropdown -->
                    <div class="relative">
                        <button class="focus:outline-none" id="adminDropdownButton">
                            <i class="fa fa-user sm:mr-1"></i>
                            <span class="hidden sm:inline">{{ session('admin')->email }}</span>
                        </button>
                        <div id="adminDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg p-4">
                            <a href="{{ route('admin-signup') }}" class="block px-4 py-2 text-blue-600 hover:bg-gray-200">Sign Up</a>
                            <a href="{{ route('admin-logout') }}" class="block px-4 py-2 text-red-500 hover:bg-gray-200">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6">
                {{-- <div class="cardBox">
                    <div class="card" id="sales-card">
                        <div>
                            <div class="numbers" id="total-sales">{{ $transactions->count() }}</div>
                            <div class="cardName">Sales</div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="cart-outline"></ion-icon>
                        </div>
                    </div>
                </div> --}}
                <div class="flex justify-between p-5">
                    <div class="bg-white p-3 rounded-xl shadow-md flex items-center justify-between w-full max-w-xs  text-center">
                      <div>
                        <div class="text-4xl font-bold text-gray-800">{{ $transactions->count() }}</div>
                        <div class="text-lg font-medium text-gray-400">Jumlah Produk terjual</div>
                      </div>
                      <div class="text-4xl text-gray-400">
                        <ion-icon name="cart-outline"></ion-icon>
                      </div>
                    </div>
                  </div>

                  <div class="p-6 overflow-x-auto">
                    <div class="bg-white shadow rounded p-4">
                        <div class="flex justify-between items-center mb-4 flex-wrap">
                            <h3 class="text-lg font-bold">Transaction List</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-200 text-sm">
                                <thead>
                                    <tr class="bg-gray-100 text-left">
                                        <th class="border border-gray-300 px-2 py-2">Number</th>
                                        <th class="border border-gray-300 px-2 py-2">Product Name</th>
                                        <th class="border border-gray-300 px-2 py-2">Username</th>
                                        <th class="border border-gray-300 px-2 py-2">Status</th>
                                        <th class="border border-gray-300 px-4 py-2">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($transactions) && count($transactions) > 0)
                                    @foreach($transactions as $index => $transaction)
                                        <tr>
                                            <td class="border border-gray-300 px-2 py-2">{{ $index + 1 }}</td>
                                            <td class="border border-gray-300 px-2 py-2">{{ $transaction->product->name ?? 'N/A' }}</td>
                                            <td class="border border-gray-300 px-2 py-2">{{ $transaction->user->username ?? 'N/A' }}</td>
                                            <td class="border border-gray-300 px-2 py-2">{{ ucfirst($transaction->status) }}</td>
                                            <td class="border border-gray-300 px-2 py-2">{{ $transaction->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">No Transactions Found</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar & Dropdown Scripts -->
    <script>
        document.getElementById('openSidebar').addEventListener('click', function () {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
        });

        document.getElementById('closeSidebar').addEventListener('click', function () {
            document.getElementById('sidebar').classList.add('-translate-x-full');
        });
        function playNotificationSound() {
            var audio = new Audio('{{ asset("sounds/notifikasi.mp3") }}');
            audio.play();
        }

        @if(isset($pendingTransactions) && $pendingTransactions->count() > 0)
            playNotificationSound();
        @endif


        document.getElementById('notificationButton').addEventListener('click', function () {
            document.getElementById('notificationDropdown').classList.toggle('hidden');
        });

        document.getElementById('adminDropdownButton').addEventListener('click', function () {
            document.getElementById('adminDropdown').classList.toggle('hidden');
        });
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
