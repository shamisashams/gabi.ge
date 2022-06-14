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
use App\Models\Setting;
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

            ],
            [
                'key' => 'instagram',

            ],

        ];


        // Insert localizations
        Setting::insert($localizations);
    }
}
