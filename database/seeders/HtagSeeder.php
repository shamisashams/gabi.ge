<?php

namespace Database\Seeders;

use App\Models\Bank;

use App\Models\Htag;
use App\Models\PaymentType;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class HtagSeeder extends Seeder
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
                'key' => 'category',

            ],
            [
                'key' => 'product',

            ],
            [
                'key' => 'slider',

            ],
            [
                'key' => 'blog',

            ],

        ];


        // Insert localizations
        Htag::insert($localizations);
    }
}
