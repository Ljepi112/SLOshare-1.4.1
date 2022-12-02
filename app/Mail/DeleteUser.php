<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeleteUser extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * DeleteUser Constructor.
     */
    public function __construct(public $email)
    {
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        return $this->markdown('emails.pruned')
            ->subject('Vaš račun je bil ODSTRANJEN - '.\config('other.title'));
    }
}
