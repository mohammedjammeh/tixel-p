<?php

namespace Modules\Order\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Order\Models\Meal;
use Modules\Order\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Order\Models\Meal>
 */
class OrderMealFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Order\Models\OrderMeal::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $order = Order::first() ?? Order::factory()->create();
        $meal = Meal::first() ?? Meal::factory()->create();

        return [
            'order_id' => $order->id,
            'meal_id' => $meal->id,
        ];
    }
}
