<?php

namespace Database\Seeders;

use App\Models\Bank;

use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Pages array
        $data =
            [
                'title' => 'card',
                'status' => 1,
            ];
        $p_id = PaymentType::query()->insertGetId($data);

        $data =
            [
                'payment_type_id' => $p_id,
                'title' => 'bog',
                'config_path' => ''
            ];

            Bank::query()->insert($data);


    }
}
