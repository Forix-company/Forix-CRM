<?php

namespace Modules\Contabilidad\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankAccounts extends Model
{
    use HasFactory;

    protected $table = 'Bank_Accounts';
    protected $fillable = [
        'Bank_name',
        'Bank_type',
        'balance',
    ];

}
