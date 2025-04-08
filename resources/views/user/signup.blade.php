<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-900 to-blue-500 text-white">

    <div class="bg-[#0e1e40] p-8 rounded-2xl shadow-xl w-full max-w-md">
        <h1 class="text-xl font-bold mb-6 text-center">HALAMAN SIGN UP PEMBELI</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 rounded-md p-4 mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{url('/signup')}}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold mb-1">Username :</label>
                <input type="text" name="username" placeholder="Masukan username anda" required
                       class="w-full p-3 rounded-md text-black text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Email :</label>
                <input type="email" name="email" placeholder="Masukan email anda" required
                       class="w-full p-3 rounded-md text-black text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">No. Telephone :</label>
                <input type="text" name="phone_number" placeholder="Masukan nomor telepon anda" required
                       class="w-full p-3 rounded-md text-black text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Password :</label>
                <input type="password" name="password" placeholder="Masukan password email anda" required maxlength="8"
                       class="w-full p-3 rounded-md text-black text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Konfirmasi Password :</label>
                <input type="password" name="password_confirmation" placeholder="Konfirmasi password email anda" required maxlength="8"
                       class="w-full p-3 rounded-md text-black text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit"
                    class="w-full py-3 bg-white text-blue-900 font-bold rounded-md hover:bg-gray-200 transition-all">
                Sign up
            </button>
        </form>

        <div class="text-center mt-4 text-sm">
            Sudah punya akun? silahkan <a href="{{url('/login')}}" class="text-blue-300 underline font-semibold">login akun</a>
        </div>
    </div>

</body>
</html>
