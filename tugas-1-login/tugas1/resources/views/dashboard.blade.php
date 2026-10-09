<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body style="font-family: sans-serif; padding: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ccc; padding-bottom: 1rem;">
        <h2>Dashboard</h2>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">[ Logout ]</button>
        </form>
    </div>

    <div style="margin-top: 1.5rem;">
        <p>Selamat datang, {{ auth()->user()->nama_lengkap }}!</p>
        <p>Halaman ini hanya bisa dibuka setelah login.</p>
        <p>Username: {{ auth()->user()->username }}</p>
    </div>
</body>
</html>