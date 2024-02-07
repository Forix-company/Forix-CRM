<?php

namespace Modules\Productos\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'sku',
        'imagen',
        'name_products',
        'description_products',
        'quantities',
        'price',
        'inventory_min',
        'user_id',
        'category_id',
        'tags_id',
        'state_id',
        'manufacturer_id',
        'inventory_id',
    ];
}
