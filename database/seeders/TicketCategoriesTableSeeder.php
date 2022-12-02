<?php

namespace Database\Seeders;

use App\Models\TicketCategory;
use Illuminate\Database\Seeder;

class TicketCategoriesTableSeeder extends Seeder
{
    private array $categories;

    public function __construct()
    {
        $this->categories = $this->getTicketCategories();
    }

    /**
     * Auto generated seed file.
     *
     * @return voids
     */
    final public function run(): void
    {
        foreach ($this->categories as $category) {
            TicketCategory::updateOrCreate($category);
        }
    }

    /**
     * @return array[]
     */
    private function getTicketCategories(): array
    {
        return [
            [
                'name'     => 'Račun',
                'position' => 0,
            ],
            [
                'name'     => 'Pritožba',
                'position' => 1,
            ],
            [
                'name'     => 'Forum',
                'position' => 2,
            ],
            [
                'name'     => 'Zahteve',
                'position' => 3,
            ],
            [
                'name'     => 'Podnapisi',
                'position' => 4,
            ],
            [
                'name'     => 'Torrent',
                'position' => 5,
            ],
            [
                'name'     => 'MediaHub',
                'position' => 6,
            ],
            [
                'name'     => 'Tehnične Težave',
                'position' => 7,
            ],
            [
                'name'     => 'Seznami predvajanja',
                'position' => 8,
            ],
            [
                'name'     => 'Hrošči',
                'position' => 9,
            ],
            [
                'name'     => 'Drugo',
                'position' => 10,
            ],
        ];
    }
}
