<?php

namespace Modules\Inventario\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    protected $table = 'inventory';
    protected $fillable = [
        'code',
        'name_inventory',
        'stock',
        'entrance_id',
        'return_id',
    ];
}
