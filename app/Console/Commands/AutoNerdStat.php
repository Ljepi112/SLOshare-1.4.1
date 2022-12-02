<?php

namespace App\Console\Commands;

use App\Models\Ban;
use App\Models\Peer;
use App\Models\Torrent;
use App\Models\User;
use App\Models\Warning;
use App\Repositories\ChatRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

/**
 * @see \Tests\Todo\Unit\Console\Commands\AutoNerdStatTest
 */
class AutoNerdStat extends Command
{
    /**
     * AutoNerdStat Constructor.
     */
    public function __construct(private readonly ChatRepository $chatRepository)
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:nerdstat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Samodejno objavlja dnevno statistiko v Shoutbox';

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle(): void
    {
        if (\config('chat.nerd_bot')) {
            // Site Birthday
            $bday = \config('other.birthdate');

            // Logins Count Last 24hours
            $logins = User::whereNotNull('last_login')->where('last_login', '>', Carbon::now()->subDay())->count();

            // Torrents Uploaded Count Last 24hours
            $uploads = Torrent::where('created_at', '>', Carbon::now()->subDay())->count();

            // New Users Count Last 24hours
            $users = User::where('created_at', '>', Carbon::now()->subDay())->count();

            // Top Banker
            $banker = User::latest('seedbonus')->first();

            // Most Snatched Torrent
            $snatched = Torrent::latest('times_completed')->first();

            // Most Seeded Torrent
            $seeded = Torrent::latest('seeders')->first();

            // Most Leeched Torrent
            $leeched = Torrent::latest('leechers')->first();

            // 25% FL Torrents
            $fl25 = Torrent::where('free', '=', 25)->count();

            // 50% FL Torrents
            $fl50 = Torrent::where('free', '=', 50)->count();

            // 75% FL Torrents
            $fl75 = Torrent::where('free', '=', 75)->count();

            // 100% FL Torrents
            $fl100 = Torrent::where('free', '=', 100)->count();

            // DU Torrents
            $du = Torrent::where('doubleup', '=', 1)->count();

            // Peers Count
            $peers = Peer::count();

            // New User Bans Count Last 24hours
            $bans = Ban::whereNull('unban_reason')->whereNull('removed_at')->where('created_at', '>', Carbon::now()->subDay())->count();

            // Hit and Run Warning Issued In Last 24hours
            $warnings = Warning::where('created_at', '>', Carbon::now()->subDay())->count();

            // URL Helpers
            $bankerUrl = \href_profile($banker);
            $seededUrl = \href_torrent($seeded);
            $leechedUrl = \href_torrent($leeched);
            $snatchedUrl = \href_torrent($snatched);

            // Select A Random Nerd Stat
            $statArray = [
                \sprintf('V zadnjih 24 urah [color=#93c47d][b]%s[/b][/color] Edinstveni uporabniki so se prijavili ', $logins).\config('other.title').'!',
                \sprintf('V zadnjih 24 urah [color=#93c47d][b]%s[/b][/color] Torrenti so bili naloženi na ', $uploads).\config('other.title').'!',
                \sprintf('V zadnjih 24 urah [color=#93c47d][b]%s[/b][/color] Uporabniki so se registrirali na ', $users).\config('other.title').'!',
                \sprintf('Trenutno so [color=#93c47d][b]%s[/b][/color] 25%% Freeleech Torrents on ', $fl25).\config('other.title').'!',
                \sprintf('Trenutno so [color=#93c47d][b]%s[/b][/color] 50%% Freeleech Torrents on ', $fl50).\config('other.title').'!',
                \sprintf('Trenutno so [color=#93c47d][b]%s[/b][/color] 75%% Freeleech Torrents on ', $fl75).\config('other.title').'!',
                \sprintf('Trenutno so [color=#93c47d][b]%s[/b][/color] 100%% Freeleech Torrents on ', $fl100).\config('other.title').'!',
                \sprintf('Trenutno so [color=#93c47d][b]%s[/b][/color] Dvojno nalaganje Torrents on ', $du).\config('other.title').'!',
                \sprintf('Trenutno [url=%s]%s[/url] je najbolši Seeded Torrent on ', $seededUrl, $seeded->name).\config('other.title').'!',
                \sprintf('Trenutno [url=%s]%s[/url] je najbolši Leeched Torrent on ', $leechedUrl, $leeched->name).\config('other.title').'!',
                \sprintf('Trenutno [url=%s]%s[/url] je najboše prenešen Torrent on ', $snatchedUrl, $snatched->name).\config('other.title').'!',
                \sprintf('Trenutno [url=%s]%s[/url] je zgornji nosilec BON ', $bankerUrl, $banker->username).\config('other.title').'!',
                \sprintf('Trenutno obstajajo [color=#93c47d][b]%s[/b][/color] Peers on ', $peers).\config('other.title').'!',
                \sprintf('V zadnjih 24 urah [color=#dd7e6b][b]%s[/b][/color] uporabniki so bili prepovedani ', $bans).\config('other.title').'!',
                \sprintf('Trenutno obstajajo [color=#dd7e6b][b]%s[/b][/color] opozorila za zadetek in zagon so bila izdana dne ', $warnings).\config('other.title').'!',
                \config('other.title').\sprintf(' Birthday Is [b]%s[/b]!', $bday),
                \config('other.title').' Je Kralj!',
            ];
            $selected = random_int(0, \count($statArray) - 1);

            // Auto Shout Nerd Stat
            $this->chatRepository->systemMessage($statArray[$selected], 2);
        }

        $this->comment('Samodejni Nerd Stat ukaz je dokončan');
    }
}
