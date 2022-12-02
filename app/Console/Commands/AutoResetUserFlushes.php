<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AutoResetUserFlushes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:reset_user_flushes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ponastavi dnevno omejitev za uporabnike, da izbrišejo svoje vrstnike.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // Updates own_flushes for each user
        User::where('own_flushes', '<', '2')->update(['own_flushes' => '2']);

        $this->comment('Ukaz za samodejno ponastavitev uporabniških flushes je dokončan');
    }
}
