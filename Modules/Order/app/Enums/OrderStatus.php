<?php

namespace Modules\Order\Enums;

enum OrderStatus: string
{
    case NEW = 'new';
    case PREPARING = 'preparing';
    case COOKING = 'cooking';
    case READY = 'ready';
}
