<?php

namespace App\Services;

use Exception;
use App\Repositories\UserRepository;
use Illuminate\Database\DatabaseManager;

final class UserService
{
    /**
     * @param \Illuminate\Database\DatabaseManager $db
     * @param \App\Repositories\UserRepository $userRepository
     * @param \App\Services\UserPasswordHashService $userPasswordHashService
     */
    public function __construct(
        private DatabaseManager $db,
        private UserRepository $userRepository,
        private UserPasswordHashService $userPasswordHashService,
    ) {}

    /**
     * @param array $attributes
     * @return mixed
     * @throws \Throwable
     */
    public function create(array $attributes): mixed
    {
        $this->db->beginTransaction();

        try {
            $user = $this->userRepository->create([
                'email' => $attributes['email'],
                'password' => $this->userPasswordHashService->makeHash($attributes['password'])
            ]);

            $this->db->commit();
        } catch (Exception) {
            $this->db->rollBack();

            throw new Exception('User already exists or creation failed.');
        }

        return $user;
    }
}
