<?php

namespace App\Services\Implementations;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService implements UserServiceInterface
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritDoc
     */
    public function getAllUsers(int $perPage): LengthAwarePaginator
    {
        return $this->userRepository->getAllPaginated($perPage);
    }

    /**
     * @inheritDoc
     */
    public function getUserById(int $id): User
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            throw new ModelNotFoundException("User with ID {$id} not found.");
        }

        return $user;
    }

    /**
     * @inheritDoc
     */
    public function searchUsers(string $keyword, int $perPage): LengthAwarePaginator
    {
        return $this->userRepository->search($keyword, $perPage);
    }
}
