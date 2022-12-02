<?php

namespace Database\Seeders;

use App\Models\TicketPriority;
use Illuminate\Database\Seeder;

class TicketPrioritiesTableSeeder extends Seeder
{
    private array $priorities;

    public function __construct()
    {
        $this->priorities = $this->getTicketPriorities();
    }

    /**
     * Auto generated seed file.
     *
     * @return voids
     */
    final public function run(): void
    {
        foreach ($this->priorities as $priority) {
            TicketPriority::updateOrCreate($priority);
        }
    }

    /**
     * @return array[]
     */
    private function getTicketPriorities(): array
    {
        return [
            [
                'name'     => 'Nizka',
                'position' => 0,
            ],
            [
                'name'     => 'Srednja',
                'position' => 1,
            ],
            [
                'name'     => 'Visoka',
                'position' => 2,
            ],
        ];
    }
}
