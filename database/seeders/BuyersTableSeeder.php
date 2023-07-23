<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buyer;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class BuyersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ambil semua user dengan peran "buyer" (hanya 8 data)
        $buyers = \App\Models\User::where('role', 'buyer')->get();

        // Jika belum ada user dengan peran "buyer", maka skip seeder ini
        if ($buyers->isEmpty()) {
            return;
        }

        // Menyimpan data buyer terhubung dengan user pembeli yang ada
        foreach ($buyers as $buyer) {
            Buyer::create([
                'name' => $buyer->name,
                'birth_date' => Carbon::now()->subYears(rand(18, 60)), // Contoh: pembeli berusia 18-60 tahun
                'gender' => $buyer->gender,
                'address' => 'Alamat pembeli ' . $buyer->name,
                'ktp_image_path' => 'path/to/ktp_' . $buyer->name . '.jpg',
                'user_id' => $buyer->id,
            ]);
        }
    }
}
