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
            'product_name' => 'Taladro1',
            'category_id' => 1,
            'supplier_id' => 1,
            'marca_id'=>1,
            'almacen_id'=>1,
            'product_code' => 'CR333',
            'product_garage' => 'Garaje A',
            'product_image' => 'Taladro1.jpg',
            'product_store' => 100,
            'buying_date' => '2024-02-16',
            'expire_date' => '2025-02-16',
            'buying_price' => 100,
            'selling_price' => 150,
            'precio1' => 80,
            'precio2' => 100,
            'precio3' => 200,
            'precio4' => 300,
        ]);

        Product::create([
            'product_name' => 'Taladro2',
            'category_id' => 1,
            'supplier_id' => 1,
            'marca_id'=>1,
            'almacen_id'=>1,
            'product_code' => 'CR444',
            'product_garage' => 'Garaje B',
            'product_image' => 'Taladro2.jpg',
            'product_store' => 50,
            'buying_date' => '2024-02-16',
            'expire_date' => '2025-02-16',
            'buying_price' => 100,
            'selling_price' => 150,
            'precio1' => 80,
            'precio2' => 100,
            'precio3' => 200,
            'precio4' => 300,
        ]);
        Product::create([
            'product_name' => 'Taladro3',
            'category_id' => 1,
            'supplier_id' => 1,
            'marca_id'=>1,
            'almacen_id'=>1,
            'product_code' => 'CR222',
            'product_garage' => 'Garaje C',
            'product_image' => 'Taladro3.jpg',
            'product_store' => 75,
            'buying_date' => '2024-02-16',
            'expire_date' => '2025-02-16',
            'buying_price' => 100,
            'selling_price' => 150,
            'precio1' => 80,
            'precio2' => 100,
            'precio3' => 200,
            'precio4' => 300,
        ]);
        
        Product::create([
            'product_name' => 'Taladro 4',
            'category_id' => 1,
            'supplier_id' => 1,
            'marca_id'=>1,
            'almacen_id'=>1,
            'product_code' => 'CR555',
            'product_garage' => 'Garaje D',
            'product_image' => 'Taladro4.jpg',
            'product_store' => 40,
            'buying_date' => '2024-02-16',
            'expire_date' => '2025-02-16',
            'buying_price' => 100,
            'selling_price' => 150,
            'precio1' => 80,
            'precio2' => 100,
            'precio3' => 200,
            'precio4' => 300,
        ]);
        Product::create([
            'product_name' => 'Taldro 5',
            'category_id' => 1,
            'supplier_id' => 1,
            'marca_id'=>1,
            'almacen_id'=>1,
            'product_code' => 'CRPyraminx',
            'product_garage' => 'Garaje E',
            'product_image' => 'Taladro5.jpg',
            'product_store' => 30,
            'buying_date' => '2024-02-16',
            'expire_date' => '2025-02-16',
            'buying_price' => 17.99,
            'selling_price' => 29.99,
            'precio1' => 80,
            'precio2' => 100,
            'precio3' => 200,
            'precio4' => 300,
        ]);
        
        Product::create([
            'product_name' => 'Taldro 6',
            'category_id' => 1,
            'supplier_id' => 1,
            'marca_id'=>1,
            'almacen_id'=>1,
            'product_code' => 'CRMirror',
            'product_garage' => 'Garaje F',
            'product_image' => 'Taladro6.jpg',
            'product_store' => 20,
            'buying_date' => '2024-02-16',
            'expire_date' => '2025-02-16',
            'buying_price' => 19.99,
            'selling_price' => 34.99,
            'precio1' => 80,
            'precio2' => 100,
            'precio3' => 200,
            'precio4' => 300,
        ]);
        
        Product::create([
            'product_name' => 'Taldro 7',
            'category_id' => 1,
            'supplier_id' => 1,
            'marca_id'=>1,
            'almacen_id'=>1,
            'product_code' => 'CRMegaminx',
            'product_garage' => 'Garaje G',
            'product_image' => 'Taladro7.jpg',
            'product_store' => 25,
            'buying_date' => '2024-02-16',
            'expire_date' => '2025-02-16',
            'buying_price' => 100,
            'selling_price' => 150,
            'precio1' => 80,
            'precio2' => 100,
            'precio3' => 200,
            'precio4' => 300,
        ]);
    }
}
