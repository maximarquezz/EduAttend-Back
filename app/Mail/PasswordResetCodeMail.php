<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;

class PasswordResetCodeMail extends Mailable
{
    public $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function build()
    {
        return $this->subject('Código de Recuperación - EduAttend')
                    ->view('emails.password-reset-code');
    }
}