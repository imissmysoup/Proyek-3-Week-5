@extends('layouts.app')

@section('content')
    <h2>Riwayat Pesanan Anda</h2>

    @if($orders->count() > 0)
        @foreach($orders as $order)
            <div class="card" style="width: 100%; margin-bottom: 2rem; border: 1px solid #333; padding: 1.5rem;">
                <div style="display: flex; justify-content: space-between; border-bottom: 1px dashed #ccc; padding-bottom: 1rem; margin-bottom: 1rem;">
                    <div>
                        <h3 style="margin: 0 0 10px 0;">No. Pesanan: {{ $order->id_order }}</h3>
                        <p style="margin: 0;"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($order->tanggal_order)->format('d M Y, H:i') }}</p>
                    </div>
                    <div style="text-align: right;">
                        <h3 style="margin: 0 0 10px 0;">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</h3>
                        <p style="margin: 0; font-size: 14px; color: gray;"><strong>Dikirim ke:</strong><br>{{ $order->alamat_pengiriman }}</p>
                    </div>
                </div>
                
                <h4>Detail Barang:</h4>
                <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                    <thead style="background-color: #f1f5f9;">
                        <tr>
                            <th align="left">Nama Barang</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th align="right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->details as $detail)
                            <tr>
                                <td>{{ $detail->product->nama_barang ?? 'Produk telah dihapus' }}</td>
                                <td align="center">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                <td align="center">{{ $detail->jumlah_beli }}</td>
                                <td align="right">Rp {{ number_format($detail->harga_satuan * $detail->jumlah_beli, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    @else
        <p>Anda belum memiliki riwayat pesanan.</p>
        <a href="{{ route('home') }}" style="color: blue; font-weight: bold;">Mulai Belanja Sekarang</a>
    @endif
@endsection