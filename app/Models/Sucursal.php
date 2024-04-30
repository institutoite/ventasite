<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sucursal')
            ->withPivot(['stock']);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
