<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;

class OrderController extends Controller
{
    // Fungsi untuk memproses Checkout
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        
        // Cek apakah keranjang kosong
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $user = Auth::user();
        
        // Hitung total harga murni dari sesi keranjang (harga sudah aman dari database)
        $totalHarga = array_reduce($cart, function ($carry,$item) {
            return $carry + ($item['harga'] *$item['jumlah']);
        }, 0);

        // Mulai Transaksi Database
        DB::beginTransaction();
        try {
            // 1. Buat ID Order Unik (Misal: ORD-A1B2C)
            $idOrder = 'ORD-' . strtoupper(substr(uniqid(), -5));
            
            // 2. Simpan ke tabel `orders`
            Order::create([
                'id_order' => $idOrder,
                'id_user' => $user->id_user,
                'tanggal_order' => now(),
                'total_harga' => $totalHarga,
                'alamat_pengiriman' => $user->alamat ?? 'Alamat belum diatur'
            ]);

            // 3. Simpan setiap item ke tabel `order_details` dan kurangi stok `products`
            foreach ($cart as $id_barang =>$item) {
                OrderDetail::create([
                    'id_order' => $idOrder,
                    'id_barang' => $id_barang,
                    'harga_satuan' => $item['harga'],
                    'jumlah_beli' => $item['jumlah']
                ]);

                // Kurangi stok barang
                $product = Product::findOrFail($id_barang);
                
                // Pastikan stok tidak minus di detik-detik terakhir
                if ($product->stok <$item['jumlah']) {
                    throw new \Exception("Stok {$product->nama_barang} tidak mencukupi.");
                }
                
                $product->stok -= $item['jumlah'];$product->save();
            }

            // 4. Jika semua sukses, komit (sahkan) transaksi ke database
            DB::commit();
            
            // 5. Kosongkan keranjang belanja
            session()->forget('cart');

            return redirect()->route('history')->with('success', 'Checkout berhasil! Pesanan Anda sedang diproses.');

        } catch (\Exception $e) {
            // Jika ada yang gagal, batalkan semua proses
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', 'Gagal checkout: ' . $e->getMessage());
        }
    }

    // Fungsi untuk menampilkan Riwayat Pesanan
    public function history()
    {
        $user = Auth::user();
        
        // Ambil data order milik user yang login, gabungkan (Eager Load) dengan details dan products
        $orders = Order::where('id_user',$user->id_user)
            ->with('details.product')
            ->orderBy('tanggal_order', 'desc')
            ->get();

        return view('order.history', compact('orders'));
    }
}