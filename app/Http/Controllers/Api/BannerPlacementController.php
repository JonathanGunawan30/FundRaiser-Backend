<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\BannerPlacementServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BannerPlacementController extends Controller
{
    use ApiResponse;

    protected BannerPlacementServiceInterface $bannerPlacementService;

    public function __construct(BannerPlacementServiceInterface $bannerPlacementService)
    {
        $this->bannerPlacementService = $bannerPlacementService;
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
        $bannerPlacements = $this->bannerPlacementService->getAllBannerPlacements($perPage);

        return $this->successWithPagination($bannerPlacements, 'Banner placements retrieved successfully');
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
            $bannerPlacement = $this->bannerPlacementService->getBannerPlacementById($id);
            return $this->success($bannerPlacement, 'Banner placement retrieved successfully');
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
        
        $bannerPlacements = $this->bannerPlacementService->searchBannerPlacements($keyword, $perPage);

        return $this->successWithPagination($bannerPlacements, 'Banner placements search results retrieved successfully');
    }
}
