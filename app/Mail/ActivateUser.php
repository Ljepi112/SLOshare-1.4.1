<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivateUser extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * ActivateUser constructor.
     */
    public function __construct(public User $user, public $code)
    {
    }

    public function build(): static
    {
        return $this->markdown('emails.activate')
            ->subject('Zahtevana je aktivacija '.\config('other.title'));
    }
}
