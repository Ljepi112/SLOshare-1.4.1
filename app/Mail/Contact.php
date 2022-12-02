<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Contact Constructor.
     */
    public function __construct(public array $input)
    {
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        return $this->markdown('emails.contact')
            ->from($this->input['email'], \config('other.title'))
            ->subject('Novi kontaktni E-Mail');
    }
}
