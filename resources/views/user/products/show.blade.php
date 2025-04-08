<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - {{ $product->name }}</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-wy2IfuVOhZADqNo-"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <a href="#" class="font-semibold text-black">Produk</a>
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

    <div class="max-w-4xl mx-auto mt-6 p-6 bg-white shadow-lg rounded-lg">
        <div class="bg-white p-4 flex items-center">
            <button onclick="window.history.back()" class="text-blue-600 text-xl mr-2">⬅</button>
            <h1 class="text-lg font-semibold">{{ $product->name }}</h1>
        </div>

        <div class="p-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="w-full md:w-1/3">
                    @if($product->image)
                        <img src="{{ asset('/images/' . $product->image) }}" alt="Produk" class="w-full rounded-lg shadow">
                    @else
                        <span class="text-gray-500">Gambar tidak tersedia</span>
                    @endif
                </div>
                <div class="w-full md:w-2/3 md:pl-6">
                    <p class="font-bold">Nama Produk : <span class="font-normal">{{ $product->name }}</span></p>
                    <p class="font-bold mt-2">Deskripsi Produk :</p>
                    <p class="mt-1 text-justify">{{ $product->description }}</p>
                    <p class="font-bold mt-4">Harga Produk : <span class="font-normal">Rp{{ number_format($product->price, 0, ',', '.') }}</span></p>
                    @php
                        $transaction = $product->transactions->where('user_id', auth()->id())->where('status', 'paid')->first();
                    @endphp
                    <div id="action-container" class="mt-4 flex justify-center">
                        @if($transaction)
                            <a href="{{ route('products.download', ['product' => $product->id]) }}"
                               class="text-white px-4 py-2 rounded shadow hover:opacity-90 mx-2"
                               style="background: linear-gradient(135deg, #3064B1, #1A1F55);">
                                Download
                            </a>
                        @else
                            <button id="pay-button" class="text-white px-4 py-2 rounded shadow hover:opacity-90 mx-2"
                                style="background: linear-gradient(135deg, #3064B1, #1A1F55);">
                                Beli Produk
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white py-8 mt-10">
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

    <script type="text/javascript">
        document.getElementById('pay-button')?.addEventListener('click', function () {
            fetch('/purchase/' + {{ $product->id }}, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                window.snap.pay(data, {
                    onSuccess: function(result) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Pembayaran Berhasil!',
                            html: 'Silakan tunggu konfirmasi dari admin sebelum produk dapat diunduh.<br><br>Hubungi admin: <a href="https://wa.me/62895372499072" target="_blank" class="text-blue-600 font-bold">+62 895-3724-99072</a>',
                            confirmButtonText: 'Oke',
                            confirmButtonColor: '#1A1F55'
                        });

                        fetch('/update-transaction-status', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                product_id: {{ $product->id }},
                                status: "paid"
                            })
                        });

                        let actionContainer = document.getElementById('action-container');
                        actionContainer.innerHTML = `
                            <button disabled
                                class="bg-yellow-500 text-white px-4 py-2 rounded shadow cursor-not-allowed">
                                Menunggu Konfirmasi Admin
                            </button>
                        `;
                    },
                    onPending: function(result) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Menunggu Pembayaran',
                            text: 'Transaksi sedang diproses. Silakan selesaikan pembayaran.',
                            confirmButtonColor: '#1A1F55'
                        });
                    },
                    onError: function(result) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Pembayaran Gagal',
                            text: 'Terjadi kesalahan dalam proses pembayaran. Silakan coba lagi.',
                            confirmButtonColor: '#1A1F55'
                        });
                    },
                    onClose: function() {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Pembayaran Dibatalkan',
                            text: 'Anda menutup jendela pembayaran sebelum menyelesaikannya.',
                            confirmButtonColor: '#1A1F55'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
