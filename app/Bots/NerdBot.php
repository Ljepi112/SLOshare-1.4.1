<?php

namespace App\Bots;

use App\Events\Chatter;
use App\Http\Resources\UserAudibleResource;
use App\Http\Resources\UserEchoResource;
use App\Models\Ban;
use App\Models\Bot;
use App\Models\BotTransaction;
use App\Models\Peer;
use App\Models\Torrent;
use App\Models\User;
use App\Models\UserAudible;
use App\Models\UserEcho;
use App\Models\Warning;
use App\Repositories\ChatRepository;
use Illuminate\Support\Carbon;

class NerdBot
{
    private $bot;

    private $chat;

    private $target;

    private $type;

    private $message;

    private $targeted;

    private $log;

    private $expiresAt;

    private $current;

    /**
     * NerdBot Constructor.
     */
    public function __construct(private readonly ChatRepository $chatRepository)
    {
        $bot = Bot::where('id', '=', '2')->firstOrFail();
        $this->bot = $bot;
        $this->expiresAt = Carbon::now()->addMinutes(60);
        $this->current = Carbon::now();
    }

    /**
     * Replace Vars.
     */
    public function replaceVars($output)
    {
        $output = \str_replace(['{me}', '{command}'], [$this->bot->name, $this->bot->command], $output);
        if (\str_contains((string) $output, '{bots}')) {
            $botHelp = '';
            $bots = Bot::where('active', '=', 1)->where('id', '!=', $this->bot->id)->oldest('position')->get();
            foreach ($bots as $bot) {
                $botHelp .= '( ! | / | @)'.$bot->command.' pomoč sproži datoteko pomoči za '.$bot->name."\n";
            }

            $output = \str_replace('{bots}', $botHelp, $output);
        }

        return $output;
    }

