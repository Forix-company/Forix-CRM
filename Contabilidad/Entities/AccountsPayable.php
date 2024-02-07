<?php

namespace Modules\Contabilidad\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountsPayable extends Model
{
    use HasFactory;
    protected $table = 'Accounts_Payable';
    protected $fillable = [
        'supplier_id',
        'Account_id',
        'AmountToPay',
    ];
}
