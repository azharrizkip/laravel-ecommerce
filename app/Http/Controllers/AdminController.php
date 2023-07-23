<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Validator;

class AdminController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk admin.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Misalkan, kita ingin menampilkan daftar semua pengguna (users) yang terdaftar sebagai admin
        $admins = User::where('role', 'admin')->get();

        return view('admin.dashboard', compact('admins'));
    }

    public function manageStaff()
    {
        // Ambil data staff dari database (misalnya dari tabel "users" dengan peran "staff")
        $staff = \App\Models\User::where('role', 'staff')->get();

        return view('admin.manage_staff', compact('staff'));
    }

    public function addStaffForm()
    {
        return view('admin.add_staff');
    }

    public function addStaff(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'gender' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
            ]);

            $validatedData['role'] = 'staff';
            $validatedData['password'] = Hash::make($validatedData['password']); // Enkripsi password

            User::create($validatedData);

            return redirect()->route('admin.manageStaff')->with('success', 'Staff berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan staff: ' . $e->getMessage());
        }
    }

    public function editStaffForm($id)
    {
        $staff = User::findOrFail($id);

        return view('admin.edit_staff', compact('staff'));
    }

    public function editStaff(Request $request, $id)
    {
        $staff = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:users,email,' . $staff->id, // Pastikan email unik kecuali untuk staff saat ini
            'password' => 'nullable|min:8|confirmed', // Password boleh kosong, atau minimal 8 karakter dan sama dengan password_confirmation
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password); // Enkripsi password baru jika diisi
        } else {
            unset($validatedData['password']); // Jika password tidak diisi, jangan update password
        }

        $staff->update($validatedData);

        return redirect()->route('admin.manageStaff')->with('success', 'Staff berhasil diubah.');
    }

    public function deleteStaff($id)
    {
        $staff = User::findOrFail($id);
        $staff->delete();

        return redirect()->route('admin.manageStaff')->with('success', 'Staff berhasil dihapus.');
    }

    public function manageProducts()
    {
        $products = Product::paginate(10);
        return view('admin.manage_products', compact('products'));
    }

    public function addProductForm()
    {
        return view('admin.add_product');
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
        return redirect()->route('admin.manageProducts')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function editProductForm($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit_product', compact('product'));
    }


    public function editProduct(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('admin.manageProducts')->with('error', 'Produk tidak ditemukan');
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

        return redirect()->route('admin.manageProducts')->with('success', 'Produk berhasil diperbarui');
    }


    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.manageProducts')->with('success', 'Produk berhasil dihapus.');
    }

}
