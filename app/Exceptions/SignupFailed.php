<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

final class SignupFailed extends Exception
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => __('Signup failed.')
        ], 400);
    }
}
