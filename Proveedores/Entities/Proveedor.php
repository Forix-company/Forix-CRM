<?php

namespace Modules\Proveedores\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $fillable = [
        'nit',
        'name_supplier',
        'email',
        'phone',
        'cell_phone',
        'address',
        'product_offered',
        'broucher',
        'country',
        'department',
        'city',
    ];
}
