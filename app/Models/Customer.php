<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class Customer extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'shopname',
        'empresa',
        'photo',
        'account_holder',
        'account_number',
        'bank_name',
        'bank_branch',
        'city',
        'fecha',
    ];
    public $sortable = [
        'name',
        'email',
        'phone',
        'shopname',
        'city',
        'fecha',
        'empresa',
    ];

    protected $guarded = [
        'id',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')->orWhere('shopname', 'like', '%' . $search . '%');
        });
    }
}
