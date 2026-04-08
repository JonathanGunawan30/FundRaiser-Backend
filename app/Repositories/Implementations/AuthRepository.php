<?php

namespace App\Repositories\Implementations;

use App\Models\User;
use App\Models\Admin;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AuthRepository implements AuthRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findAdminByEmail(string $email): ?Admin
    {
        return Admin::where('email', $email)->first();
    }

    /**
     * @inheritDoc
     */
    public function findOrCreateUserByOauth(array $oauthData): User
    {
        return DB::transaction(function () use ($oauthData) {
            $user = User::where('email', $oauthData['email'])->first();

            if (!$user) {
                $user = User::create([
                    'name' => $oauthData['name'],
                    'email' => $oauthData['email'],
                    'avatar_url' => $oauthData['avatar_url'] ?? null,
                    'status' => 'active',
                ]);
            }

            $user->oauthAccounts()->updateOrCreate(
                [
                    'provider' => $oauthData['provider'],
                    'provider_id' => $oauthData['provider_id'],
                ],
                [
                    'access_token' => $oauthData['access_token'] ?? null,
                    'refresh_token' => $oauthData['refresh_token'] ?? null,
                    'token_expires_at' => $oauthData['token_expires_at'] ?? null,
                ]
            );

            return $user;
        });
    }

    /**
     * @inheritDoc
     */
    public function updateAdminLastLogin(Admin $admin): void
    {
        $admin->update([
            'last_login_at' => now(),
        ]);
    }
}
