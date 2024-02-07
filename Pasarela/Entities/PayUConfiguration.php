<?php

namespace Modules\Pasarela\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayUConfiguration extends Model
{
    use HasFactory;
    protected $table = 'payment_configurations';
    protected $fillable = [
        'code',
        'name_inventory',
        'stock',
        'entrance_id',
        'return_id',
    ];
}
