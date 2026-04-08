<?php

namespace App\Services\Interfaces;

interface AuthServiceInterface
{
    /**
     * Authenticate an admin.
     *
     * @param array $credentials
     * @return array
     */
    public function adminLogin(array $credentials): array;

    /**
     * Authenticate a user via OAuth.
     *
     * @param string $provider
     * @param mixed $socialUser
     * @return array
     */
    public function userSocialLogin(string $provider, mixed $socialUser): array;

    /**
     * Logout from the current session.
     *
     * @return void
     */
    public function logout(): void;
}
