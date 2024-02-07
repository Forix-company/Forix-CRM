<?php

namespace Modules\Contabilidad\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountsReceivable extends Model
{
    use HasFactory;
    protected $table = 'Accounts_Receivable';
    protected $fillable = [
        'Client_id',
        'Account_id',
        'AmountReceivable',
    ];
}
