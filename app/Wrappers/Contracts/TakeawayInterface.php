<?php

namespace App\Wrappers\Contracts;

interface TakeawayInterface
{
    function updateOrder($id, $attributes);
}
