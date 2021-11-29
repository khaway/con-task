<?php

namespace App\Http\Controllers\API;

use function response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\UserPasswordService;
use App\Http\Requests\PasswordUpdateRequest;

final class PasswordUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \App\Http\Requests\PasswordUpdateRequest $request
     * @param \App\Services\UserPasswordService $userPasswordService
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\InvalidPasswordResetToken
     * @throws \App\Exceptions\PasswordResetDeleteFailed
     * @throws \App\Exceptions\PasswordResetTokenExpired
     * @throws \Throwable
     */
    public function __invoke(
        PasswordUpdateRequest $request,
        UserPasswordService $userPasswordService,
    ): JsonResponse
    {
        $userPasswordService->update(
            $request->get('email'),
            $request->get('new_password'),
            $request->get('reset_token')
        );

        // @todo replace with response class.
        return response()->json([
            'message' => 'Password updated.'
        ], 200);
    }
}
