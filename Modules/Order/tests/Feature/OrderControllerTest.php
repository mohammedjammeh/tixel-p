<?php

namespace Modules\Order\Tests\Feature;

use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Queue;
use Modules\Order\Enums\OrderStatus;
use Modules\Order\Jobs\OrderStatusUpdated;
use Modules\Order\Models\Order;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method_returns_list_of_orders_ordered_by_created_at(): void
    {
        $orders = Order::factory()
            ->count(2)
            ->state(new Sequence(
                ['created_at' => Carbon::now()->subHour()],
                ['created_at' => Carbon::now()],
            ))
            ->create();

        $response = $this->get(route('orders.index'));
        $responseOrders = $response->baseResponse->original['orders'];

        $this->assertEquals(
            [$orders->get(1)->id, $orders->get(0)->id],
            $responseOrders->pluck('id')->toArray(),
        );
    }

    #[DataProvider('updateValidationDataProvider')]
    public function test_update_method_data_gets_validated($field, $value, $error): void
    {
        $order = Order::factory()->create([
            'status' => OrderStatus::NEW,
        ]);

        $response = $this->patch(
            route('orders.update', ['order' => $order->id]),
            [$field => $value]
        );

        $response->assertSessionHasErrors([$field => $error]);
    }

    public static function updateValidationDataProvider(): array
    {
        return [
            ['status', 'hey', 'The selected status is invalid.'],
            ['status', '100', 'The selected status is invalid.'],
        ];
    }

    public function test_update_method_updates_order(): void
    {
        Queue::fake();

        $order = Order::factory()->create(['status' => OrderStatus::NEW]);

        $this->patch(
            route('orders.update', ['order' => $order->id]),
            ['status' => OrderStatus::PREPARING->value]
        );

        $this->assertEquals(
            OrderStatus::PREPARING,
            $order->refresh()->status,
        );
    }

    public function test_update_method_dispatches_order_status_updated_job(): void
    {
        Queue::fake();

        $order = Order::factory()->create(['status' => OrderStatus::NEW]);

        $this->patch(
            route('orders.update', ['order' => $order->id]),
            ['status' => OrderStatus::PREPARING->value]
        );

        Queue::assertPushed(function (OrderStatusUpdated $job) use ($order) {
            return $job->orderId === $order->id &&
                $job->data === ['status' => OrderStatus::PREPARING->value];
        });
    }

    public function test_update_method_returns_updated_order(): void
    {
        Queue::fake();

        $order = Order::factory()->create(['status' => OrderStatus::NEW]);

        $response = $this->patch(
            route('orders.update', ['order' => $order->id]),
            ['status' => OrderStatus::PREPARING->value]
        );
        $responseOrder = $response->baseResponse->original['order'];

        $this->assertEquals(
            $order->id,
            $responseOrder->id,
        );
    }
}
