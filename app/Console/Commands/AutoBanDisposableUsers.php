<?php

namespace App\Console\Commands;

use App\Mail\BanUser;
use App\Models\Ban;
use App\Models\Group;
use App\Models\User;
use App\Rules\EmailBlacklist;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

/**
 * @see \Tests\Todo\Unit\Console\Commands\AutoBanDisposableUsersTest
 */
class AutoBanDisposableUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:ban_disposable_users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepovedi uporabnika Če uporabljajo E-Mail za enkratno uporabo';

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle(): void
    {
        $bannedGroup = \cache()->rememberForever('banned_group', fn () => Group::where('slug', '=', 'banned')->pluck('id'));

        User::where('group_id', '!=', $bannedGroup[0])->chunkById(100, function ($users) use ($bannedGroup) {
            foreach ($users as $user) {
                $v = \validator([
                    'email' => $user->email,
                ], [
                    'email' => [
                        'required',
                        'string',
                        'email',
                        'max:70',
                        new EmailBlacklist(),
                    ],
                ]);

                if ($v->fails()) {
                    // If User Is Using A Disposable Email Set The Users Group To Banned
                    $user->group_id = $bannedGroup[0];
                    $user->can_upload = 0;
                    $user->can_download = 0;
                    $user->can_comment = 0;
                    $user->can_invite = 0;
                    $user->can_request = 0;
                    $user->can_chat = 0;
                    $user->save();

                    // Log The Ban To Ban Log
                    $domain = \substr(\strrchr($user->email, '@'), 1);
                    $logban = new Ban();
                    $logban->owned_by = $user->id;
                    $logban->created_by = 1;
                    $logban->ban_reason = 'Zaznan E-Mail naslov za enkratno uporabo, '.$domain.' ni dovoljeno.';
                    $logban->unban_reason = '';
                    $logban->save();

                    // Send Email
                    Mail::to($user->email)->send(new BanUser($user->email, $logban));
                }
            }
        });
        $this->comment('Samodejni ukaz za prepoved uporabnikov je dokončan');
    }
}
