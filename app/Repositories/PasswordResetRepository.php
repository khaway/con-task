<?php

namespace App\Repositories;

use App\Models\PasswordReset;

class PasswordResetRepository
{
    /**
     * @param string $email
     * @return \App\Models\PasswordReset|null
     */
    public function findByEmail(string $email): ?PasswordReset
    {
        return PasswordReset::where('email', $email)->first();
    }
}
