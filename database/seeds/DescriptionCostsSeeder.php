<?php

use App\Models\DescriptionCost;
use Illuminate\Database\Seeder;

class DescriptionCostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $descriptionCosts = [
            [
                'lower_limit' => 1,
                'upper_limit' => 10,
                'price' => 5125,
                'description' => 'Pengelompokan 1'
            ],
            [
                'lower_limit' => 11,
                'upper_limit' => 20,
                'price' => 5700,
                'description' => 'Pengelompokan 2'
            ],
            [
                'lower_limit' => 21,
                'upper_limit' => 200,
                'price' => 6850,
                'description' => 'Pengelompokan 3'
            ],
        ];

        foreach ($descriptionCosts as $key => $usedescriptionCost) {
            DescriptionCost::create($usedescriptionCost);
        }
    }
}
