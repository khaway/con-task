<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

final class PasswordResetTokenExpired extends Exception
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => __('Reset password confirm token is expired')
        ], 400);
    }
}
