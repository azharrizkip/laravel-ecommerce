<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class BuyerController extends Controller
{
     /**
     * Menampilkan halaman dashboard untuk pembeli dengan daftar produk.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Misalkan, kita ingin menampilkan semua produk dengan pagination
        $products = Product::paginate(10);

        return view('buyer.dashboard', compact('products'));
    }

    public function addToCart(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->route('buyer.dashboard')->with('error', 'Produk tidak ditemukan.');
        }

        // Ambil data keranjang belanja dari session
        $cart = Session::get('cart', []);

        // Tambahkan produk ke dalam keranjang belanja
        $cart[$productId] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'sell_price' => $product->sell_price,
        ];

        // Simpan kembali data keranjang belanja ke session
        Session::put('cart', $cart);

        return redirect()->route('buyer.dashboard')->with('success', 'Produk berhasil ditambahkan ke keranjang belanja.');
    }

    public function removeFromCart(Request $request, $productId)
    {
        // Ambil data keranjang belanja dari session
        $cart = Session::get('cart', []);

        // Hapus produk dari keranjang belanja
        unset($cart[$productId]);

        // Simpan kembali data keranjang belanja ke session
        Session::put('cart', $cart);

        return redirect()->route('buyer.dashboard')->with('success', 'Produk berhasil dihapus dari keranjang belanja.');
    }
}
