<?php

namespace App\Console\Commands;

use App\Models\History;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

/**
 * @see \Tests\Unit\Console\Commands\AutoCorrectHistoryTest
 */
class AutoCorrectHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:correct_history';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Popravlja zapise zgodovine, za katere je rečeno, da so aktivni, čeprav v resnici niso zaradi tega, ker od stranke ne bi prejeli ZAUSTAVLJENEGA dogodka.';

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle(): void
    {
        $carbon = new Carbon();
        $history = History::select(['id', 'active', 'updated_at'])->where('active', '=', 1)->where('updated_at', '<', $carbon->copy()->subHours(2)->toDateTimeString())->get();

        foreach ($history as $h) {
            $h->active = false;
            $h->save();
        }

        $this->comment('Ukaz za samodejno popravljanje zapisov zgodovine je dokončan');
    }
}
