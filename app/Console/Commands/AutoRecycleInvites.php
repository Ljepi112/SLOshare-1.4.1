<?php

namespace App\Console\Commands;

use App\Models\Invite;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

/**
 * @see \Tests\Unit\Console\Commands\AutoRecycleInvitesTest
 */
class AutoRecycleInvites extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:recycle_invites';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recikliraj vabila, ki so potekla.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $current = Carbon::now();
        $invites = Invite::whereNull('accepted_by')->whereNull('accepted_at')->where('expires_on', '<', $current)->get();

        foreach ($invites as $invite) {
            $invite->delete();
        }

        $this->comment('Ukaz za samodejno čiščenje nesprejetih povabil je dokončan');
    }
}
