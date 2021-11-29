<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

final class UserContactToggleFailure extends Exception
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => __('User contact toggle failed.')
        ], 400);
    }
}
