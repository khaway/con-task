<?php

namespace App\Services;

use Exception;
use App\Models\Contact;
use Illuminate\Support\Arr;
use App\Exceptions\UserContactNotFound;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\UserContactsRepository;
use Illuminate\Database\Eloquent\Collection;

final class UserContactsService
{
    /**
     * @param \Illuminate\Database\DatabaseManager $db
     * @param \App\Repositories\UserContactsRepository $userContactsRepository
     */
    public function __construct(
        private DatabaseManager $db,
        private UserContactsRepository $userContactsRepository,
    ) {}

    /**
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(int $userId): Collection|array
    {
        return Contact::query()
            ->where('user_id', $userId)
            ->select(['id', 'name', 'phone', 'is_favorite'])
            ->get();
    }

    public function store(int $userId, array $attributes)
    {
        $contactAlreadyExists = Contact::query()
            ->where([
                'user_id' => $userId,
                'phone' => $attributes['phone']
            ])
            ->select(['id', 'name', 'phone', 'is_favorite'])
            ->first();

        if ($contactAlreadyExists) {
            throw new Exception("Contact already exists");
        }

        $newContact = Contact::create([
            'user_id' => $userId,
            'phone' => $attributes['phone'],
            'name' => $attributes['name']
        ]);

        return $newContact;
    }

    /**
     * @param int $userId
     * @param int $contactId
     * @param array $attributes
     * @return mixed
     * @throws \Exception
     */
    public function update(int $userId, int $contactId, array $attributes): mixed
    {
        if (isset($attributes['phone'])) {
            $isPhoneDuplicate = Contact::query()
                ->where([
                    'user_id' => $userId,
                    'phone' => $attributes['phone']
                ])->whereNotIn('id', [$contactId])->exists();

            if ($isPhoneDuplicate) {
                throw new Exception("Contact already exists.");
            }
        }

        $contact = Contact::query()
            ->where([
                'id' => $contactId,
                'user_id' => $userId,
            ])->firstOrFail();

        $contact->update(Arr::only($attributes, ['name', 'phone']));

        return $contact;
    }

    /**
     * @throws \App\Exceptions\UserContactNotFound
     */
    public function findOrFail(int $contactId, int $userId): Model|Builder
    {
        $contact = $this->userContactsRepository->find($contactId, $userId);

        if (! $contact) {
            throw new UserContactNotFound;
        }

        return $contact;
    }

    /**
     * @param int $contactId
     * @param int $userId
     * @return mixed
     */
    public function delete(int $contactId, int $userId)
    {
        return Contact::query()
            ->where([
                'id' => $contactId,
                'user_id' => $userId,
            ])->delete();
    }
}
