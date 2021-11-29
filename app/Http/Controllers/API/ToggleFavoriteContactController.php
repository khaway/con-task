<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Services\UserFavoriteContactsService;

class ToggleFavoriteContactController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Services\UserFavoriteContactsService $userFavoriteContactsService
     * @param int $contactId
     * @return \App\Http\Resources\ContactResource
     * @throws \App\Exceptions\UserContactNotFound
     * @throws \App\Exceptions\UserContactToggleFailure
     * @throws \Throwable
     */
    public function __invoke(
        Request $request,
        UserFavoriteContactsService $userFavoriteContactsService,
        int $contactId
    ): ContactResource {
        return new ContactResource(
            $userFavoriteContactsService->toggle(
                $contactId,
                $request->user()->id
            )
        );
    }
}
