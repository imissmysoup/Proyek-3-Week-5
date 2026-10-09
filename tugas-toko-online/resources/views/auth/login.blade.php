@extends('layouts.app')

@section('content')
    <h2>Login Pengguna</h2>
    
    @error('loginError')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <p>
            <label>Username:</label><br>
            <input type="text" name="username" required>
        </p>
        <p>
            <label>Password:</label><br>
            <input type="password" name="password" required>
        </p>
        <button type="submit">Masuk</button>
    </form>
@endsection