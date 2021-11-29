<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Arr;

class UserRepository
{
    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return User::create(
            Arr::only($attributes, ['password', 'email'])
        );
    }

    /**
     * @param string $email
     * @return \App\Models\User|null
     */
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}
