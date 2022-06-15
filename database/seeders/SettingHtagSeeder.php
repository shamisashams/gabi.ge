<?php

namespace Database\Seeders;

use App\Models\Bank;

use App\Models\PaymentType;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingHtagSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $localizations = [
            [
                'key' => 'h1',

            ],
            [
                'key' => 'h2',

            ],
            [
                'key' => 'h3',

            ],
            [
                'key' => 'h4',

            ],
            [
                'key' => 'h5',

            ],
            [
                'key' => 'h6',

            ],

        ];


        // Insert localizations
        Setting::insert($localizations);
    }
}
