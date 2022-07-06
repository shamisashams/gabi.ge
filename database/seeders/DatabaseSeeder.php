<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            LanguageSeeder::class,
            PageSeeder::class,
            // PageSectionSeeder::class,
            SettingSeeder::class,
            // UserSeeder::class,
            HtagSeeder::class,
            BankSeeder::class,
            CategorySeeder::class,
            PermissionsSeeder::class,
            SettingHtagSeeder::class,
        ]);
    }
}
