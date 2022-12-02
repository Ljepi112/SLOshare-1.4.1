<?php

namespace App\Mail;

use App\Models\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteUser extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * InviteUser Constructor.
     */
    public function __construct(public Invite $invite)
    {
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        return $this->markdown('emails.invite')
            ->subject('Povabilo je bilo prejeto '.\config('other.title'));
    }
}
