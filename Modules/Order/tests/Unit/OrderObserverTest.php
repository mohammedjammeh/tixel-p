<?php

namespace Modules\Order\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Modules\Order\Enums\OrderStatus;
use Modules\Order\Jobs\OrderStatusUpdated;
use Modules\Order\Models\Order;
use Tests\TestCase;

class OrderObserverTest extends TestCase
{
    use RefreshDatabase;

    public function test_updating_order_status_dispatches_order_status_updated_job(): void
    {
        Queue::fake();

        $order = Order::factory()->create(['status' => OrderStatus::NEW]);

        $order->update(['status' => OrderStatus::PREPARED]);

        Queue::assertPushed(function (OrderStatusUpdated $job) use ($order) {
            return $job->orderId === $order->id &&
                $job->data === ['status' => OrderStatus::PREPARED->value];
        });
    }

    public function test_order_status_updated_job_does_not_get_dispatched_if_status_has_not_changed(): void
    {
        Queue::fake();

        $order = Order::factory()->create(['status' => OrderStatus::NEW]);

        $order->update(['status' => OrderStatus::NEW]);

        Queue::assertNotPushed(OrderStatusUpdated::class);
    }
}
