<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Order\Http\Requests\UpdateOrderRequest;
use Modules\Order\Jobs\OrderStatusUpdated;
use Modules\Order\Models\Order;
use Modules\Order\Wrappers\Contracts\MainAppInterface;

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
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @return array<string, string>
     */
    public function update(UpdateOrderRequest $request, Order $order): array
    {
        $validated = $request->validated();

        $order->update($validated);

        OrderStatusUpdated::dispatch($order->id, $validated);

//        app(MainAppInterface::class)->updateOrder($order->id, $validated);

        return ['order' => $order->refresh()];
    }
}
