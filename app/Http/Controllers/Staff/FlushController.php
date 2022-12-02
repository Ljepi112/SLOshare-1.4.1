<?php

namespace App\Http\Controllers\Staff;

use App\Events\MessageDeleted;
use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Message;
use App\Models\Peer;
use App\Repositories\ChatRepository;
use Illuminate\Support\Carbon;

/**
 * @see \Tests\Todo\Feature\Http\Controllers\Staff\FlushControllerTest
 */
class FlushController extends Controller
{
    /**
     * FlushController Constructor.
     */
    public function __construct(private readonly ChatRepository $chatRepository)
    {
    }

    /**
     * Flsuh All Old Peers From Database.
     *
     * @throws \Exception
     */
    public function peers(): \Illuminate\Http\RedirectResponse
    {
        $carbon = new Carbon();
        $peers = Peer::select(['id', 'torrent_id', 'user_id', 'updated_at'])->where('updated_at', '<', $carbon->copy()->subHours(2)->toDateTimeString())->get();

        foreach ($peers as $peer) {
            $history = History::where('torrent_id', '=', $peer->torrent_id)->where('user_id', '=', $peer->user_id)->first();
            if ($history) {
                $history->active = false;
                $history->save();
            }

            $peer->delete();
        }

        return \to_route('staff.dashboard.index')
            ->withSuccess('Ghost Peers so bili odplaknjeni');
    }

    /**
     * Flush All Chat Messages.
     *
     * @throws \Exception
     */
    public function chat(): \Illuminate\Http\RedirectResponse
    {
        foreach (Message::all() as $message) {
            \broadcast(new MessageDeleted($message));
            $message->delete();
        }

        $this->chatRepository->systemMessage(
            'Klepetalnica je bila odplaknjena! :broom:'
        );

        return \to_route('staff.dashboard.index')
            ->withSuccess('Klepetalnica je bila odplaknjena');
    }
}
