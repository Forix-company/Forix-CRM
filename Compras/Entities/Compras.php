<?php

namespace Modules\Compras\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;
    protected $table = 'buys';
    protected $fillable = [
        'code',
        'name_complete',
        'observations',
        'quantity',
        'price',
        'discount',
        'total',
        'broucher',
        'supplier_id',
        'user_id',
        'voucher_id',
        'state_id',
        'authorized_id',
    ];
}
