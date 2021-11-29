<?php

namespace App\Services;

use Illuminate\Contracts\Hashing\Hasher;

final class UserPasswordHashService
{
    /**
     * @param \Illuminate\Contracts\Hashing\Hasher $hasher
     */
    public function __construct(
        protected Hasher $hasher
    ) {}

    /**
     * @param $rawPassword
     * @return string
     */
    public function makeHash($rawPassword): string
    {
        return $this->hasher->make($rawPassword);
    }

    /**
     * @param string $passwordToCheck
     * @param string $originalPassword
     * @return bool
     */
    public function check(string $passwordToCheck, string $originalPassword): bool
    {
        return $this->hasher->check($passwordToCheck, $originalPassword);
    }
}
