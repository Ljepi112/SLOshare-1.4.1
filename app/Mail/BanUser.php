<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BanUser extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * BanUser Constructor.
     */
    public function __construct(public $email, public $ban)
    {
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        return $this->markdown('emails.ban')
            ->subject('Bili ste BAN - '.\config('other.title'));
    }
}
