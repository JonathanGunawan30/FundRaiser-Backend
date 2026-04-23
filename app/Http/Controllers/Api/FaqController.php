<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\FaqServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FaqController extends Controller
{
    use ApiResponse;

    protected FaqServiceInterface $faqService;

    public function __construct(FaqServiceInterface $faqService)
    {
        $this->faqService = $faqService;
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
        $faqs = $this->faqService->getAllFaqs($perPage);

        return $this->successWithPagination($faqs, 'FAQs retrieved successfully');
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
            $faq = $this->faqService->getFaqById($id);
            return $this->success($faq, 'FAQ retrieved successfully');
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
        
        $faqs = $this->faqService->searchFaqs($keyword, $perPage);

        return $this->successWithPagination($faqs, 'FAQs search results retrieved successfully');
    }
}
