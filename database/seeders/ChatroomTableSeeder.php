<?php

namespace Database\Seeders;

use App\Models\Chatroom;
use Illuminate\Database\Seeder;

class ChatroomTableSeeder extends Seeder
{
    private $rooms;

    public function __construct()
    {
        $this->rooms = $this->getRooms();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->rooms as $room) {
            Chatroom::updateOrCreate($room);
        }
    }

    private function getRooms(): array
    {
        return [
            [
                'name' => 'General',
            ],
            [
                'name' => 'Trivia',
            ],
        ];
    }
}
