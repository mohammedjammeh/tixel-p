<?php

namespace Modules\Order\Enums;

enum OrderStatus: string
{
    case NEW = 'new';
    case PREPARED = 'prepared';
    case COOKED = 'cooked';
    case READY = 'ready';
}
