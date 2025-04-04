<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Tambahkan CDN Chart.js di bagian <head> layout kamu -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            </div>
            <div class="p-6 max-w-7xl mx-auto">
                <!-- Card Info -->
                <div class="flex justify-start p-5">
                    <div class="bg-white p-4 rounded-xl shadow-md flex items-center justify-between w-full max-w-xs text-center">
                        <div>
                            <div class="text-4xl font-bold text-gray-800">{{ $transactions->count() }}</div>
                            <div class="text-lg font-medium text-gray-400">Jumlah Produk terjual</div>
                        </div>
                        <div class="text-4xl text-gray-400">
                            <ion-icon name="cart-outline"></ion-icon>
                        </div>
                    </div>
                </div>

                <!-- Chart Section (2 Chart) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Pie Chart -->
                    <div class="bg-white shadow rounded-xl p-4 w-full">
                        <h2 class="text-base font-semibold text-gray-800 mb-2">Transaksi per Produk</h2>
                        <div class="w-full h-64">
                            <canvas id="productPieChart"></canvas>
                        </div>
                    </div>

                    <!-- Chart Baru -->
                    <div class="bg-white shadow rounded-xl p-4 w-full">
                        <h2 class="text-base font-semibold text-gray-800 mb-2">Statistik Status Transaksi</h2>
                        <div class="w-full h-64">
                            <canvas id="transactionStatusChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Tabel Transaksi (Dibawah Chart) -->
                <div class="bg-white shadow rounded-xl p-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">Transaction List</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-200 text-sm">
                            <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="border border-gray-300 px-4 py-2">Nomor</th>
                                    <th class="border border-gray-300 px-4 py-2">Nama Produk</th>
                                    <th class="border border-gray-300 px-4 py-2">Username</th>
                                    <th class="border border-gray-300 px-4 py-2">Status</th>
                                    <th class="border border-gray-300 px-4 py-2">tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($totalTransactionstable) && count($totalTransactionstable) > 0)
                                    @foreach($totalTransactionstable as $index => $transaction)
                                        <tr>
                                            <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $transaction->product->name ?? 'N/A' }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $transaction->user->username ?? 'N/A' }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ ucfirst($transaction->status) }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $transaction->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center py-2">No Transactions Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <footer class="bg-gray-800 text-white mt-10">
                <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row justify-between items-center">
                    <div class="text-sm text-center md:text-left">
                        &copy; {{ date('Y') }} 3Dify. All rights reserved.
                    </div>
                </div>
            </footer>
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
        const ctx = document.getElementById('productPieChart').getContext('2d');

    const productPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($chartData['labels']) !!},
            datasets: [{
                label: 'Jumlah Transaksi',
                data: {!! json_encode($chartData['data']) !!},
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
                    '#FF9F40', '#00A896', '#F67280', '#6C5B7B', '#355C7D'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Transaksi per Produk'
                }
            }
        }
    });
    const statusData = @json($transactionStats);

    const ctxStatus = document.getElementById('transactionStatusChart').getContext('2d');
    const statusChart = new Chart(ctxStatus, {
        type: 'bar',
        data: {
            labels: Object.keys(statusData), // ['pending', 'paid', 'failed']
            datasets: [{
                label: 'Jumlah Transaksi',
                data: Object.values(statusData),
                backgroundColor: [
                    '#facc15', // pending - kuning
                    '#4ade80', // paid - hijau
                    '#f87171'  // failed - merah
                ],
                borderColor: [
                    '#eab308',
                    '#22c55e',
                    '#ef4444'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
