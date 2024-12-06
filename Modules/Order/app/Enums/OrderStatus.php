<?php

namespace Modules\Order\Enums;

enum OrderStatus: string
{
    case NEW = 'new';
    case PREPARE = 'prepare';
    case COOK = 'cook';
    case READY = 'ready';
}
