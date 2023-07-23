<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Buyer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Validator;


class StaffController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk staff.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Misalkan, kita ingin menampilkan daftar semua pengguna (users) yang terdaftar sebagai staff
        $staffs = User::where('role', 'staff')->get();

        return view('staff.dashboard', compact('staffs'));
    }

    public function manageProducts()
    {
        $products = Product::paginate(10);
        return view('staff.manage_products', compact('products'));
    }

    public function addProductForm()
    {
        return view('staff.add_product');
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'product_type' => 'required|in:Elektronik,Fashion,Makanan,Minuman,Kecantikan',
            'stock' => 'required|integer|min:0',
            'buy_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePaths = ['laptop_asus.jpg', 'samsung_a32.jpg', 'product_image.jpg'];
        $randomImagePath = $imagePaths[array_rand($imagePaths)];


        // Buat produk baru dengan data dari form
        $product = new Product([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'product_type' => $request->input('product_type'),
            'stock' => $request->input('stock'),
            'buy_price' => $request->input('buy_price'),
            'sell_price' => $request->input('sell_price'),
            'image_path' => $randomImagePath,
        ]);

        // Simpan produk ke dalam database
        $product->save();

        // Redirect kembali ke halaman manajemen produk dengan pesan sukses
        return redirect()->route('staff.manageProducts')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function editProductForm($id)
    {
        $product = Product::findOrFail($id);
        return view('staff.edit_product', compact('product'));
    }


    public function editProduct(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('staff.manageProducts')->with('error', 'Produk tidak ditemukan');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'product_type' => 'required|in:Elektronik,Fashion,Makanan,Minuman,Kecantikan',
            'stock' => 'required|integer|min:0',
            'buy_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024', // Max 1MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->product_type = $request->product_type;
        $product->stock = $request->stock;
        $product->buy_price = $request->buy_price;
        $product->sell_price = $request->sell_price;

        if ($request->hasFile('image_path')) {
            // Hapus gambar lama jika ada
            if ($product->image_path) {
                Storage::delete('public/' . $product->image_path);
            }

            $image_path = $request->file('image_path')->store('public/product_images');
            $product->image_path = str_replace('public/', '', $image_path);
        }

        $product->save();

        return redirect()->route('staff.manageProducts')->with('success', 'Produk berhasil diperbarui');
    }


    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('staff.manageProducts')->with('success', 'Produk berhasil dihapus.');
    }

    public function indexBuyers()
    {
        $buyers = Buyer::paginate(10);
        return view('staff.manage_buyers', compact('buyers'));
    }

    public function createBuyer()
    {
        return view('staff.add_buyer');
    }

    public function storeBuyer(Request $request)
    {
        $request->validate([
            // Validasi lainnya...
            'email' => 'required|email|unique:users,email',
        ], [
            'email.unique' => 'Email sudah digunakan oleh user lain.',
        ]);

        // Upload foto KTP ke dalam storage/public
        $ktpImagePath = $request->file('ktp_image')->store('public');

        // Ambil nama file foto KTP untuk disimpan ke dalam database
        $ktpImageName = basename($ktpImagePath);

        // Tambahkan data user ke dalam tabel users
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make('password'), // Enkripsi password menjadi 'password'
        ]);
        $user->save();

        // Tambahkan pembeli ke dalam tabel buyers
        $buyer = new Buyer([
            'name' => $request->input('name'),
            'birth_date' => $request->input('birth_date'),
            'gender' => $request->input('gender'),
            'address' => $request->input('address'),
            'ktp_image_path' => $ktpImageName,
            'user_id' => $user->id, // Simpan user ID ke dalam kolom user_id di tabel buyers
        ]);
        $buyer->save();

        // Redirect kembali ke halaman manajemen pembeli dengan pesan sukses
        return redirect()->route('staff.manageBuyers')->with('success', 'Pembeli berhasil ditambahkan.');
    }


    public function editBuyer($id)
    {
        $buyer = Buyer::find($id);

        if (!$buyer) {
            return redirect()->route('staff.manageBuyers')->with('error', 'Pembeli tidak ditemukan');
        }

        return view('staff.edit_buyer', compact('buyer'));
    }

    public function updateBuyer(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'gender' => 'required|in:Male,Female',
            'address' => 'nullable|string',
            'email' => 'required|email',
            'ktp_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $buyer = Buyer::find($id);

        if (!$buyer) {
            return redirect()->route('staff.manageBuyers')->with('error', 'Pembeli tidak ditemukan');
        }

        $buyer->name = $request->input('name');
        $buyer->birth_date = $request->input('birth_date');
        $buyer->gender = $request->input('gender');
        $buyer->address = $request->input('address');

        // Upload foto KTP ke dalam storage/public jika ada perubahan gambar
        if ($request->hasFile('ktp_image')) {
            $ktpImagePath = $request->file('ktp_image')->store('public');
            $ktpImageName = basename($ktpImagePath);
            $buyer->ktp_image_path = $ktpImageName;
        }

        // Simpan perubahan data pembeli
        $buyer->save();

        // Update data user yang terkait dengan pembeli hanya jika email berbeda
        if ($buyer->user->email !== $request->input('email')) {
            $request->validate([
                'email' => 'unique:users,email',
            ], [
                'email.unique' => 'Email sudah digunakan oleh user lain.',
            ]);

            $user = $buyer->user;
            $user->email = $request->input('email');
            $user->save();
        }

        return redirect()->route('staff.manageBuyers')->with('success', 'Pembeli berhasil diperbarui.');
    }


    public function deleteBuyer($id)
    {
        $buyer = Buyer::find($id);

        if (!$buyer) {
            return redirect()->route('staff.manageBuyers')->with('error', 'Pembeli tidak ditemukan');
        }

        $buyer->delete();

        return redirect()->route('staff.manageBuyers')->with('success', 'Pembeli berhasil dihapus.');
    }
}
