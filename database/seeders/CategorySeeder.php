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
                'telefono' => $this->getRandomPhone(),
                'slug' => \Illuminate\Support\Str::slug($category), // Genera un slug a partir del nombre de la categoría
            ]);
        }
    }
    private function getRandomPhone()
    {
        $possibleCounts = ["71039910", "71324941", "75553338", "67855168"]; // Definir aquí tus posibles valores para count
        $randomIndex = random_int(0, count($possibleCounts) - 1);
        return $possibleCounts[$randomIndex];
    }
}
