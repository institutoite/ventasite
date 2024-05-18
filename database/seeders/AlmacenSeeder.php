<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Almacen;
class AlmacenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Almacen::create(["almacen" => 'Abeltron']);
        Almacen::create(["almacen" => 'Av. Brasil']);
        Almacen::create(["almacen" => 'Corona']);
        Almacen::create(["almacen" => 'Toyomaq']);
        Almacen::create(["almacen" => 'Ximcruz']);
        Almacen::create(["almacen" => 'Zafiro']);

    }
}
