@extends('layouts.app')

@section('content')
    <h2>Daftar Akun Baru</h2>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <p>
            <label>Nama Lengkap:</label><br>
            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
            @error('nama_lengkap') <span style="color:red">{{ $message }}</span> @enderror
        </p>
        <p>
            <label>Email:</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <span style="color:red">{{ $message }}</span> @enderror
        </p>
        <p>
            <label>Username:</label><br>
            <input type="text" name="username" value="{{ old('username') }}" required>
            @error('username') <span style="color:red">{{ $message }}</span> @enderror
        </p>
        <p>
            <label>Password:</label><br>
            <input type="password" name="password" required minlength="6">
            @error('password') <span style="color:red">{{ $message }}</span> @enderror
        </p>
        <p>
            <label>No. HP:</label><br>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}">
        </p>
        <p>
            <label>Alamat:</label><br>
            <textarea name="alamat">{{ old('alamat') }}</textarea>
        </p>
        <button type="submit">Daftar Sekarang</button>
    </form>
@endsection