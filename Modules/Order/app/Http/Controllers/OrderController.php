<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Order\Enums\OrderStatus;
use Modules\Order\Http\Requests\UpdateOrderRequest;
use Modules\Order\Models\Order;

class OrderController extends Controller
{
    /**
     * Gets list of orders.
     *
     * @return array<string, string>
     */
    public function index(): array
    {
        $orders = Order::with(['meals'])
            ->orderByDesc('created_at')
            ->get()
            ->append('meals_names');

        $statuses = collect(OrderStatus::cases())
            ->pluck('value')
            ->toArray();

        return [
            'orders' => $orders,
            'statuses' => $statuses,
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @return array<string, string>
     */
    public function update(UpdateOrderRequest $request, Order $order): array
    {
        $order->update($request->validated());

        $order = $order->refresh()->append('meals_names');

        return ['order' => $order];
    }
}
