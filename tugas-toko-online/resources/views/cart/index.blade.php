@extends('layouts.app')

@section('content')
    <h2>Keranjang Belanja</h2>

    @if(count($cart) > 0)
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-bottom: 20px;">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $details)
                    <tr>
                        <td align="center">
                            <div style="width: 50px; height: 50px; background: #eee; display: flex; align-items: center; justify-content: center;">
                                📷
                            </div>
                        </td>
                        <td>{{ $details['nama_barang'] }}</td>
                        <td>Rp {{ number_format($details['harga'], 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.update', $id) }}" method="POST">
                                @csrf
                                <input type="number" name="jumlah" value="{{ $details['jumlah'] }}" min="1" max="{{ $details['stok'] }}" style="width: 60px;">
                                <button type="submit">Update</button>
                            </form>
                        </td>
                        <td>Rp {{ number_format($details['harga'] * $details['jumlah'], 0, ',', '.') }}</td>
                        <td align="center">
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                <button type="submit" style="background: red; color: white; border: none; padding: 5px;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" align="right"><strong>Total Harga</strong></td>
                    <td colspan="2"><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <div style="text-align: right;">
            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <button type="submit" style="background: green; color: white; padding: 10px 20px; font-size: 16px;">Checkout Sekarang</button>
            </form>
        </div>
    @else
        <p>Keranjang belanja Anda masih kosong.</p>
        <a href="{{ route('home') }}">Belanja Sekarang</a>
    @endif
@endsection