<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    private $types;

    public function __construct()
    {
        $this->types = $this->getTypes();
    }

    /**
     * Auto generated seed file.
     */
    public function run(): void
    {
        foreach ($this->types as $type) {
            Type::updateOrCreate($type);
        }
    }

    private function getTypes(): array
    {
        return [
            [
                'id'       => 1,
                'name'     => 'Xvid',
                'slug'     => 'xvid',
                'position' => 0,
            ],
            [
                'id'       => 2,
                'name'     => 'BluRay DISC',
                'slug'     => 'bluray-disc',
                'position' => 1,
            ],
            [
                'id'       => 3,
                'name'     => 'WebRip',
                'slug'     => 'webrip',
                'position' => 2,
            ],
            [
                'id'       => 4,
                'name'     => 'BluRay',
                'slug'     => 'bluray',
                'position' => 3,
            ],
            [
                'id'       => 5,
                'name'     => 'DVD-R',
                'slug'     => 'dvd-r',
                'position' => 4,
            ],
            [
                'id'       => 6,
                'name'     => 'TvRip',
                'slug'     => 'tvrip',
                'position' => 5,
            ],
            [
                'id'       => 7,
                'name'     => 'Celotni Album',
                'slug'     => 'celotni-album',
                'position' => 6,
            ],
            [
                'id'       => 8,
                'name'     => 'Remix',
                'slug'     => 'remix',
                'position' => 7,
            ],
            [
                'id'       => 9,
                'name'     => 'FLAC/WAV',
                'slug'     => 'flac-wav',
                'position' => 8,
            ],
            [
                'id'       => 10,
                'name'     => 'MP3',
                'slug'     => 'mp3',
                'position' => 9,
            ],
            [
                'id'       => 11,
                'name'     => 'Mac',
                'slug'     => 'mac',
                'position' => 10,
            ],
            [
                'id'       => 12,
                'name'     => 'UNIX',
                'slug'     => 'unix',
                'position' => 11,
            ],
            [
                'id'       => 13,
                'name'     => 'Windows Rip',
                'slug'     => 'windows-rip',
                'position' => 12,
            ],
            [
                'id'       => 14,
                'name'     => 'Windows',
                'slug'     => 'windows',
                'position' => 13,
            ],
            [
                'id'       => 15,
                'name'     => 'Windows ISO',
                'slug'     => 'windows-iso',
                'position' => 14,
            ],
            [
                'id'       => 16,
                'name'     => 'iOS',
                'slug'     => 'ios',
                'position' => 15,
            ],
            [
                'id'       => 17,
                'name'     => 'Android',
                'slug'     => 'android',
                'position' => 16,
            ],
            [
                'id'       => 18,
                'name'     => 'GSM',
                'slug'     => 'gsm',
                'position' => 17,
            ],
            [
                'id'       => 19,
                'name'     => 'Nitendo DS',
                'slug'     => 'nitendo ds',
                'position' => 18,
            ],
            [
                'id'       => 20,
                'name'     => 'Nitendo WII',
                'slug'     => 'nitendo wii',
                'position' => 19,
            ],
            [
                'id'       => 21,
                'name'     => 'Playstation',
                'slug'     => 'playstation',
                'position' => 20,
            ],
            [
                'id'       => 22,
                'name'     => 'PSP',
                'slug'     => 'psp',
                'position' => 21,
            ],
            [
                'id'       => 23,
                'name'     => 'Xbox',
                'slug'     => 'xbox',
                'position' => 22,
            ],
            [
                'id'       => 24,
                'name'     => 'Drugo',
                'slug'     => 'drugo',
                'position' => 23,
            ],
        ];
    }
}
