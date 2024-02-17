<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'product_name' => 'Cubo Rubik 3x3x3',
            'category_id' => 1,
            'supplier_id' => 1,
            'marca_id'=>1,
            'product_code' => 'CR333',
            'product_garage' => 'Garaje A',
            'product_image' => 'cubo_rubik_3x3x3.jpg',
            'product_store' => 100,
            'buying_date' => '2024-02-16',
            'expire_date' => '2025-02-16',
            'buying_price' => 10.99,
            'selling_price' => 19.99,
        ]);

        Product::create([
            'product_name' => 'Cubo Rubik 4x4x4',
            'category_id' => 1,
            'supplier_id' => 1,
            'marca_id'=>1,
            'product_code' => 'CR444',
            'product_garage' => 'Garaje B',
            'product_image' => 'cubo_rubik_4x4x4.jpg',
            'product_store' => 50,
            'buying_date' => '2024-02-16',
            'expire_date' => '2025-02-16',
            'buying_price' => 15.99,
            'selling_price' => 29.99,
        ]);
        Product::create([
            'product_name' => 'Cubo Rubik 2x2x2',
            'category_id' => 1,
            'supplier_id' => 1,
            'marca_id'=>1,
            'product_code' => 'CR222',
            'product_garage' => 'Garaje C',
            'product_image' => 'cubo_rubik_2x2x2.jpg',
            'product_store' => 75,
            'buying_date' => '2024-02-16',
            'expire_date' => '2025-02-16',
            'buying_price' => 8.99,
            'selling_price' => 14.99,
        ]);
        
        Product::create([
            'product_name' => 'Cubo Rubik 5x5x5',
            'category_id' => 1,
            'supplier_id' => 1,
            'marca_id'=>1,
            'product_code' => 'CR555',
            'product_garage' => 'Garaje D',
            'product_image' => 'cubo_rubik_5x5x5.jpg',
            'product_store' => 40,
            'buying_date' => '2024-02-16',
            'expire_date' => '2025-02-16',
            'buying_price' => 22.99,
            'selling_price' => 39.99,
        ]);
        Product::create([
            'product_name' => 'Cubo Rubik Pyraminx',
            'category_id' => 1,
            'supplier_id' => 1,
            'marca_id'=>1,
            'product_code' => 'CRPyraminx',
            'product_garage' => 'Garaje E',
            'product_image' => 'cubo_rubik_pyraminx.jpg',
            'product_store' => 30,
            'buying_date' => '2024-02-16',
            'expire_date' => '2025-02-16',
            'buying_price' => 17.99,
            'selling_price' => 29.99,
        ]);
        
        Product::create([
            'product_name' => 'Cubo Rubik Mirror',
            'category_id' => 1,
            'supplier_id' => 1,
            'marca_id'=>1,
            'product_code' => 'CRMirror',
            'product_garage' => 'Garaje F',
            'product_image' => 'cubo_rubik_mirror.jpg',
            'product_store' => 20,
            'buying_date' => '2024-02-16',
            'expire_date' => '2025-02-16',
            'buying_price' => 19.99,
            'selling_price' => 34.99,
        ]);
        
        Product::create([
            'product_name' => 'Cubo Rubik Megaminx',
            'category_id' => 1,
            'supplier_id' => 1,
            'marca_id'=>1,
            'product_code' => 'CRMegaminx',
            'product_garage' => 'Garaje G',
            'product_image' => 'cubo_rubik_megaminx.jpg',
            'product_store' => 25,
            'buying_date' => '2024-02-16',
            'expire_date' => '2025-02-16',
            'buying_price' => 24.99,
            'selling_price' => 44.99,
        ]);
        
        
    }
}
