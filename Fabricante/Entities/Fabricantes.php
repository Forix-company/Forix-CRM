<?php

namespace Modules\Fabricante\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabricantes extends Model
{
    use HasFactory;
    protected $table = 'manufacturer';
    protected $fillable = [
        'name_tags',
        'description_tags',
    ];
}
