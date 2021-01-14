<?php

namespace Database\Seeders;

use App\Models\Subcription\SubcriptionType;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        SubcriptionType::create([
            'order' => 1,
            'type' => "High",
        ]);

        SubcriptionType::create([
            'order' => 2,
            'type' => "Medium",
        ]);

        SubcriptionType::create([
            'order' => 3,
            'type' => "Low",
        ]);
    }
}
