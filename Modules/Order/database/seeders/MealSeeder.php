<?php

namespace Modules\Order\Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Modules\Order\Models\Meal;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Meal::factory()
            ->count(8)
            ->state(new Sequence(
                ['name' => 'margherita'],
                ['name' => 'vegan'],
                ['name' => 'mixed'],
                ['name' => 'chicken'],
                ['name' => 'spicy beef'],
                ['name' => 'cheese'],
                ['name' => 'vegetarian'],
                ['name' => 'tomato'],
            ))
            ->create();
    }
}
