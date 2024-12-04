<?php

namespace Modules\Order\Wrappers\Contracts;

interface MainAppInterface
{
    function updateOrder($id, $attributes);
}
