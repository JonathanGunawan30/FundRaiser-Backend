<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\CampaignServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CampaignController extends Controller
{
    use ApiResponse;

    protected CampaignServiceInterface $campaignService;

    public function __construct(CampaignServiceInterface $campaignService)
    {
        $this->campaignService = $campaignService;
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
        $campaigns = $this->campaignService->getAllCampaigns($perPage);

        return $this->successWithPagination($campaigns, 'Campaigns retrieved successfully');
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
            $campaign = $this->campaignService->getCampaignById($id);
            return $this->success($campaign, 'Campaign retrieved successfully');
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
        
        $campaigns = $this->campaignService->searchCampaigns($keyword, $perPage);

        return $this->successWithPagination($campaigns, 'Campaigns search results retrieved successfully');
    }
}
