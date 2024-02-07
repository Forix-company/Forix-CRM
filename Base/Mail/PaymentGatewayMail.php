<?php

namespace Modules\Base\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentGatewayMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = 'Reporte de Pago';
    public $Messaje;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($Messaje)
    {
        $this->Messaje = $Messaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('base::mail.PaymentGateway');
    }
}
