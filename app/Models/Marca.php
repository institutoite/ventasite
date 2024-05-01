<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Marca extends Model
{
    use HasFactory,Sortable;

    protected $fillable = [
        'marca',
    ];

    protected $sortable = [
        'marca',
    ];

    protected $guarded = [
        'id',
    ];

    public function productos()
    {
        return $this->hasOne(Marca::class);
    }
   

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('marca', 'like', '%' . $search . '%');
        });
    }
}
