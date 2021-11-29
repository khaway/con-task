<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

final class PasswordResetDeleteFailed extends Exception
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => __('Password reset delete failed.')
        ], 400);
    }
}
