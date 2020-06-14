<?php

use Illuminate\Database\Seeder;
use App\Models\OtherCost;

class OtherCostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $otherCosts = [
            [
                'name' => 'Biaya Admin',
                'price' => 7500
            ],
            [
                'name' => 'Biaya Denda',
                'price' => 5000
            ]
        ];

        foreach ($otherCosts as $key => $otherCost) {
            OtherCost::create($otherCost);
        }
    }
}