    /**
     * Get Banker.
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getBanker($duration = 'default')
    {
        $banker = \cache()->get('nerdbot-banker');
        if (! $banker) {
            $banker = User::latest('seedbonus')->first();
            \cache()->put('nerdbot-banker', $banker, $this->expiresAt);
        }

        return \sprintf('Trenutno [url=/users/%s]%s[/url] Je zgornji nosilec BON ', $banker->username, $banker->username).\config('other.title').'!';
    }

    /**
     * Get Snatched.
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getSnatched($duration = 'default')
    {
        $snatched = \cache()->get('nerdbot-snatched');
        if (! $snatched) {
            $snatched = Torrent::latest('times_completed')->first();
            \cache()->put('nerdbot-snatched', $snatched, $this->expiresAt);
        }

        return \sprintf('Trenutno [url=/torrents/%s]%s[/url] Je najbolj ugrabljen torrent ', $snatched->id, $snatched->name).\config('other.title').'!';
    }

    /**
     * Get Leeched.
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getLeeched($duration = 'default')
    {
        $leeched = \cache()->get('nerdbot-leeched');
        if (! $leeched) {
            $leeched = Torrent::latest('leechers')->first();
            \cache()->put('nerdbot-leeched', $leeched, $this->expiresAt);
        }

        return \sprintf('Trenutno [url=/torrents/%s]%s[/url] Torent je najbolj zajeban ', $leeched->id, $leeched->name).\config('other.title').'!';
    }

    /**
     * Get Seeded.
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getSeeded($duration = 'default')
    {
        $seeded = \cache()->get('nerdbot-seeded');
        if (! $seeded) {
            $seeded = Torrent::latest('seeders')->first();
            \cache()->put('nerdbot-seeded', $seeded, $this->expiresAt);
        }

        return \sprintf('Trenutno [url=/torrents/%s]%s[/url] Je najbolj zasejan torrent ', $seeded->id, $seeded->name).\config('other.title').'!';
    }

    /**
     * Get FL.
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getFreeleech($duration = 'default')
    {
        $fl = \cache()->get('nerdbot-fl');
        if (! $fl) {
            $fl = Torrent::where('free', '=', 1)->count();
            \cache()->put('nerdbot-fl', $fl, $this->expiresAt);
        }

        return \sprintf('Trenutno obstajajo %s Torrenti Freeleech so vklopljeni  ', $fl).\config('other.title').'!';
    }

    /**
     * Get DU.
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getDoubleUpload($duration = 'default')
    {
        $du = \cache()->get('nerdbot-doubleup');
        if (! $du) {
            $du = Torrent::where('doubleup', '=', 1)->count();
            \cache()->put('nerdbot-doubleup', $du, $this->expiresAt);
        }

        return \sprintf('Trenutno obstajajo %s Vklopljeni torrenti za dvojno nalaganje ', $du).\config('other.title').'!';
    }

    /**
     * Get Peers.
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getPeers($duration = 'default')
    {
        $peers = \cache()->get('nerdbot-peers');
        if (! $peers) {
            $peers = Peer::count();
            \cache()->put('nerdbot-peers', $peers, $this->expiresAt);
        }

        return \sprintf('Trenutno obstajajo %s Peers On ', $peers).\config('other.title').'!';
    }

    /**
     * Get Bans.
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getBans($duration = 'default')
    {
        $bans = \cache()->get('nerdbot-bans');
        if (! $bans) {
            $bans = Ban::whereNull('unban_reason')->whereNull('removed_at')->where('created_at', '>', $this->current->subDay())->count();
            \cache()->put('nerdbot-bans', $bans, $this->expiresAt);
        }

        return \sprintf('V zadnjih 24 urah %s Uporabniki so bili prepovedani ', $bans).\config('other.title').'!';
    }

    /**
     * Get Warnings.
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getWarnings($duration = 'default')
    {
        $warnings = \cache()->get('nerdbot-warnings');
        if (! $warnings) {
            $warnings = Warning::where('created_at', '>', $this->current->subDay())->count();
            \cache()->put('nerdbot-warnings', $warnings, $this->expiresAt);
        }

        return \sprintf('V zadnjih 24 urah %s Hit in Run opozorila je bil izdan dne ', $warnings).\config('other.title').'!';
    }

    /**
     * Get Uploads.
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getUploads($duration = 'default')
    {
        $uploads = \cache()->get('nerdbot-uploads');
        if (! $uploads) {
            $uploads = Torrent::where('created_at', '>', $this->current->subDay())->count();
            \cache()->put('nerdbot-uploads', $uploads, $this->expiresAt);
        }

        return \sprintf('V zadnjih 24 urah %s Torrenti so bili naloženi na ', $uploads).\config('other.title').'!';
    }

    /**
     * Get Logins.
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getLogins($duration = 'default')
    {
        $logins = \cache()->get('nerdbot-logins');
        if (! $logins) {
            $logins = User::whereNotNull('last_login')->where('last_login', '>', $this->current->subDay())->count();
            \cache()->put('nerdbot-logins', $logins, $this->expiresAt);
        }

        return \sprintf('V zadnjih 24 urah %s Edinstveni uporabniki so se prijavili ', $logins).\config('other.title').'!';
    }

    /**
     * Get Registrations.
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getRegistrations($duration = 'default')
    {
        $registrations = \cache()->get('nerdbot-users');
        if (! $registrations) {
            $registrations = User::where('created_at', '>', $this->current->subDay())->count();
            \cache()->put('nerdbot-users', $registrations, $this->expiresAt);
        }

        return \sprintf('V zadnjih 24 urah %s Uporabniki so se registrirali na ', $registrations).\config('other.title').'!';
    }

    /**
     * Get Bot Donations.
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getDonations($duration = 'default')
    {
        $donations = \cache()->get('nerdbot-donations');
        if (! $donations) {
            $donations = BotTransaction::with('user', 'bot')->where('to_bot', '=', 1)->latest()->limit(10)->get();
            \cache()->put('nerdbot-donations', $donations, $this->expiresAt);
        }

        $donationDump = '';
        $i = 1;
        foreach ($donations as $donation) {
            $donationDump .= '#'.$i.'. '.$donation->user->username.' sent '.$donation->bot->name.' '.$donation->cost.' '.$donation->forHumans().".\n";
            $i++;
        }

        return "Najnovejše donacije vsem botom so naslednje:\n\n".\trim($donationDump);
    }

    /**
     * Get Help.
     */
    public function getHelp()
    {
        return $this->replaceVars($this->bot->help);
    }

