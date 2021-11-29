<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

final class CreateUserTokenFailed extends Exception
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => __('Create user token failed.')
        ], 400);
    }
}
