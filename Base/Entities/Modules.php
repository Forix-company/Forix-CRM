<?php

namespace Modules\Base\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    use HasFactory;
    protected $table = 'modules';
    protected $fillable = [
        'name',
        'status'
    ];
}
