<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Services\UserContactsService;
use App\Http\Resources\ContactResource;
use App\Http\Resources\ContactsResource;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;

final class ContactController extends Controller
{
    public function __construct(
        private UserContactsService $userContactsService
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\ContactsResource
     */
    public function index(Request $request): ContactsResource
    {
        return new ContactsResource(
            $this->userContactsService->all($request->user()->id)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreContactRequest $request
     * @return \App\Http\Resources\ContactResource
     * @throws \Exception
     */
    public function store(StoreContactRequest $request): ContactResource
    {
        return new ContactResource(
            $this->userContactsService->store(
                $request->user()->id,
                $request->only(['name', 'phone'])
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $contactId
     * @return \App\Http\Resources\ContactResource
     * @throws \App\Exceptions\UserContactNotFound
     */
    public function show(Request $request, int $contactId): ContactResource
    {
        return new ContactResource(
            $this->userContactsService->findOrFail($contactId, $request->user()->id)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateContactRequest $request
     * @param int $id
     * @return \App\Http\Resources\ContactResource|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function update(UpdateContactRequest $request, int $contactId): ContactResource|Response
    {
        return new ContactResource(
            $this->userContactsService->update(
                $request->user()->id,
                $contactId,
                $request->only(['name', 'phone'])
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $contactId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $contactId)
    {
        return $this->userContactsService->delete($contactId, $request->user()->id);
    }
}
