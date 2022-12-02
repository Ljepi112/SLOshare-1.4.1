<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DisableUser extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * DisableUser Constructor.
     */
    public function __construct(public $email)
    {
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        return $this->markdown('emails.disabled')
            ->subject('Vaš račun je ONEMOGOČEN - '.\config('other.title'));
    }
}
