<?php

namespace Modules\Base\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TwoFactorUsers extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = 'Autenticacion doble factor Activado !!';
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
        return $this->markdown('base::mail.TwoFactorUsers');
    }
}
