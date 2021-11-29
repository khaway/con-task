<?php

namespace App\Http\Controllers\API;

use App\Services\AuthService;
use App\Http\Requests\SignupRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\TokenResource;

final class SignupController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \App\Http\Requests\SignupRequest $request
     * @param \App\Services\AuthService $authService
     * @return \App\Http\Resources\TokenResource
     * @throws \App\Exceptions\SignupFailed
     * @throws \Throwable
     */
    public function __invoke(SignupRequest $request, AuthService $authService): TokenResource
    {
        return new TokenResource(
            $authService->signup(
                $request->only(['password', 'email'])
            )
        );
    }
}
