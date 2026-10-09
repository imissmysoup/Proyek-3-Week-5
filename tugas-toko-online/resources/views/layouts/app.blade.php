<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Toko Online</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 2rem; max-width: 900px; margin: 0 auto; }
        .nav { display: flex; gap: 1rem; border-bottom: 2px solid #ccc; padding-bottom: 1rem; margin-bottom: 2rem; align-items: center; }
        .nav a { text-decoration: none; color: #2563eb; font-weight: bold; }
        .card { border: 1px solid #ccc; padding: 1rem; border-radius: 8px; width: 220px; }
        .grid { display: flex; flex-wrap: wrap; gap: 1rem; }
        .alert-success { color: green; margin-bottom: 1rem; font-weight: bold; }
        .alert-error { color: red; margin-bottom: 1rem; font-weight: bold; }
    </style>
</head>
<body>
    <nav class="nav">
        <a href="{{ route('home') }}">Beranda (Katalog)</a>
        
        @auth
            <a href="{{ route('cart.index') }}">Keranjang Belanja</a>
            <a href="{{ route('history') }}">Riwayat Pesanan</a>
            <form action="{{ route('logout') }}" method="POST" style="margin-left: auto;">
                @csrf
                Halo, {{ auth()->user()->nama_lengkap }} | <button type="submit">Logout</button>
            </form>
        @else
            <div style="margin-left: auto;">
                <a href="{{ route('login') }}">Login</a> | 
                <a href="{{ route('register') }}">Register</a>
            </div>
        @endauth
    </nav>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    <main>
        @yield('content')
    </main>
</body>
</html>