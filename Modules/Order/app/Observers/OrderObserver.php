<?php

namespace Modules\Order\Observers;

use Modules\Order\Jobs\OrderStatusUpdated;
use Modules\Order\Models\Order;
use Modules\Order\Wrappers\Contracts\MainAppInterface;

class OrderObserver
{
    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        if ($order->isClean('status')) return;

        OrderStatusUpdated::dispatch($order->id, ['status' => $order->status->value]);

//        app(MainAppInterface::class)->updateOrder($order->id, ['status' => $order]);
    }
}
