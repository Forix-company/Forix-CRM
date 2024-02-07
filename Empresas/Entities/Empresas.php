<?php

namespace Modules\Empresas\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $fillable = [
        'nit',
        'business_name',
        'mail',
        'phone',
        'cell_phone',
        'logo',
        'address',
        'country',
        'department',
        'city',
    ];
}
