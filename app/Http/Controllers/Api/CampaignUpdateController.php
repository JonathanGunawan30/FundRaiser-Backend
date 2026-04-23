<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\CampaignUpdateServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CampaignUpdateController extends Controller
{
    use ApiResponse;

    protected CampaignUpdateServiceInterface $updateService;

    public function __construct(CampaignUpdateServiceInterface $updateService)
    {
        $this->updateService = $updateService;
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
        $updates = $this->updateService->getAllUpdates($perPage);

        return $this->successWithPagination($updates, 'Campaign updates retrieved successfully');
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
            $update = $this->updateService->getUpdateById($id);
            return $this->success($update, 'Campaign update retrieved successfully');
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
        
        $updates = $this->updateService->searchUpdates($keyword, $perPage);

        return $this->successWithPagination($updates, 'Campaign updates search results retrieved successfully');
    }
}
