<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Logitech G502 Lightspeed Wireless Gaming Mouse',
                'price' => 149.99,
                'description' => 'Logitech G502 Lightspeed Wireless Gaming Mouse is a high-performance wireless gaming mouse with a rechargeable battery that lasts up to 48 hours on a single charge.',
                'category' => 'Electronics',
                'status' => Product::PUBLISHED_STATUS
            ],
            [
                'name' => 'Samsung Galaxy S21 5G',
                'price' => 799.99,
                'description' => 'The Samsung Galaxy S21 5G is a powerful Android smartphone with a 6.2-inch touchscreen display, a 4500mAh battery, and a 50MP camera.',
                'category' => 'Electronics',
                'status' => Product::DRAFTED_STATUS
            ],
            [
                'name' => 'Apple Watch Series 7',
                'price' => 399.00,
                'description' => 'The Apple Watch Series 7 is a smartwatch with a 44mm touchscreen display, a built-in GPS, and a heart rate monitor.',
                'category' => 'Electronics',
                'status' => Product::PUBLISHED_STATUS
            ],
            [
                'name' => 'Sony WH-1000XM4 Wireless Noise Canceling Headphones',
                'price' => 349.99,
                'description' => 'The Sony WH-1000XM4 Wireless Noise Canceling Headphones are a pair of wireless headphones with advanced noise-cancellation technology and a long-lasting battery.',
                'category' => 'Electronics',
                'status' => Product::DRAFTED_STATUS
            ],
            [
                'name' => 'Nintendo Switch OLED Model',
                'price' => 359.99,
                'description' => 'The Nintendo Switch OLED Model is a handheld gaming console with a 7-inch OLED touchscreen display, a battery life of up to 9 hours, and a variety of games.',
                'category' => 'Gaming',
                'status' => Product::PUBLISHED_STATUS
            ],
            [
                'name' => 'Canon EOS Rebel T8i',
                'price' => 749.00,
                'description' => 'The Canon EOS Rebel T8i is a DSLR camera with a 24.2MP sensor, a 3-inch touchscreen display, and a vari-angle LCD screen.',
                'category' => 'Electronics',
                'status' => Product::PUBLISHED_STATUS
            ],
            [
                'name' => 'PlayStation 5 Console',
                'price' => 499.99,
                'description' => 'The PlayStation 5 Console is a next-generation gaming console with a 2TB SSD, a 10.3 TFLOP AMD Radeon GPU, and a 3D audio system.',
                'category' => 'Gaming',
                'status' => Product::PUBLISHED_STATUS
            ],
            [
                'name' => 'Lenovo ThinkPad X1 Carbon',
                'price' => '1331.10',
                'description' => 'The Lenovo ThinkPad X1 Carbon is a business laptop with a 14-inch touchscreen display, an Intel Core i7 processor, and a 16GB RAM.',
                'category' => 'Electronics',
                'status' => Product::PUBLISHED_STATUS
            ],
            [
                'name' => 'Microsoft Surface Pro 8',
                'price' => 899.00,
                'description' => 'The Microsoft Surface Pro 8 is a 2-in-1 tablet with a 13-inch PixelSense touchscreen display, an Intel Core i5 processor, and a 8GB RAM.',
                'category' => 'Electronics',
                'status' => Product::DRAFTED_STATUS
            ],
            [
                'name' => 'HP Envy 13',
                'price' => 699.99,
                'description' => 'The HP Envy 13 is a laptop with a 13.3-inch touchscreen display, an Intel Core i7 processor, and a 16GB RAM.',
                'category' => 'Electronics',
                'status' => Product::PUBLISHED_STATUS
            ],
            [
                'name' => 'Apple MacBook Air',
                'price' => 999.00,
                'description' => 'The Apple MacBook Air is a laptop with a 13.3-inch Retina display, an Intel Core i5 processor, and a 8GB RAM.',
                'category' => 'Electronics',
                'status' => Product::DRAFTED_STATUS
            ],
            [
                'name' => 'Dell XPS 13',
                'price' => 999.99,
                'description' => 'The Dell XPS 13 is a laptop with a 13.4-inch touchscreen display, an Intel Core i7 processor, and a 16GB RAM.',
                'category' => 'Electronics',
                'status' => Product::PUBLISHED_STATUS
            ],
            [
                'name' => 'Asus ZenBook 14',
                'price' => 699.00,
                'description' => 'The Asus ZenBook 14 is a laptop with a 14-inch touchscreen display, an Intel Core i5 processor, and a 8GB RAM.',
                'category' => 'Electronics',
                'status' => Product::PUBLISHED_STATUS
            ],
            [
                'name' => 'Google Pixel 6',
                'price' => 599.00,
                'description' => 'The Google Pixel 6 is a high-performance Android smartphone with a 6.0-inch touchscreen display, a 4614mAh battery, and a 50MP camera.',
                'category' => 'Electronics',
                'status' => Product::DRAFTED_STATUS
            ],
            [
                'name' => 'Samsung Galaxy Tab S7 FE',
                'price' => 529.99,
                'description' => 'The Samsung Galaxy Tab S7 FE is a powerful Android tablet with a 12.4-inch touchscreen display, a 10090mAh battery, and a 13MP camera.',
                'category' => 'Electronics',
                'status' => Product::PUBLISHED_STATUS
            ],
            [
                'name' => 'Canon EOS M50 Mark II',
                'price' => 699.00,
                'description' => 'The Canon EOS M50 Mark II is a mirrorless camera with a 24.2MP sensor, a 3-inch touchscreen display, and a vari-angle LCD screen.',
                'category' => 'Electronics',
                'status' => Product::DRAFTED_STATUS
            ],
            [
                'name' => 'Sony Alpha a6400',
                'price' => 998.00,
                'description' => 'The Sony Alpha a6400 is a mirrorless camera with a 24.2MP sensor, a 3-inch touchscreen display, and a vari-angle LCD screen.',
                'category' => 'Electronics',
                'status' => Product::PUBLISHED_STATUS
            ],
            [
                'name' => 'Apple AirPods Pro',
                'price' => 249.00,
                'description' => 'The Apple AirPods Pro are a pair of wireless earbuds with active noise-cancellation technology and a charging case.',
                'category' => 'Electronics',
                'status' => Product::DRAFTED_STATUS
            ],
            [
                'name' => 'Bose QuietComfort Earbuds',
                'price' => 249.95,
                'description' => 'The Bose QuietComfort Earbuds are a pair of wireless earbuds with advanced noise-cancellation technology and a charging case.',
                'category' => 'Electronics',
                'status' => Product::PUBLISHED_STATUS
            ],
            [
                'name' => 'Sony WH-CH710N Wireless Noise Canceling Headphones',
                'price' => 179.99,
                'description' => 'The Sony WH-CH710N Wireless Noise Canceling Headphones are a pair of wireless headphones with advanced noise-cancellation technology and a long-lasting battery.',
                'category' => 'Electronics',
                'status' => Product::DRAFTED_STATUS
            ],
            [
                'name' => 'Beats Solo Pro',
                'price' => 299.95,
                'description' => 'The Beats Solo Pro is a pair of wireless headphones with active noise-cancellation technology and a charging case.',
                'category' => 'Electronics',
                'status' => Product::PUBLISHED_STATUS
            ],
            [
                'name' => 'Powerbeats Pro 2',
                'price' => 199.95,
                'description' => 'The Powerbeats Pro 2 are a pair of wireless earbuds with active noise-cancellation technology and a charging case.',
                'category' => 'Electronics',
                'status' => Product::DRAFTED_STATUS
            ],
        ];

        foreach ($products as $product_data) {
            $product = Product::create($product_data);
            $cover = database_path('seeders/files/' . implode('-', explode(' ', $product_data['name'])) . '.jpg');
            if (file_exists($cover)) {
                $product->addMedia($cover)->preservingOriginal()->toMediaCollection(Product::COVER_MEDIA_COLLECTION);
            }
        }
    }
}
