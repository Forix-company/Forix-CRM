<?php

namespace Modules\Etiquetas\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiquetas extends Model
{
    use HasFactory;
    protected $table = 'tags';
    protected $fillable = [
        'name_tags',
        'description_tags',
    ];
}
