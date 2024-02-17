<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Dulces',
            'Galletas',
            'Sodas',
            'chicles',
            'cubos',
            'cuadernos',
            'borradores',
            'tajadores',
            'lapices',
            'lapiceros',
            'marcadores',

            // Agrega más categorías si lo deseas
        ];

        // Itera sobre el array y crea una nueva entrada en la base de datos para cada categoría
        foreach ($categories as $category) {
                Category::create([
                'name' => $category,
                'slug' => \Illuminate\Support\Str::slug($category), // Genera un slug a partir del nombre de la categoría
            ]);
        }
    }
}
