<?php

namespace Modules\Order\Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Modules\Order\Enums\OrderStatus;
use Modules\Order\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()
            ->count(8)
            ->state(new Sequence(
                ['created_at' => Carbon::now()->subMinutes(40)],
                ['created_at' => Carbon::now()->subMinutes(35)],
                ['created_at' => Carbon::now()->subMinutes(30)],
                ['created_at' => Carbon::now()->subMinutes(25)],
                ['created_at' => Carbon::now()->subMinutes(20)],
                ['created_at' => Carbon::now()->subMinutes(15)],
                ['created_at' => Carbon::now()->subMinutes(10)],
                ['created_at' => Carbon::now()->subMinutes(5)],
            ))
            ->create(['status' => OrderStatus::NEW]);
    }
}
