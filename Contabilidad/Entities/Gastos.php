<?php

namespace Modules\Contabilidad\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gastos extends Model
{
    use HasFactory;
    protected $table = 'Expenses';
    protected $fillable = [
        'Account_ID',
        'Concept',
        'Amount',
        'Dismissal_Date',
    ];

}
