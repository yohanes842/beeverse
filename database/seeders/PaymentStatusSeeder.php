<?php

namespace Database\Seeders;

use App\Models\PaymentStatus;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentStatus::insert([
            [
                'status_name' => 'not finish'
            ],
            [
                'status_name' => 'finish'
            ],
        ]);
    }
}
