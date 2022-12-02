<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    private $users;

    public function __construct()
    {
        $this->users = $this->getUsers();
    }

    /**
     * Auto generated seed file.
     */
    public function run(): void
    {
        foreach ($this->users as $user) {
            User::updateOrCreate($user);
        }
    }

    private function getUsers(): array
    {
        return [
            [
                'username'  => 'System',
                'email'     => config('sloshare.default-owner-email'),
                'group_id'  => 13,
                'password'  => \Hash::make(config('sloshare.default-owner-password')),
                'passkey'   => md5(random_bytes(60)),
                'rsskey'    => md5(random_bytes(60)),
                'api_token' => Str::random(100),
                'active'    => 1,
            ],
            [
                'username'  => 'Bot',
                'email'     => config('sloshare.default-owner-email'),
                'group_id'  => 13,
                'password'  => \Hash::make(config('sloshare.default-owner-password')),
                'passkey'   => md5(random_bytes(60)),
                'rsskey'    => md5(random_bytes(60)),
                'api_token' => Str::random(100),
                'active'    => 1,
            ],
            [
                'username'  => config('sloshare.owner-username'),
                'email'     => config('sloshare.default-owner-email'),
                'group_id'  => 12,
                'password'  => \Hash::make(config('sloshare.default-owner-password')),
                'passkey'   => md5(random_bytes(60)),
                'rsskey'    => md5(random_bytes(60)),
                'api_token' => Str::random(100),
                'active'    => 1,
            ],
        ];
    }
}
