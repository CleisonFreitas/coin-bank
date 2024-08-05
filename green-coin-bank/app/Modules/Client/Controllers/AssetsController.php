<?php

namespace App\Modules\Client\Controllers;

use App\Modules\Client\Services\AssetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

final class AssetsController
{
    public function __construct(
        private readonly AssetService $service
    ) {}

    public function index(Request $request)
    {
        $forceConsult = $request->input('forceConsult', false);
        $term = Str::upper($request->input('term', null));
        return response()->json([
            'data' => $this->service->getAll(
                forceConsult: $forceConsult,
                term: $term
            )
        ], Response::HTTP_OK);
    }

    public function findByTerm(Request $request): JsonResponse
    {
        $term = Str::upper($request->input('term', ''));
        return response()->json(
            $this->service->show(term: $term),
            Response::HTTP_OK
        );
    }
}
