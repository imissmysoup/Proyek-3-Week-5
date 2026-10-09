@extends('layouts.app')

@section('content')
    <h2>Katalog Barang</h2>
    <div class="grid">
        @foreach($products as $product)
            <div class="card">
                <!-- Placeholder untuk Gambar -->
                <div style="width: 100%; height: 120px; background: #eee; margin-bottom: 10px; display: flex; align-items: center; justify-content: center;">
                    📷 {{ $product->gambar ?? 'Tanpa Gambar' }}
                </div>
                
                <h3>{{ $product->nama_barang }}</h3>
                <p>Harga: Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                <p>Sisa Stok: <strong>{{ $product->stok }}</strong></p>
                
                <!-- Jika belum login, arahkan ke halaman login. Jika sudah, post ke keranjang -->
                @auth
                    @if($product->stok > 0)
                        <form action="{{ route('cart.add', $product->id_barang) }}" method="POST">
                            @csrf
                            <button type="submit" style="background: blue; color: white; padding: 5px 10px; border: none; cursor:pointer;">+ Keranjang</button>
                        </form>
                    @else
                        <button disabled style="background: gray; color: white; padding: 5px 10px; border: none;">Stok Habis</button>
                    @endif
                @else
                    <p style="font-size: 0.8rem; color: gray;"><em>*Login untuk membeli</em></p>
                @endauth
            </div>
        @endforeach
    </div>
@endsection