<!-- resources/views/user/payment/success.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
</head>
<body>
    <h1>Payment Successful</h1>
    <p>Thank you for purchasing: {{ $product->name }}</p>
    <div>
        <h3>Scan the QR Code below to process your payment:</h3>
        {!! $qrCode !!}
    </div>
</body>
</html>
