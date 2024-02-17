<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
            'name' => 'Proveedor Uno',
            'email' => 'proveedor1@example.com',
            'phone' => '1234567890',
            'address' => 'Calle Principal, Ciudad, País',
            'shopname' => 'Tienda del Proveedor Uno',
            'photo' => 'proveedor1.jpg',
            'type' => 'Tipo de Proveedor',
            'account_holder' => 'Titular de la Cuenta',
            'account_number' => '123456789',
            'bank_name' => 'Nombre del Banco',
            'bank_branch' => 'Sucursal del Banco',
            'city' => 'Ciudad del Proveedor Uno',
        ]);

        Supplier::create([
            'name' => 'Proveedor Dos',
            'email' => 'proveedor2@example.com',
            'phone' => '9876543210',
            'address' => 'Calle Secundaria, Ciudad, País',
            'shopname' => 'Tienda del Proveedor Dos',
            'photo' => 'proveedor2.jpg',
            'type' => 'Otro Tipo de Proveedor',
            'account_holder' => 'Titular de la Otra Cuenta',
            'account_number' => '987654321',
            'bank_name' => 'Otro Banco',
            'bank_branch' => 'Otra Sucursal del Banco',
            'city' => 'Ciudad del Proveedor Dos',
        ]);
        Supplier::create([
            'name' => 'Proveedor Tres',
            'email' => 'proveedor3@example.com',
            'phone' => '5551234567',
            'address' => 'Avenida Principal, Ciudad, País',
            'shopname' => 'Tienda del Proveedor Tres',
            'photo' => 'proveedor3.jpg',
            'type' => 'Proveedor de Electrónica',
            'account_holder' => 'Titular de la Cuenta Tres',
            'account_number' => '987654321',
            'bank_name' => 'Banco Tres',
            'bank_branch' => 'Sucursal Tres',
            'city' => 'Ciudad del Proveedor Tres',
        ]);

        Supplier::create([
            'name' => 'Proveedor Cuatro',
            'email' => 'proveedor4@example.com',
            'phone' => '5559876543',
            'address' => 'Calle Secundaria, Ciudad, País',
            'shopname' => 'Tienda del Proveedor Cuatro',
            'photo' => 'proveedor4.jpg',
            'type' => 'Proveedor de Ropa',
            'account_holder' => 'Titular de la Cuenta Cuatro',
            'account_number' => '123456789',
            'bank_name' => 'Banco Cuatro',
            'bank_branch' => 'Sucursal Cuatro',
            'city' => 'Ciudad del Proveedor Cuatro',
        ]);
    }
}
