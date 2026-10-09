<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body style="font-family: sans-serif; padding: 2rem;">
    <h2>Login</h2>
    <p>Masuk untuk membuka dashboard</p>

    @error('loginError')
        <p style="color: red;">[ {{ $message }} ]</p>
    @enderror

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <p>
            <label>Username</label><br>
            <input type="text" name="username" required>
        </p>
        <p>
            <label>Password</label><br>
            <input type="password" name="password" required>
        </p>
        <button type="submit">[ Masuk ]</button>
    </form>
</body>
</html>