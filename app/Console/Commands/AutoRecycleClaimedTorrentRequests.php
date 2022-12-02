<?php

namespace App\Console\Commands;

use App\Models\TorrentRequest;
use App\Models\TorrentRequestClaim;
use App\Repositories\ChatRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

/**
 * @see \Tests\Unit\Console\Commands\AutoRecycleClaimedTorrentRequestsTest
 */
class AutoRecycleClaimedTorrentRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:recycle_claimed_torrent_requests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recikliraj Torrent Prošnje, ki so bile zahtevane, vendar niso bile izpolnjene v 7 dneh.';

    /**
     * AutoRecycleClaimedTorrentRequests Constructor.
     */
    public function __construct(private readonly ChatRepository $chatRepository)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle(): void
    {
        $current = Carbon::now();
        $torrentRequests = TorrentRequest::where('claimed', '=', 1)
            ->whereNull('filled_by')
            ->whereNull('filled_when')
            ->whereNull('filled_hash')
            ->get();

        foreach ($torrentRequests as $torrentRequest) {
            $requestClaim = TorrentRequestClaim::where('request_id', '=', $torrentRequest->id)
                ->where('created_at', '<', $current->copy()->subDays(7)->toDateTimeString())
                ->first();
            if ($requestClaim) {
                $trUrl = \href_request($torrentRequest);
                $this->chatRepository->systemMessage(
                    \sprintf('[url=%s]%s[/url] Zahtevek je bil ponastavljen, ker ni bil izpolnjen v 7 dneh.', $trUrl, $torrentRequest->name)
                );

                $requestClaim->delete();
                $torrentRequest->claimed = null;
                $torrentRequest->save();
            }
        }

        $this->comment('Ukaz za ponastavitev samodejnih zahtevkov je dokončan');
    }
}
