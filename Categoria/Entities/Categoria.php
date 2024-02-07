<?php

namespace Modules\Categoria\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $fillable = [
        'name_category',
        'description_category',
    ];
}
