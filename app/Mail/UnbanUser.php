<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UnbanUser extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * UnbanUser Constructor.
     */
    public function __construct(public $email, public $ban)
    {
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        return $this->markdown('emails.unban')
            ->subject('Vaš račun je OMOGOČEN - '.\config('other.title'));
    }
}
