{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Edit Transaksi #{{ $transaction->id }}</h2>

        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Product Select -->
            <div class="mb-4">
                <label for="product_id" class="block text-sm font-semibold text-gray-700">Produk</label>
                <select id="product_id" name="product_id" class="w-full border border-gray-300 rounded p-2">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $transaction->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
                @error('product_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Select -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-semibold text-gray-700">Status Transaksi</label>
                <select id="status" name="status" class="w-full border border-gray-300 rounded p-2">
                    <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ $transaction->status == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ $transaction->status == 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Transaksi</button>
            </div>
        </form>
    </div>
</div>

</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-blue-900 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md w-96">
        <button class="text-white bg-blue-900 px-4 py-2 rounded mb-4 flex items-center"onclick="window.location.href='{{ url()->previous() }}'">
            <span class="mr-2">⬅</span> Kembali
        </button>
        <h2 class="text-xl font-bold mb-4">Edit Transaksi #{{ $transaction->id }}</h2>
        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Product Select -->
            <div class="mb-4">
                <label for="product_id" class="block text-sm font-semibold text-gray-700">Produk</label>
                <select id="product_id" name="product_id" class="w-full border border-gray-300 rounded p-2 bg-gray-200">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $transaction->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
                @error('product_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Select -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-semibold text-gray-700">Status Transaksi</label>
                <select id="status" name="status" class="w-full border border-gray-300 rounded p-2 bg-gray-200">
                    <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ $transaction->status == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ $transaction->status == 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-4 gap-2">
                <a href="{{ url ('/admin/transaction') }}"  type="button" class="border border-blue-600 text-blue-600 px-4 py-2 rounded">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
