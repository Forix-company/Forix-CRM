<?php

namespace Modules\Contabilidad\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transacciones extends Model
{
    use HasFactory;
    protected $table = 'Bank_Transactions';
    protected $fillable = [
        'Account_ID',
        'Transaction_Date',
        'Transaction_Type',
        'Amount',
    ];
}
