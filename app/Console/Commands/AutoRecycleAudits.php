<?php

namespace App\Console\Commands;

use App\Models\Audit;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

/**
 * @see \Tests\Unit\Console\Commands\AutoRecycleAuditsTest
 */
class AutoRecycleAudits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:recycle_activity_log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recikliraj dejavnost iz dnevnika enkrat, star 30 dni.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $current = Carbon::now();
        $audits = Audit::where('created_at', '<', $current->copy()->subDays(\config('audit.recycle'))->toDateTimeString())->get();

        foreach ($audits as $audit) {
            $audit->delete();
        }

        $this->comment('Ukaz za samodejno čiščenje starih revizij je končan');
    }
}
