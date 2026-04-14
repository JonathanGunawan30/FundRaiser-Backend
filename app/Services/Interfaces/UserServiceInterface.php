<?php

namespace App\Services\Interfaces;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserServiceInterface
{
    /**
     * Get all users with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllUsers(int $perPage): LengthAwarePaginator;

    /**
     * Get user by ID.
     *
     * @param int $id
     * @return User
     */
    public function getUserById(int $id): User;

    /**
     * Search users.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function searchUsers(string $keyword, int $perPage): LengthAwarePaginator;
}
