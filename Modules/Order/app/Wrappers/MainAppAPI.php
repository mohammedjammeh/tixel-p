<?php

namespace Modules\Order\Wrappers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Modules\Order\Wrappers\Contracts\MainAppInterface;
use Symfony\Component\HttpFoundation\Response;

class MainAppAPI implements MainAppInterface
{
    public function __construct() {}

    public function updateOrder($id, $attributes): JsonResponse
    {
//        return Http::acceptJson()
//            ->withHeaders([])
//            ->withQueryParameters([])
//            ->timeout(60)
//            ->patch(
//                'https://main-app-api.com',
//                []
//            );

        return response()->json([], Response::HTTP_OK);
    }
}
