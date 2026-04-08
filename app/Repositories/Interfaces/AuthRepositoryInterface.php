<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use App\Models\Admin;

interface AuthRepositoryInterface
{
    /**
     * Find an admin by email.
     *
     * @param string $email
     * @return Admin|null
     */
    public function findAdminByEmail(string $email): ?Admin;

    /**
     * Find or create a user by OAuth data.
     *
     * @param array $oauthData
     * @return User
     */
    public function findOrCreateUserByOauth(array $oauthData): User;

    /**
     * Update admin last login timestamp.
     *
     * @param Admin $admin
     * @return void
     */
    public function updateAdminLastLogin(Admin $admin): void;
}
