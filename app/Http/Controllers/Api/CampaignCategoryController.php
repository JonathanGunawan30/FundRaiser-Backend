<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\CampaignCategoryServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CampaignCategoryController extends Controller
{
    use ApiResponse;

    protected CampaignCategoryServiceInterface $categoryService;

    public function __construct(CampaignCategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
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
        $categories = $this->categoryService->getAllCategories($perPage);

        return $this->successWithPagination($categories, 'Campaign categories retrieved successfully');
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
            $category = $this->categoryService->getCategoryById($id);
            return $this->success($category, 'Campaign category retrieved successfully');
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
        
        $categories = $this->categoryService->searchCategories($keyword, $perPage);

        return $this->successWithPagination($categories, 'Campaign categories search results retrieved successfully');
    }
}
