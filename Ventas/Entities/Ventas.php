<?php

namespace Modules\Ventas\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $fillable = [
        'id_sales_check',
        'customer_id',
        'user_id',
        'sale_state_id',
        'products_id',
        'receipt_sales_id',
        'sale_id',
        'payment_method_id',
        'observations',
        'total',
    ];
}