    /**
     * Get King.
     */
    public function getKing()
    {
        return \config('other.title').' Je Kralj!';
    }

    /**
     * Send Bot Donation.
     *
     * @throws \Exception
     */
    public function putDonate($amount = 0, $note = '')
    {
        $output = \implode(' ', $note);
        $v = \validator(['bot_id' => $this->bot->id, 'amount'=> $amount, 'note'=> $output], [
            'bot_id'   => 'required|exists:bots,id|max:999',
            'amount'   => \sprintf('required|numeric|min:1|max:%s', $this->target->seedbonus),
            'note'     => 'required|string',
        ]);
        if ($v->passes()) {
            $value = $amount;
            $this->bot->seedbonus += $value;
            $this->bot->save();

            $this->target->seedbonus -= $value;
            $this->target->save();

            $botTransaction = new BotTransaction();
            $botTransaction->type = 'bon';
            $botTransaction->cost = $value;
            $botTransaction->user_id = $this->target->id;
            $botTransaction->bot_id = $this->bot->id;
            $botTransaction->to_bot = 1;
            $botTransaction->comment = $output;
            $botTransaction->save();

            $donations = BotTransaction::with('user', 'bot')->where('bot_id', '=', $this->bot->id)->where('to_bot', '=', 1)->latest()->limit(10)->get();
            \cache()->put('casinobot-donations', $donations, $this->expiresAt);

            return 'Vaša donacija za '.$this->bot->name.' za '.$amount.' BON je bil poslan!';
        }

        return 'Vaša donacija za '.$output.' ni bilo mogoče poslati.';
    }

