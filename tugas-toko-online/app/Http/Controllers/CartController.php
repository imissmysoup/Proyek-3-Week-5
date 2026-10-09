<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['harga'] * $item['jumlah']);
        }, 0);

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $id_barang)
    {
        $product = Product::findOrFail($id_barang);
        $cart = session()->get('cart', []);

        if (isset($cart[$id_barang])) {
            // Cek apakah jumlah melebihi stok
            if ($cart[$id_barang]['jumlah'] + 1 > $product->stok) {
                return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
            }
            $cart[$id_barang]['jumlah']++;
        } else {
            // Cek apakah stok cukup
            if ($product->stok < 1) {
                return back()->with('error', 'Stok barang habis.');
            }
            $cart[$id_barang] = [
                'id_barang' => $product->id_barang,
                'nama_barang' => $product->nama_barang,
                'harga' => $product->harga,
                'jumlah' => 1,
                'gambar' => $product->gambar,
                'stok' => $product->stok
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('home')->with('success', 'Barang ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id_barang)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id_barang])) {
            $product = Product::findOrFail($id_barang);
            $newQuantity = $request->jumlah;

            if ($newQuantity > $product->stok) {
                return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
            } elseif ($newQuantity < 1) {
                 return back()->with('error', 'Jumlah minimal 1.');
            }

            $cart[$id_barang]['jumlah'] = $newQuantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Keranjang diperbarui.');
    }

    public function remove($id_barang)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id_barang])) {
            unset($cart[$id_barang]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Barang dihapus dari keranjang.');
    }
}