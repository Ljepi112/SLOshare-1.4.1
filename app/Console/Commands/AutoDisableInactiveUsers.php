<?php

namespace App\Console\Commands;

use App\Jobs\SendDisableUserMail;
use App\Models\Group;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

/**
 * @see \Tests\Unit\Console\Commands\AutoDisableInactiveUsersTest
 */
class AutoDisableInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:disable_inactive_users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uporabniški račun mora biti star vsaj x dni in uporabniški račun x dni nedejavnosti, da bo onemogočen';

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle(): void
    {
        if (\config('pruning.user_pruning')) {
            $disabledGroup = \cache()->rememberForever('disabled_group', fn () => Group::where('slug', '=', 'disabled')->pluck('id'));

            $current = Carbon::now();

            $matches = User::whereIntegerInRaw('group_id', \config('pruning.group_ids'))->get();

            $users = $matches->where('created_at', '<', $current->copy()->subDays(\config('pruning.account_age'))->toDateTimeString())
                ->where('last_login', '<', $current->copy()->subDays(\config('pruning.last_login'))->toDateTimeString())
                ->all();

            foreach ($users as $user) {
                if ($user->seedingTorrents()->count() === 0) {
                    $user->group_id = $disabledGroup[0];
                    $user->can_upload = 0;
                    $user->can_download = 0;
                    $user->can_comment = 0;
                    $user->can_invite = 0;
                    $user->can_request = 0;
                    $user->can_chat = 0;
                    $user->disabled_at = Carbon::now();
                    $user->save();

                    // Send Email
                    \dispatch(new SendDisableUserMail($user));
                }
            }
        }

        $this->comment('Ukaz za samodejno onemogočitev uporabnika je dokončan');
    }
}
