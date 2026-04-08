<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\AuthServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserAuthController extends Controller
{
    use ApiResponse;

    protected AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Redirect the user to the provider authentication page.
     *
     * @param string $provider
     * @return RedirectResponse
     */
    public function redirectToProvider(string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    /**
     * Obtain the user information from the provider.
     *
     * @param string $provider
     * @return JsonResponse
     */
    public function handleProviderCallback(string $provider): JsonResponse
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();
            
            $result = $this->authService->userSocialLogin($provider, $socialUser);

            return $this->success($result, 'Login successful');
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 422);
        }
    }
}
