<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sucursal;
class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Sucursal 1
         Sucursal::create([
            'name' => 'ITE CENTRAL',
            'phone' => '75553338',
            'address' => 'Villa 1 de mayo, calle 16 Oeste #9 entre Av. Che Guevara y Av. Tres pasos al frente',
            'latitude' => '-17.8019645',
            'longitude' => '-63.1358837',
            'active' => true,
        ]);

        // Sucursal 2
        Sucursal::create([
            'name' => 'Sucursal Villa 1 de Mayo',
            'phone' => '71324941',
            'address' => 'Villa 1 de mayo  Av. Tres pasos al frente esquina Che Guevara #4710(Curva de la villa)',
            'latitude' => '-17.8019645',
            'longitude' => '-63.1358837',
            'active' => true,
        ]);

        // Sucursal 3
        Sucursal::create([
            'name' => 'Sucursal Plan 3000',
            'phone' => '71039910',
            'address' => 'Avenicha 18 de Marzo esquina Av. Prolongacion Che Guevara',
            'latitude' => '-17.8164641',
            'longitude' => '-63.1394911',
            'active' => false,
        ]);
        Sucursal::create([
            'name' => 'Sucursal Cube Academy',
            'phone' => '71039910',
            'address' => 'Segundo anillo Av 6 de Febrero',
            'latitude' => '-17.782485',
            'longitude' => '-63.1948316',
            'active' => false,
        ]);
    }
}
