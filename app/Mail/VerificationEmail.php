<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $token;

    public function __construct($name, $token)
    {
        $this->name = $name;
        $this->token = $token;
    }

    public function build()
    {
        return $this->subject('Verify Your Email Address')
                    ->view('mails.verify')
                    ->with([
                        'name' => $this->name,
                        'verificationLink' => route('verify.email', ['token' => $this->token])
                    ]);
    }
}
