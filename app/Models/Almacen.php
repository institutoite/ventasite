<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Almacen extends Model
{
    use HasFactory,Sortable;
    protected $fillable = [
        'almacen',
    ];

    protected $sortable = [
        'almacen',
    ];

    protected $guarded = [
        'id',
    ];

    
    public function producto()
    {
        return $this->hasOne(Almacen::class);
    }
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('almacen', 'like', '%' . $search . '%');
        });
    }
}
