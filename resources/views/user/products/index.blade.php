<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sander E-Commerce - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sander E-Commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @if(Auth::check()) <!-- Setelah Login -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/profile') }}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ url('/logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">Logout</button>
                            </form>
                        </li>
                    @else <!-- Sebelum Login -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/signup') }}">Register</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container mt-4">
        <h2>Available Products</h2>
        @foreach ($products as $product) <!-- Access 'products' passed from controller -->
            <div style="border: 1px solid #ddd; margin-bottom: 20px; padding: 15px;">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
                  <!-- Menampilkan gambar produk jika ada -->
            <div class="mb-3">
                @if($product->image)
                    <img src="{{ asset('/images/' . $product->image) }}" alt="Product Image" style="width: 200px; height: 200px;">
                @else
                    <span>No Image Available</span>
                @endif
            </div>
                <p><strong>Price: Rp{{ number_format($product->price, 0, ',', '.') }}</strong></p>
                <a href="{{ url('/product/'.$product->id) }}" style="text-decoration: none; color: blue;">View Product</a>
            </div>
        @endforeach
    </div>
</body>
</html>
