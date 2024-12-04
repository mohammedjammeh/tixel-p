<?php

namespace Modules\Order\Wrappers;

use Illuminate\Http\JsonResponse;
use Modules\Order\Wrappers\Contracts\MainAppInterface;
use Symfony\Component\HttpFoundation\Response;

class MainAppAPI implements MainAppInterface
{
    public function __construct() {}

    public function updateOrder($id, $attributes): JsonResponse
    {
        return response()->json([], Response::HTTP_OK);
    }
}
