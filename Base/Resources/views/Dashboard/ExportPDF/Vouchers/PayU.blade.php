<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprobante de pago</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    @foreach ($Payment as $payment)
        <div style="text-align: center;">
            <p style="font-size: 50px">Comprobante de pago</p>
            <P>El pago de la compra con Nº #{{ $payment->reference_pol }} realizado en PayU ha sido procesado de manera
                correctamente</P>
            <p>Se adjunta los datos de la transaccion :</p>
        </div>
        @if ($payment->estadoTx === 'Transacción aprobada')
            <div style="background-color: green;width: 100%;height: 50px;">
                <h3 style="text-transform: uppercase;color: white;font-size: 30px;text-align: center;">@php echo strtoupper($payment->estadoTx);@endphp
                </h3>
            </div>
        @elseif ($payment->estadoTx === 'Transacción pendiente')
            <div style="background-color: yellow;width: 100%;height: 50px;">
                <h2 style="text-transform: uppercase;color: white;font-size: 30px;text-align: center;">@php echo strtoupper($payment->estadoTx);@endphp
                </h2>
            </div>
        @else
            <div style="background-color: red;width: 100%;height: 50px;">
                <h2 style="text-transform: uppercase;color: white;font-size: 30px;text-align: center;">@php echo strtoupper($payment->estadoTx);@endphp
                </h2>
            </div>
        @endif
    @endforeach

    <h2>Resumen Transacción</h2>
    <ul>
        @foreach ($Payment as $payment)
            <li><b>Estado de la transaccion:</b>{{ $payment->estadoTx }}</li>
            <li><b>ID de la transaccion:</b>{{ $payment->transactionId }}</li>
            <li><b>Referencia de la venta:</b>{{ $payment->reference_pol }}</li>
            <li><b>Referencia de la transaccion:</b>{{ $payment->referenceCode }}</li>
            @if ($payment->pseBank != null)
                <li><b>Cus:</b>{{ $payment->cus }}</li>
                <li><b>Banco:</b>{{ $payment->pseBank }}</li>
            @endif
            <li><b>Valor total:</b>{{ $payment->TX_VALUE }}</li>
            <li><b>Moneda:</b>{{ $payment->currency }}</li>
            <li><b>Descripción:</b>{{ $payment->extra1 }}</li>
            <li><b>Entidad:</b>{{ $payment->lapPaymentMethod }}</li>
        @endforeach
    </ul>
    @foreach ($Payment as $payment)
        @if (strtoupper($payment->signature) == strtoupper($firmaMd5))
            <h1>Error validando firma digital.</h1>
        @endif
    @endforeach
    <div style="text-align: center;">
        <p>La pasarela de pago PayU solo es un facilitador del proceso de pago y no se hace responsable sobre la entrega
            de
            productos y servicios. Cualquier duda o Consulta por favor contacta al comercio</p>

        <img src="{{ $image }}" width="200" height="150" alt="Image no found">
        <p>PEDIDO PROCESADO POR PAYU</p>
    </div>

</body>

</html>
