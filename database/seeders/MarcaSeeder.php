<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Marca;
class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Marca::create(['marca' => 'Bambozzi']);
        Marca::create(['marca' => 'Brazuca']);
        Marca::create(['marca' => 'Corona']);
        Marca::create(['marca' => 'Ferton']);
        Marca::create(['marca' => 'Ingco']);
        Marca::create(['marca' => 'Mace Plus']);
        Marca::create(['marca' => 'Makawa']);
        Marca::create(['marca' => 'Pawermaq']);
        Marca::create(['marca' => 'Sthulz']);
        Marca::create(['marca' => 'Total']);
        Marca::create(['marca' => 'Uyustools']);
        Marca::create(['marca' => 'Zafiro']);
    }
}