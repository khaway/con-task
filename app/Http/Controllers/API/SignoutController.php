<?php

namespace App\Http\Controllers\API;

use function response;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class SignoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Services\AuthService $authService
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, AuthService $authService): JsonResponse
    {
        // @todo check for true/false
        $authService->signout($request->user());

        // @todo make response class using toResponse() interface.
        return response()->json([
            'message' => 'Successfully signed out.'
        ], 200);
    }
}
