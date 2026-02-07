<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="auth-box">
    <h2>Welcome Back 👋</h2>

    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>
    </form>

    <p>Don’t have an account? <a href="{{ route('register') }}">Register</a></p>
</div>

</body>
</html>
