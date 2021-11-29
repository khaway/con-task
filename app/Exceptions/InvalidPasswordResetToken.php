<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

final class InvalidPasswordResetToken extends Exception
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => __('Invalid reset-password token')
        ], 400);
    }
}
