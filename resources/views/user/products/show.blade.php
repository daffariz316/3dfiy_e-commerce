<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - {{ $product->name }}</title>
</head>
<body>
    <h1>Product Details: {{ $product->name }}</h1>

    <div style="border: 1px solid #ddd; padding: 20px;">
        <p><strong>Name :</strong> {{ $product->name }}</p>
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Price: Rp{{ number_format($product->price, 0, ',', '.') }}</strong></p>

        <div class="mb-3">
            @if($product->image)
                <img src="{{ asset('/images/' . $product->image) }}" alt="Product Image" style="width: 200px; height: 200px;">
            @else
                <span>No Image Available</span>
            @endif

            @php
                $transaction = $product->transactions->where('user_id', auth()->id())->where('status', 'paid')->first();
            @endphp

            @if($transaction)
                <a href="{{ route('product.download', $product->id) }}"
                   style="padding: 10px 20px; background-color: blue; color: white; border: none; text-decoration: none;">
                    Download
                </a>
            @else
                <form action="{{ route('purchase', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                            style="padding: 10px 20px; background-color: green; color: white; border: none;">
                        Buy Now
                    </button>
                </form>
            @endif
        </div>
    </div>

    <a href="{{ url('/') }}" style="margin-top: 20px; display: inline-block; color: blue;">Back to Products</a>
</body>
</html>
