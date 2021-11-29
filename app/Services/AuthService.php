<?php

namespace App\Services;

use App\Models\User;
use App\Exceptions\SignupFailed;
use Laravel\Sanctum\NewAccessToken;
use App\Repositories\UserRepository;
use Illuminate\Database\DatabaseManager;
use App\Exceptions\CreateUserTokenFailed;
use Illuminate\Validation\ValidationException;

final class AuthService
{
    /**
     * @param \Illuminate\Database\DatabaseManager $db
     * @param \App\Services\UserService $userService
     * @param \App\Repositories\UserRepository $userRepository
     * @param \App\Services\UserPasswordHashService $userPasswordHashService
     */
    public function __construct(
        private DatabaseManager $db,
        private UserService $userService,
        private UserRepository $userRepository,
        private UserPasswordHashService $userPasswordHashService,
    ) {}

    /**
     * @param array $userAttributes
     * @return mixed
     * @throws \App\Exceptions\SignupFailed
     * @throws \Throwable
     */
    public function signup(array $userAttributes)
    {
        $this->db->beginTransaction();

        try {
            $user = $this->userService->create($userAttributes);

            // @todo UserTokenService or TokenService
            $personalAccessToken = $user->createToken('Default');

            $this->db->commit();
        } catch (SignupFailed $exception) {
            $this->db->rollBack();

            throw $exception;
        }

        return $personalAccessToken;
    }

    /**
     * @param \App\Models\User $user
     * @return bool|int
     */
    public function signout(User $user): bool|int
    {
        return $user->currentAccessToken()->delete();
    }

    /**
     * @param string $identifier
     * @param string $password
     * @return \Laravel\Sanctum\NewAccessToken
     * @throws \Illuminate\Validation\ValidationException
     * @throws \App\Exceptions\CreateUserTokenFailed|\Throwable
     */
    public function signin(string $identifier, string $password): NewAccessToken
    {
        $user = $this->userRepository->findByEmail($identifier);

        if (! $user || ! $this->userPasswordHashService->check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $this->db->beginTransaction();

        try {
            // @todo refactor to UserTokenService.
            $personalAccessToken = $user->createToken('Default');

            $this->db->commit();
        } catch (CreateUserTokenFailed $exception) {
            $this->db->rollBack();

            throw $exception;
        }

        return $personalAccessToken;
    }
}
