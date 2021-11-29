<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Builder;
use App\Exceptions\UserContactToggleFailure;

final class UserFavoriteContactsService
{
    /**
     * @param \Illuminate\Database\DatabaseManager $db
     * @param \App\Services\UserContactsService $userContactsService
     */
    public function __construct(
        private DatabaseManager $db,
        private UserContactsService $userContactsService,
    ) {}

    /**
     * @param int $contactId
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     * @throws \App\Exceptions\UserContactNotFound
     * @throws \App\Exceptions\UserContactToggleFailure
     * @throws \Throwable
     */
    public function toggle(int $contactId, int $userId): Builder|Model
    {
        $contact = $this->userContactsService->findOrFail($contactId, $userId);

        $this->db->beginTransaction();

        try {
            $contact->is_favorite = ! $contact->is_favorite;

            if (! $contact->save()) {
                throw new UserContactToggleFailure;
            }

            $this->db->commit();
        } catch (UserContactToggleFailure $exception) {
            $this->db->rollBack();

            throw $exception;
        }

        return $contact;
    }
}
