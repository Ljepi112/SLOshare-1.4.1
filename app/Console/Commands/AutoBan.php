<?php

namespace App\Console\Commands;

use App\Mail\BanUser;
use App\Models\Ban;
use App\Models\Group;
use App\Models\Warning;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/**
 * @see \Tests\Unit\Console\Commands\AutoBanTest
 */
class AutoBan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:ban';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Izključi uporabnika, če ima več kot X aktivnih opozoril';

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle(): void
    {
        $bannedGroup = \cache()->rememberForever('banned_group', fn () => Group::where('slug', '=', 'banned')->pluck('id'));

        $bans = Warning::with('warneduser')->select(DB::raw('user_id, count(*) as value'))->where('active', '=', 1)->groupBy('user_id')->having('value', '>=', \config('hitrun.max_warnings'))->get();

        foreach ($bans as $ban) {
            if ($ban->warneduser->group_id != $bannedGroup[0] && ! $ban->warneduser->group->is_immune) {
                // If User Has x or More Active Warnings Ban Set The Users Group To Banned
                $ban->warneduser->group_id = $bannedGroup[0];
                $ban->warneduser->can_upload = 0;
                $ban->warneduser->can_download = 0;
                $ban->warneduser->can_comment = 0;
                $ban->warneduser->can_invite = 0;
                $ban->warneduser->can_request = 0;
                $ban->warneduser->can_chat = 0;
                $ban->warneduser->save();

                // Log The Ban To Ban Log
                $logban = new Ban();
                $logban->owned_by = $ban->warneduser->id;
                $logban->created_by = 1;
                $logban->ban_reason = 'Opozorilna meja je dosežena, je '.$ban->value.' opozorila.';
                $logban->unban_reason = '';
                $logban->save();

                // Send Email
                Mail::to($ban->warneduser->email)->send(new BanUser($ban->warneduser->email, $logban));
            }
        }

        $this->comment('Samodejni ukaz za prepoved uporabnikov je dokončan');
    }
}
