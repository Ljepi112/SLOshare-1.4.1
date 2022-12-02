<?php

namespace Database\Seeders;

use App\Models\Resolution;
use Illuminate\Database\Seeder;

class ResolutionsTableSeeder extends Seeder
{
    private $resolutions;

    public function __construct()
    {
        $this->resolutions = $this->getResolutions();
    }

    /**
     * Auto generated seed file.
     */
    public function run(): void
    {
        foreach ($this->resolutions as $resolution) {
            Resolution::updateOrCreate($resolution);
        }
    }

    private function getResolutions(): array
    {
        return [
            [
                'id'       => 1,
                'name'     => '8K-4320p',
                'slug'     => '8k-4320p',
                'position' => 0,
            ],
            [
                'id'       => 2,
                'name'     => '4K-2160p',
                'slug'     => '4k-2160p',
                'position' => 1,
            ],
            [
                'id'       => 3,
                'name'     => '1080p',
                'slug'     => '1080p',
                'position' => 2,
            ],
            [
                'id'       => 4,
                'name'     => '720p',
                'slug'     => '720p',
                'position' => 3,
            ],
            [
                'id'       => 5,
                'name'     => 'DO 720p',
                'slug'     => 'do-720p',
                'position' => 4,
            ],
            [
                'id'       => 6,
                'name'     => '3D',
                'slug'     => '3d',
                'position' => 5,
            ],
            [
                'id'       => 7,
                'name'     => 'Drugo',
                'slug'     => 'drugo',
                'position' => 6,
            ],
        ];
    }
}
