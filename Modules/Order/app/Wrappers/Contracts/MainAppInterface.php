<?php

namespace Modules\Order\Wrappers\Contracts;

interface MainAppInterface
{
    public function updateOrder($id, $attributes);
}
