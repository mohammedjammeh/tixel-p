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
                [
//                    'status' => OrderStatus::READY,
                    'created_at' => Carbon::now()->subMinutes(40)
                ],
                [
//                    'status' => OrderStatus::READY,
                    'created_at' => Carbon::now()->subMinutes(35)
                ],
                [
//                    'status' => OrderStatus::COOK,
                    'created_at' => Carbon::now()->subMinutes(30)
                ],
                [
//                    'status' => OrderStatus::COOK,
                    'created_at' => Carbon::now()->subMinutes(25)
                ],
                [
//                    'status' => OrderStatus::PREPARE,
                    'created_at' => Carbon::now()->subMinutes(20)
                ],
                [
//                    'status' => OrderStatus::PREPARE,
                    'created_at' => Carbon::now()->subMinutes(15)
                ],
                [
//                    'status' => OrderStatus::NEW,
                    'created_at' => Carbon::now()->subMinutes(10)
                ],
                [
//                    'status' => OrderStatus::NEW,
                    'created_at' => Carbon::now()->subMinutes(5)
                ],
            ))
            ->create(['status' => OrderStatus::NEW]);
    }
}
