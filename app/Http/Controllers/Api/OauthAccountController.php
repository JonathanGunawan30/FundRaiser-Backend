<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\OauthAccountServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OauthAccountController extends Controller
{
    use ApiResponse;

    protected OauthAccountServiceInterface $oauthAccountService;

    public function __construct(OauthAccountServiceInterface $oauthAccountService)
    {
        $this->oauthAccountService = $oauthAccountService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('per_page', 10);
        $oauthAccounts = $this->oauthAccountService->getAllOauthAccounts($perPage);

        return $this->successWithPagination($oauthAccounts, 'OAuth accounts retrieved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $oauthAccount = $this->oauthAccountService->getOauthAccountById($id);
            return $this->success($oauthAccount, 'OAuth account retrieved successfully');
        } catch (ModelNotFoundException $e) {
            return $this->error($e->getMessage(), 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Search for resources.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $keyword = $request->query('keyword', '');
        $perPage = $request->query('per_page', 10);
        
        $oauthAccounts = $this->oauthAccountService->searchOauthAccounts($keyword, $perPage);

        return $this->successWithPagination($oauthAccounts, 'OAuth accounts search results retrieved successfully');
    }
}
