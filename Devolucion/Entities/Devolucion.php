<?php

namespace Modules\Devolucion\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    use HasFactory;
    protected $table = 'inventory_return';
    protected $fillable = [
        'supplier_id',
        'products',
        'quantity',
        'observations',
        'support_document',
        'state_id',
    ];
}
