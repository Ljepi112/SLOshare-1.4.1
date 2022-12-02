<?php

namespace Database\Seeders;

use App\Models\Forum;
use Illuminate\Database\Seeder;

class ForumsTableSeeder extends Seeder
{
    private $forums;

    public function __construct()
    {
        $this->forums = $this->getForums();
    }

    /**
     * Auto generated seed file.
     */
    public function run(): void
    {
        foreach ($this->forums as $forum) {
            Forum::updateOrCreate($forum);
        }
    }

    private function getForums(): array
    {
        return [
            [
                'id'                      => 1,
                'position'                => 1,
                'num_topic'               => null,
                'num_post'                => null,
                'last_topic_id'           => null,
                'last_topic_name'         => null,
                'last_topic_slug'         => null,
                'last_post_user_id'       => null,
                'last_post_user_username' => null,
                'name'                    => 'SLOshare.eu Forum',
                'slug'                    => 'sloshare.eu-forum',
                'description'             => 'SLOshare.eu Forum',
                'parent_id'               => 0,
                'created_at'              => '2021-11-01 18:29:21',
                'updated_at'              => '2021-11-01 18:29:21',
            ],
            [
                'id'                      => 2,
                'position'                => 2,
                'num_topic'               => null,
                'num_post'                => null,
                'last_topic_id'           => null,
                'last_topic_name'         => null,
                'last_topic_slug'         => null,
                'last_post_user_id'       => null,
                'last_post_user_username' => null,
                'name'                    => 'Dobrodošli',
                'slug'                    => 'dobrodošli',
                'description'             => 'Predstavite se tukaj!',
                'parent_id'               => 1,
                'created_at'              => '2021-11-01 20:16:06',
                'updated_at'              => '2021-11-01 18:19:07',
            ],
        ];
    }
}
