<?php

namespace App\Jobs;

use App\Models\PrivateMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessMassPM implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    /**
     * @var mixed
     */
    public $sender_id;

    /**
     * @var mixed
     */
    public $receiver_id;

    /**
     * ProcessMassPM Constructor.
     */
    public function __construct(protected $senderId, protected $receiverId, protected $subject, protected $message)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $privateMessage = new PrivateMessage();
        $privateMessage->sender_id = $this->senderId;
        $privateMessage->receiver_id = $this->receiverId;
        $privateMessage->subject = $this->subject;
        $privateMessage->message = $this->message;
        $privateMessage->save();
    }
}
