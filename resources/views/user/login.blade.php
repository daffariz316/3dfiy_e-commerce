<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-b from-blue-600 to-blue-800 min-h-screen flex items-center justify-center text-white">
    <div class="bg-[#163E78]/30 border border-white/30 shadow-xl backdrop-blur-md p-8 w-full max-w-md rounded-xl">
        <h1 class="text-xl font-bold uppercase mb-6 text-white">Halaman Login Pembeli</h1>

        @if ($errors->any())
            <div class="bg-red-500 p-4 rounded mb-4 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/login" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-semibold mb-1">Email :</label>
                <input type="email" name="email" id="email" placeholder="Masukan email anda"
                    class="w-full px-4 py-2 rounded-md text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-300" required>
            </div>
            <div>
                <label for="password" class="block text-sm font-semibold mb-1">Password :</label>
                <input type="password" name="password" id="password" placeholder="Masukan password anda"
                    class="w-full px-4 py-2 rounded-md text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-300" required>
            </div>
            <div class="flex items-center justify-between mt-4">
                <p class="text-sm">Belum punya akun? silahkan
                    <a href="{{url('/signup')}}" class="underline text-white hover:text-gray-300">buat akun</a>
                </p>
                <button type="submit"
                    class="bg-white text-black font-bold px-6 py-2 rounded-md hover:bg-gray-200 transition">
                    Login
                </button>
            </div>
        </form>
    </div>
</body>
</html>
