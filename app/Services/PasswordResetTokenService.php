<?php

namespace App\Services;

use App\Models\PasswordReset;
use Illuminate\Support\Carbon;
use App\Exceptions\PasswordResetTokenExpired;
use App\Exceptions\InvalidPasswordResetToken;

final class PasswordResetTokenService
{
    /**
     * @param PasswordReset $passwordReset
     * @param $tokenToValidate
     * @throws \App\Exceptions\PasswordResetTokenExpired
     * @throws \App\Exceptions\InvalidPasswordResetToken
     */
    public function validate(PasswordReset $passwordReset, $tokenToValidate): void
    {
        if (! $this->isValid($tokenToValidate, $passwordReset)) {
            throw new InvalidPasswordResetToken;
        }

        if ($this->isExpired($passwordReset)) {
            throw new PasswordResetTokenExpired;
        }
    }

    /**
     * @param $tokenToValidate
     * @param PasswordReset $passwordReset
     * @return bool
     */
    public function isValid($tokenToValidate, PasswordReset $passwordReset): bool
    {
        return $tokenToValidate === $passwordReset->token;
    }

    /**
     * @param PasswordReset $passwordReset
     * @return bool
     */
    public function isExpired(PasswordReset $passwordReset): bool
    {
        $createdAt = Carbon::parse($passwordReset->created_at);

        return Carbon::now()->diffInMinutes($createdAt) >= 360;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function generate(): string
    {
        // @todo generate by $length
        return str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT);
    }
}
