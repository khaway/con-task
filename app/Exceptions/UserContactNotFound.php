<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

final class UserContactNotFound extends Exception
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => __('User contact not found.')
        ], 400);
    }
}
