<?php

namespace App\Http\Controllers;

use App\Helpers\Bencode;
use App\Models\Torrent;
use App\Models\TorrentDownload;
use App\Models\User;
use Illuminate\Http\Request;

class TorrentDownloadController extends Controller
{
    /**
     * Download Check.
     */
    public function show(Request $request, int $id): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $torrent = Torrent::withAnyStatus()->findOrFail($id);
        $user = $request->user();

        return \view('torrent.download_check', ['torrent' => $torrent, 'user' => $user]);
    }

    /**
     * Download A Torrent.
     */
    public function store(Request $request, int $id, $rsskey = null): \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $user = $request->user();
        if (! $user && $rsskey) {
            $user = User::where('rsskey', '=', $rsskey)->firstOrFail();
        }
        $torrent = Torrent::withAnyStatus()->findOrFail($id);
        $hasHistory = $user->history()->where([['info_hash', '=', $torrent->info_hash], ['seeder', '=', 1]])->count();
        // User's ratio is too low
        if ($user->getRatio() < \config('other.ratio') && ! ($torrent->user_id === $user->id || $hasHistory)) {
            return \to_route('torrent', ['id' => $torrent->id])
                ->withErrors('Vaše razmerje je prenisko za prenos!');
        }

        // User's download rights are revoked
        if ($user->can_download == 0 && ! ($torrent->user_id === $user->id || $hasHistory)) {
            return \to_route('torrent', ['id' => $torrent->id])
                ->withErrors('Vaše pravice za prenos so bile onemogočene!');
        }

        // Torrent Status Is Rejected
        if ($torrent->isRejected()) {
            return \to_route('torrent', ['id' => $torrent->id])
                ->withErrors('To Torrent je bil zavrnjen s strani osebja');
        }

        // Define the filename for the download
        $tmpFileName = \str_replace([' ', '/', '\\'], ['.', '-', '-'], '['.\config('torrent.source').']['.$user->id.']'.$torrent->name.'.torrent');

        // The torrent file exist ?
        if (! \file_exists(\getcwd().'/files/torrents/'.$torrent->file_name)) {
            return \to_route('torrent', ['id' => $torrent->id])
                ->withErrors('Torrent datoteka ni najdena! Prosimo, poročajte o napaki tega Torrent!');
        }

        // Delete the last torrent tmp file
        if (\file_exists(\getcwd().'/files/tmp/'.$tmpFileName)) {
            \unlink(\getcwd().'/files/tmp/'.$tmpFileName);
        }

        // Get the content of the torrent
        $dict = Bencode::bdecode(\file_get_contents(\getcwd().'/files/torrents/'.$torrent->file_name));
        if ($request->user() || ($rsskey && $user)) {
            // Set the announce key and add the user passkey
            $dict['announce'] = \route('announce', ['passkey' => $user->passkey]);
            // Remove Other announce url
            unset($dict['announce-list']);
            // Set link to torrent as the comment
            if (config('torrent.comment')) {
                $dict['comment'] = \config('torrent.comment').'. '.\route('torrent', ['id' => $id]);
            } else {
                $dict['comment'] = \route('torrent', ['id' => $id]);
            }
        } else {
            return \to_route('login');
        }

        $fileToDownload = Bencode::bencode($dict);
        \file_put_contents(\getcwd().'/files/tmp/'.$tmpFileName, $fileToDownload);

        $torrentDownload = new TorrentDownload();
        $torrentDownload->user_id = $user->id;
        $torrentDownload->torrent_id = $id;
        $torrentDownload->type = $rsskey ? 'Uporaba RSS/API '.$request->header('User-Agent') : 'Uporaba spletnega mesta '.$request->header('User-Agent');
        $torrentDownload->save();

        return \response()->download(\getcwd().'/files/tmp/'.$tmpFileName)->deleteFileAfterSend(true);
    }
}
