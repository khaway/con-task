<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class UserContactsRepository
{
    /**
     * @param int $contactId
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $contactId, int $userId): null|Builder|Model
    {
        return Contact::query()
            ->where([
                'id' => $contactId,
                'user_id' => $userId,
            ])->first();
    }
}
