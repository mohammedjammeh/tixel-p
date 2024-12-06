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
        return [
            'orders' => Order::orderByDesc('created_at')->get(),
            'statuses' => collect(OrderStatus::cases())->pluck('value')->toArray(),
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

        return ['order' => $order->refresh()];
    }
}
