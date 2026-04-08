<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Services\Interfaces\AuthServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;

    protected AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Admin login.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function adminLogin(LoginRequest $request): JsonResponse
    {
        try {
            $result = $this->authService->adminLogin($request->validated());

            return $this->success($result, 'Login successful');
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 422);
        }
    }

    /**
     * Logout.
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $this->authService->logout();

        return $this->success(null, 'Logout successful');
    }
}
