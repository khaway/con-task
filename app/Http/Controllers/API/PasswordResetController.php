<?php

namespace App\Http\Controllers\API;

use function response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\UserPasswordService;
use App\Http\Requests\PasswordResetRequest;

final class PasswordResetController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \App\Http\Requests\PasswordResetRequest $request
     * @param \App\Services\UserPasswordService $userPasswordService
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function __invoke(
        PasswordResetRequest $request,
        UserPasswordService $userPasswordService
    ): JsonResponse {
        $userPasswordService->resetByEmail($request->get('email'));

        // @todo replace with response class.
        return response()->json([
            'message' => 'Successful password reset.'
        ], 200);
    }
}
