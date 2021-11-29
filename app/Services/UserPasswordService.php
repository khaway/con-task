<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Carbon;
use App\Repositories\UserRepository;
use Illuminate\Database\DatabaseManager;
use App\Repositories\PasswordResetRepository;
use App\Exceptions\PasswordResetDeleteFailed;
use App\Jobs\SendPasswordResetConfirmationEmail;

final class UserPasswordService
{
    /**
     * @param \Illuminate\Database\DatabaseManager $db
     * @param \App\Repositories\UserRepository $userRepository
     * @param \App\Repositories\PasswordResetRepository $passwordResetRepository
     * @param \App\Services\PasswordResetTokenService $passwordResetTokenService
     * @param \App\Services\UserPasswordHashService $userPasswordHashService
     */
    public function __construct(
        private DatabaseManager $db,
        private UserRepository $userRepository,
        private PasswordResetRepository $passwordResetRepository,
        private PasswordResetTokenService $passwordResetTokenService,
        private UserPasswordHashService $userPasswordHashService,
    ) {}

    /**
     * @param string $email
     * @return string
     * @throws \Throwable
     */
    public function resetByEmail(string $email): string
    {
        $passwordResetToken = $this->passwordResetTokenService->generate();

        $user = $this->userRepository->findByEmail($email);

        if (! $user) {
            // @todo replace with custom exception
            // using response()->json().
            throw new Exception("User not found.");
        }

        $this->db->beginTransaction();

        try {
            PasswordReset::updateOrInsert(
                ['email' => $user->email],
                [
                    'token' => $passwordResetToken,
                    'created_at' => Carbon::now()
                ]
            );

            SendPasswordResetConfirmationEmail::dispatch($user, $passwordResetToken);
            $this->db->commit();
        } catch (Exception) {
            $this->db->rollBack();
            // @todo replace with custom exception
            // using response()->json().
            throw new Exception("Password reset failure.");
        }

        return $passwordResetToken;
    }

    /**
     * @param string $email
     * @param string $newPassword
     * @param string $resetToken
     * @return \App\Models\User
     * @throws \App\Exceptions\InvalidPasswordResetToken
     * @throws \App\Exceptions\PasswordResetDeleteFailed
     * @throws \App\Exceptions\PasswordResetTokenExpired
     * @throws \Throwable
     */
    public function update(string $email, string $newPassword, string $resetToken): User
    {
        $user = $this->userRepository->findByEmail($email);
        $passwordReset = $this->passwordResetRepository->findByEmail($email);

        if (! $user || ! $passwordReset) {
            // @todo replace with custom exception
            // using response()->json().
            throw new Exception("User or password reset not found.");
        }

        $this->passwordResetTokenService->validate($passwordReset, $resetToken);

        $this->db->beginTransaction();

        try {
            $user->password = $this->userPasswordHashService->makeHash($newPassword);
            $user->save();

            if (! $passwordReset->delete()) {
                throw new PasswordResetDeleteFailed;
            }

            $this->db->commit();
        } catch (PasswordResetDeleteFailed $exception) {
            $this->db->rollBack();

            throw $exception;
        }

        return $user;
    }
}
