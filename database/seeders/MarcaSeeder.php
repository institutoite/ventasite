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
        Marca::create(['marca' => 'Winner']);
        Marca::create(['marca' => 'Canon']);
        Marca::create(['marca' => 'Mabel']);
        Marca::create(['marca' => 'Coco Cola']);
        Marca::create(['marca' => 'Moyu']);
        Marca::create(['marca' => 'Mayu']);
    }
}
