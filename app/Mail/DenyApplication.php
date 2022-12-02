<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DenyApplication extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * DenyApplication Constructor.
     */
    public function __construct(public $deniedMessage)
    {
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        return $this->markdown('emails.deny_application')->subject('Vaša prijava je bila zavrnjena!');
    }
}
