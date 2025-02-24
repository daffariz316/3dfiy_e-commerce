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

@if($transaction)
<a href="{{ route('products.download', ['product' => $product->id]) }}">
    Download
</a>

@else
<div>
    <button type="submit" id="pay-button"
            style="padding: 10px 20px; background-color: green; color: white; border: none;">
        Buy Now
    </button>
</div>
@endif
        </div>
    </div>

    <a href="{{ url('/') }}" style="margin-top: 20px; display: inline-block; color: blue;">Back to Products</a>
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            fetch('/purchase/'+{{$product->id}}, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                window.snap.pay(data, {
                    onSuccess: function(result){
                        /* You may add your own implementation here */
                        alert("payment success!"); console.log(result);
                    },
                    onPending: function(result){
                        /* You may add your own implementation here */
                        alert("wating your payment!"); console.log(result);
                    },
                    onError: function(result){
                        /* You may add your own implementation here */
                        alert("payment failed!"); console.log(result);
                    },
                    onClose: function(){
                        /* You may add your own implementation here */
                        alert('you closed the popup without finishing the payment');
                    }
                    })
                });
            });


      </script>
</body>
</html>
