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
        Marca::create(['marca' => 'Total']);
        Marca::create(['marca' => 'Ferton']);
        Marca::create(['marca' => 'Ketaquic']);
        Marca::create(['marca' => 'Uyustools']);
    }
}