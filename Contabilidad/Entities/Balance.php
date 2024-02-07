<?php

namespace Modules\Contabilidad\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Balance extends Model
{
    use HasFactory;
    protected $table = 'balance_sheet';
    protected $fillable = [
        'income_id',
        'price_total_income',
        'expenses_id',
        'price_total_expenses',
        'date_balance',
    ];
}
