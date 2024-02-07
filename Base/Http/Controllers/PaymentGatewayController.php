<?php

namespace Modules\Base\Http\Controllers;

use Modules\Base\Entities\PayUConfiguration;
use Modules\Base\Entities\PaymentGatewayStates;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;
class PaymentGatewayController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        function transaction($merchantId, $estadoTx, $transactionId, $reference_pol, $referenceCode, $pseBank, $cus, $TX_VALUE, $currency, $extra1, $lapPaymentMethod)
        {

            $PaymentGateway = new PaymentGatewayStates();
            $PaymentGateway->merchantId = $merchantId;
            $PaymentGateway->estadoTx = $estadoTx;
            $PaymentGateway->transactionId = $transactionId;
            $PaymentGateway->reference_pol = $reference_pol;
            $PaymentGateway->referenceCode = $referenceCode;
            $PaymentGateway->pseBank = ($pseBank) ? $pseBank : null;
            $PaymentGateway->cus = ($cus) ? $cus : null;
            $PaymentGateway->TX_VALUE = number_format($TX_VALUE);
            $PaymentGateway->currency = $currency;
            $PaymentGateway->extra1 = $extra1;
            $PaymentGateway->lapPaymentMethod = $lapPaymentMethod;
            $PaymentGateway->save();
        }

        switch ($request->transactionState) {
            case 4:
                $estadoTx = "Transacción aprobada";
                transaction($request->merchantId, $estadoTx, $request->transactionId, $request->reference_pol, $request->referenceCode, $request->pseBank, $request->cus, $request->TX_VALUE, $request->currency, $request->extra1, $request->lapPaymentMethod);
                break;
            case 6:
                $estadoTx = "Transacción rechazada";
                transaction($request->merchantId, $estadoTx, $request->transactionId, $request->reference_pol, $request->referenceCode, $request->pseBank, $request->cus, $request->TX_VALUE, $request->currency, $request->extra1, $request->lapPaymentMethod);
                break;
            case 7:
                $estadoTx = "Transacción pendiente";
                transaction($request->merchantId, $estadoTx, $request->transactionId, $request->reference_pol, $request->referenceCode, $request->pseBank, $request->cus, $request->TX_VALUE, $request->currency, $request->extra1, $request->lapPaymentMethod);
                break;
            case 104:
                $estadoTx = "Error";
                transaction($request->merchantId, $estadoTx, $request->transactionId, $request->reference_pol, $request->referenceCode, $request->pseBank, $request->cus, $request->TX_VALUE, $request->currency, $request->extra1, $request->lapPaymentMethod);
                break;
            default:
                //$estadoTx=($_REQUEST['mensaje'])? $_REQUEST['mensaje']: null;
                break;
        }

        return redirect('PaymentGateway/voucher/PayU/' . $request->merchantId);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
