{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Profil Pembeli</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center h-screen">
    <div class="bg-blue-600 text-white p-8 rounded-lg shadow-lg w-96 relative">
        <h1 class="text-2xl font-bold mb-4">PROFILE PEMBELI</h1>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Username:</label>
            <input type="text" value="Username" class="w-full p-2 rounded bg-gray-200 text-gray-800">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Email:</label>
            <input type="email" value="Email" class="w-full p-2 rounded bg-gray-200 text-gray-800">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nomor Telepon:</label>
            <input type="text" value="Nomor Telepon" class="w-full p-2 rounded bg-gray-200 text-gray-800">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Kata Sandi:</label>
            <input type="password" value="password" class="w-full p-2 rounded bg-gray-200 text-gray-800">
        </div>
        <form action="{{ url('/logout') }}" method="POST" class="absolute bottom-2 right-2 mb-2">
            @csrf
            <button type="submit" class="bg-white text-blue-600 font-bold py-1 px-3 rounded text-sm">Logout</button>
        </form>
    </div>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Profil Pembeli</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center h-screen">
    <div class="bg-blue-600 text-white p-8 rounded-lg shadow-lg w-96 relative">
        <h1 class="text-2xl font-bold mb-4">PROFILE PEMBELI</h1>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Username:</label>
            <input type="text" value="{{ $user->username }}" class="w-full p-2 rounded bg-gray-200 text-gray-800" readonly>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Email:</label>
            <input type="email" value="{{ $user->email }}" class="w-full p-2 rounded bg-gray-200 text-gray-800" readonly>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nomor Telepon:</label>
            <input type="text" value="{{ $user->phone_number }}" class="w-full p-2 rounded bg-gray-200 text-gray-800" readonly>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Kata Sandi:</label>
            <input type="password" value="********" class="w-full p-2 rounded bg-gray-200 text-gray-800" readonly>
        </div>
        <div class="flex justify-between mt-4">
            <a href="{{ url('/dashboard') }}" class="bg-white text-blue-600 font-bold py-1 px-3 rounded text-sm">Kembali</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-white text-blue-600 font-bold py-1 px-3 rounded text-sm">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
