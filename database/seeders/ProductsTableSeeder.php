<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $productNames = [
            'Laptop ASUS X543MA',
            'Smartphone Samsung Galaxy A32',
            'Keyboard Mechanical RGB',
            'Headphone Wireless Bluetooth',
            'Baju Kaos Basic Cotton',
            'Sepatu Sneakers Casual',
            // Tambahkan nama barang lainnya sesuai kebutuhan
        ];

        // Menyimpan 50 data produk secara acak
        for ($i = 0; $i < 50; $i++) {
            $productName = $productNames[array_rand($productNames)];
            $productDescription = $faker->paragraph(3);

            $product = Product::create([
                'name' => $productName,
                'description' => $productDescription,
                'product_type' => $faker->randomElement(['Elektronik', 'Fashion', 'Makanan', 'Minuman', 'Kecantikan']),
                'stock' => rand(1, 100),
                'buy_price' => rand(100000, 10000000),
                'sell_price' => rand(120000, 12000000),
                'image_path' => $faker->randomElement(['laptop_asus.jpg', 'samsung_a32.jpg', 'product_image.jpg']),
            ]);
        }
    }
}
