<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - {{ $product->name }}</title>
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-wy2IfuVOhZADqNo-"></script>
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

            <div id="action-container">
                @if($transaction)
                    <a href="{{ route('products.download', ['product' => $product->id]) }}" id="download-button">
                        Download
                    </a>
                @else
                    <button type="button" id="pay-button"
                            style="padding: 10px 20px; background-color: green; color: white; border: none;">
                        Buy Now
                    </button>
                @endif
            </div>

        </div>
    </div>

    <a href="{{ url('/') }}" style="margin-top: 20px; display: inline-block; color: blue;">Back to Products</a>

    <script type="text/javascript">
        document.getElementById('pay-button')?.addEventListener('click', function () {
            fetch('/purchase/' + @json($product->id), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                window.snap.pay(data.snapToken, {
                    onSuccess: function(result) {
                        alert("Payment success!");
                        console.log(result);

                        // Kirim permintaan ke server untuk memperbarui status transaksi
                        return fetch('/update-transaction-status', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                product_id: @json($product->id),
                                status: "paid"
                            })
                        });
                    }
                })
                .then(() => {
                    // Update tombol menjadi "Download"
                    let actionContainer = document.getElementById('action-container');
                    actionContainer.innerHTML = `
                        <a href="{{ route('products.download', ['product' => $product->id]) }}" id="download-button">
                            Download
                        </a>
                    `;
                })
                .catch(error => console.error("Error updating transaction:", error));
            });
        });
    </script>
</body>
</html>
