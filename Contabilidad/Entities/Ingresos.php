<?php

namespace Modules\Contabilidad\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingresos extends Model
{
    use HasFactory;
    protected $table = 'Income';
    protected $fillable = [
        'Account_ID',
        'Concept',
        'Amount',
        'Admission_date',
    ];

}