    /**
     * Process Message.
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function process($type, User $user, $message = '', $targeted = 0)
    {
        $this->target = $user;
        if ($type == 'message') {
            $x = 0;
            $y = 1;
            $z = 2;
        } else {
            $x = 1;
            $y = 2;
            $z = 3;
        }

        if ($message === '') {
            $log = '';
        } else {
            $log = 'Vsi '.$this->bot->name.' ukazi morajo biti zasebno sporočilo ali začeti z /'.$this->bot->command.' za !'.$this->bot->command.'. Rabim pomoč? Vrsta /'.$this->bot->command.' pomagaj in pomagali ti bodo.';
        }

        $command = @\explode(' ', (string) $message);

        $wildcard = null;
        $params = $command[$y] ?? null;

        if ($params != null) {
            $clone = $command;
            \array_shift($clone);
            \array_shift($clone);
            \array_shift($clone);
            $wildcard = $clone;
        }

        if (\array_key_exists($x, $command)) {
            if ($command[$x] === 'banker') {
                $log = $this->getBanker($params);
            }

            if ($command[$x] === 'bans') {
                $log = $this->getBans($params);
            }

            if ($command[$x] === 'donations') {
                $log = $this->getDonations($params);
            }

            if ($command[$x] === 'donate') {
                $log = $this->putDonate($params, $wildcard);
            }

            if ($command[$x] === 'doubleupload') {
                $log = $this->getDoubleUpload($params);
            }

            if ($command[$x] === 'freeleech') {
                $log = $this->getFreeleech($params);
            }

            if ($command[$x] === 'help') {
                $log = $this->getHelp();
            }

            if ($command[$x] === 'king') {
                $log = $this->getKing();
            }

            if ($command[$x] === 'logins') {
                $log = $this->getLogins($params);
            }

            if ($command[$x] === 'peers') {
                $log = $this->getPeers($params);
            }

            if ($command[$x] === 'registrations') {
                $log = $this->getRegistrations($params);
            }

            if ($command[$x] === 'uploads') {
                $log = $this->getUploads($params);
            }

            if ($command[$x] === 'warnings') {
                $log = $this->getWarnings($params);
            }

            if ($command[$x] === 'seeded') {
                $log = $this->getSeeded($params);
            }

            if ($command[$x] === 'leeched') {
                $log = $this->getLeeched($params);
            }

            if ($command[$x] === 'snatched') {
                $log = $this->getSnatched($params);
            }
        }

        $this->targeted = $targeted;
        $this->type = $type;
        $this->message = $message;
        $this->log = $log;

        return $this->pm();
    }

    /**
     * Output Message.
     */
    public function pm()
    {
        $type = $this->type;
        $target = $this->target;
        $txt = $this->log;
        $message = $this->message;
        $targeted = $this->targeted;

        if ($type == 'message' || $type == 'private') {
            $receiverDirty = 0;
            $receiverEchoes = \cache()->get('user-echoes'.$target->id);
            if (! $receiverEchoes || ! \is_array($receiverEchoes) || \count($receiverEchoes) < 1) {
                $receiverEchoes = UserEcho::with(['room', 'target', 'bot'])->whereRaw('user_id = ?', [$target->id])->get();
            }

            $receiverListening = false;
            foreach ($receiverEchoes as $se => $receiverEcho) {
                if ($receiverEcho['bot_id'] == $this->bot->id) {
                    $receiverListening = true;
                }
            }

            if (! $receiverListening) {
                $receiverPort = new UserEcho();
                $receiverPort->user_id = $target->id;
                $receiverPort->bot_id = $this->bot->id;
                $receiverPort->save();
                $receiverEchoes = UserEcho::with(['room', 'target', 'bot'])->whereRaw('user_id = ?', [$target->id])->get();
                $receiverDirty = 1;
            }

            if ($receiverDirty == 1) {
                $expiresAt = Carbon::now()->addMinutes(60);
                \cache()->put('user-echoes'.$target->id, $receiverEchoes, $expiresAt);
                \event(new Chatter('echo', $target->id, UserEchoResource::collection($receiverEchoes)));
            }

            $receiverDirty = 0;
            $receiverAudibles = \cache()->get('user-audibles'.$target->id);
            if (! $receiverAudibles || ! \is_array($receiverAudibles) || \count($receiverAudibles) < 1) {
                $receiverAudibles = UserAudible::with(['room', 'target', 'bot'])->whereRaw('user_id = ?', [$target->id])->get();
            }

            $receiverListening = false;
            foreach ($receiverAudibles as $se => $receiverEcho) {
                if ($receiverEcho['bot_id'] == $this->bot->id) {
                    $receiverListening = true;
                }
            }

            if (! $receiverListening) {
                $receiverPort = new UserAudible();
                $receiverPort->user_id = $target->id;
                $receiverPort->bot_id = $this->bot->id;
                $receiverPort->save();
                $receiverAudibles = UserAudible::with(['room', 'target', 'bot'])->whereRaw('user_id = ?', [$target->id])->get();
                $receiverDirty = 1;
            }

            if ($receiverDirty == 1) {
                $expiresAt = Carbon::now()->addMinutes(60);
                \cache()->put('user-audibles'.$target->id, $receiverAudibles, $expiresAt);
                \event(new Chatter('audible', $target->id, UserAudibleResource::collection($receiverAudibles)));
            }

            if ($txt != '') {
                $roomId = 0;
                $message = $this->chatRepository->privateMessage($target->id, $roomId, $message, 1, $this->bot->id);
                $message = $this->chatRepository->privateMessage(1, $roomId, $txt, $target->id, $this->bot->id);
            }

            return \response('success');
        }

        if ($type == 'echo') {
            if ($txt != '') {
                $roomId = 0;
                $message = $this->chatRepository->botMessage($this->bot->id, $roomId, $txt, $target->id);
            }

            return \response('success');
        }

        if ($type == 'public') {
            if ($txt != '') {
                $dumproom = $this->chatRepository->message($target->id, $target->chatroom->id, $message, null, null);
                $dumproom = $this->chatRepository->message(1, $target->chatroom->id, $txt, null, $this->bot->id);
            }

            return \response('success');
        }

        return true;
    }
}
