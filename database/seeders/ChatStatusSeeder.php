<?php

namespace Database\Seeders;

use App\Models\ChatStatus;
use Illuminate\Database\Seeder;

class ChatStatusSeeder extends Seeder
{
    private $statuses;

    public function __construct()
    {
        $this->statuses = $this->getStatuses();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->statuses as $status) {
            ChatStatus::updateOrCreate($status);
        }
    }

    private function getStatuses(): array
    {
        return [
            [
                'name'  => 'Online',
                'color' => '#2ECC40',
                'icon'  => config('other.font-awesome').' fa-comment-smile',
            ],
            [
                'name'  => 'Away',
                'color' => '#FFDC00',
                'icon'  => config('other.font-awesome').' fa-comment-minus',
            ],
            [
                'name'  => 'Busy',
                'color' => '#FF4136',
                'icon'  => config('other.font-awesome').' fa-comment-exclamation',
            ],
            [
                'name'  => 'Offline',
                'color' => '#AAAAAA',
                'icon'  => config('other.font-awesome').' fa-comment-slash',
            ],
        ];
    }
}
