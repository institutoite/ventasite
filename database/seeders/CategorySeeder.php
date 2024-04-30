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
            'Taladro',
            'Amoladora',
            'Hidrolavadora',
            'Power',
        ];

        foreach ($categories as $category) {
                Category::create([
                'name' => $category,
                'slug' => \Illuminate\Support\Str::slug($category), // Genera un slug a partir del nombre de la categoría
            ]);
        }
    }
}
