<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    public function productos()
    {
        return $this->belongsToMany(Product::class, 'product_sucursal')
            ->withPivot(['stock', 'price', 'last_restock_date', 'barcode', 'notes']);
    }

}
