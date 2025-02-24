<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>

</head>
<body>
    <h2>Payment for Order #{{ $transaction->id }}</h2>
    <p><strong>Product:</strong> {{ $transaction->product->name }}</p>
    <p><strong>Price:</strong> Rp{{ number_format($transaction->product->price, 0, ',', '.') }}</p>

    <button  style="padding: 10px 20px; background-color: green; color: white; border: none;">
        Pay Now
    </button>

    
</body>
</html>
