<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            GroupsTableSeeder::class,
            UsersTableSeeder::class,
            BonExchangeTableSeeder::class,
            AchievementDetailsTableSeeder::class,
            PagesTableSeeder::class,
            CategoriesTableSeeder::class,
            TypesTableSeeder::class,
            ArticlesTableSeeder::class,
            PermissionsTableSeeder::class,
            ForumsTableSeeder::class,
            ChatroomTableSeeder::class,
            ChatStatusSeeder::class,
            BotsTableSeeder::class,
            MediaLanguagesSeeder::class,
            ResolutionsTableSeeder::class,
            TicketCategoriesTableSeeder::class,
            TicketPrioritiesTableSeeder::class,
            DistributorsTableSeeder::class,
            RegionsTableSeeder::class,
        ]);
    }
}
