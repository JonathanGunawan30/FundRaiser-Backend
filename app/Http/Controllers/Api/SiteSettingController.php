<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\SiteSettingServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SiteSettingController extends Controller
{
    use ApiResponse;

    protected SiteSettingServiceInterface $siteSettingService;

    public function __construct(SiteSettingServiceInterface $siteSettingService)
    {
        $this->siteSettingService = $siteSettingService;
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
        $siteSettings = $this->siteSettingService->getAllSiteSettings($perPage);

        return $this->successWithPagination($siteSettings, 'Site settings retrieved successfully');
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
            $siteSetting = $this->siteSettingService->getSiteSettingById($id);
            return $this->success($siteSetting, 'Site setting retrieved successfully');
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
        
        $siteSettings = $this->siteSettingService->searchSiteSettings($keyword, $perPage);

        return $this->successWithPagination($siteSettings, 'Site settings search results retrieved successfully');
    }
}
