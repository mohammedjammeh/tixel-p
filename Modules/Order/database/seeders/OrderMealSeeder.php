<?php

namespace Modules\Order\Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Modules\Order\Models\OrderMeal;

class OrderMealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderMeal::factory()
            ->count(16)
            ->state(new Sequence(
                ['order_id' => 1, 'meal_id' => 1],
                ['order_id' => 1, 'meal_id' => 2],

                ['order_id' => 2, 'meal_id' => 2],
                ['order_id' => 2, 'meal_id' => 3],

                ['order_id' => 3, 'meal_id' => 3],
                ['order_id' => 3, 'meal_id' => 8],

                ['order_id' => 4, 'meal_id' => 1],
                ['order_id' => 4, 'meal_id' => 2],

                ['order_id' => 5, 'meal_id' => 3],
                ['order_id' => 5, 'meal_id' => 5],

                ['order_id' => 6, 'meal_id' => 1],
                ['order_id' => 6, 'meal_id' => 6],

                ['order_id' => 7, 'meal_id' => 2],
                ['order_id' => 7, 'meal_id' => 7],

                ['order_id' => 8, 'meal_id' => 6],
                ['order_id' => 8, 'meal_id' => 8],
            ))
            ->create();
    }
}
