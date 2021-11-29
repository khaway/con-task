<?php

namespace App\Http\Controllers\API;

use App\Services\AuthService;
use App\Http\Requests\SigninRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\TokenResource;

final class SigninController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \App\Http\Requests\SigninRequest $request
     * @param \App\Services\AuthService $authService
     * @return \App\Http\Resources\TokenResource
     * @throws \App\Exceptions\CreateUserTokenFailed
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function __invoke(
        SigninRequest $request,
        AuthService $authService,
    ): TokenResource {
        return new TokenResource(
            $authService->signin($request->get('email'), $request->get('password'))
        );
    }
}
