<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup</title>
</head>
<body>
    <h2>Admin Signup</h2>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ url('/admin-signup') }}" method="POST">
        @csrf
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Password (max 8 characters):</label>
            <input type="password" id="password" name="password" maxlength="8" required>
        </div>
        <button type="submit">Sign Up</button>
    </form>
</body>
</html>
