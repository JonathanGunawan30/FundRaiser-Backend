<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\AuthServiceInterface;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{
    protected AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * @inheritDoc
     */
    public function adminLogin(array $credentials): array
    {
        $admin = $this->authRepository->findAdminByEmail($credentials['email']);

        if (!$admin || !Hash::check($credentials['password'], $admin->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        if (!$admin->is_active) {
            throw ValidationException::withMessages([
                'email' => ['Account is inactive.'],
            ]);
        }

        $this->authRepository->updateAdminLastLogin($admin);

        $token = Auth::guard('admin-api')->login($admin);

        return [
            'admin' => $admin,
            'token' => $token,
        ];
    }

    /**
     * @inheritDoc
     */
    public function userSocialLogin(string $provider, mixed $socialUser): array
    {
        $oauthData = [
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
            'name' => $socialUser->getName(),
            'email' => $socialUser->getEmail(),
            'avatar_url' => $socialUser->getAvatar(),
            'access_token' => $socialUser->token,
            'refresh_token' => $socialUser->refreshToken,
            'token_expires_at' => property_exists($socialUser, 'expiresIn') ? now()->addSeconds($socialUser->expiresIn) : null,
        ];

        $user = $this->authRepository->findOrCreateUserByOauth($oauthData);

        $token = Auth::guard('api')->login($user);

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    /**
     * @inheritDoc
     */
    public function logout(): void
    {
        Auth::logout();
    }
}
