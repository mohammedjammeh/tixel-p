<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\UpdateOrderRequest;
use Modules\Order\Models\Order;
use App\Wrappers\Contracts\TakeawayInterface;

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
        $order->update($request->validated());

        app(TakeawayInterface::class)->updateOrder($order->id, $request->validated());

        return ['order' => $order->refresh()];
    }
}
