<?php
/**
 *  database/seeders/LocalizationSeeder.php
 *
 * User:
 * Date-Time: 07.12.20
 * Time: 11:53
 * @author Insite International <hello@insite.international>
 */

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Localization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // Localization Array
        $localizations = [
            [
                'key' => 'facebook',
                'abbreviation' => 'ge',
                'native' => 'ქართული',
                'locale' => 'ka_GE',
                'status' => true,
                'default' => true
            ],
            [
                'key' => 'instagram',
                'abbreviation' => 'en',
                'native' => 'English',
                'locale' => 'en_US',
                'status' => true,
                'default' => false
            ],
            [
                'title' => 'RUS',
                'abbreviation' => 'ru',
                'native' => 'Русский',
                'locale' => 'ru_RU',
                'status' => true,
                'default' => false
            ]
        ];


        // Insert localizations
        Language::insert($localizations);
    }
}
