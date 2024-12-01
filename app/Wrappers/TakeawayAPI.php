<?php

namespace App\Wrappers;


use App\Wrappers\Contracts\TakeawayInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TakeawayAPI implements TakeawayInterface
{
    public function __construct()
    {
    }

    public function updateOrder($id, $attributes): JsonResponse
    {
        return response()->json([], Response::HTTP_OK);
    }
}
