<?php

namespace Modules\Base\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGatewayStates extends Model
{
    use HasFactory;
    protected $table = 'payment_gateway_states';
    protected $fillable = [
        'merchantId',
        'estadoTx',
        'transactionId',
        'reference_pol',
        'referenceCode',
        'pseBank',
        'cus',
        'TX_VALUE',
        'currency',
        'extra1',
        'lapPaymentMethod'
    ];
}
