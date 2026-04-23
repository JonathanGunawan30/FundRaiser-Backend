<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreFaqRequest;
use App\Http\Requests\Api\UpdateFaqRequest;
use App\Http\Resources\FaqResource;
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

        return $this->successWithPagination(FaqResource::collection($faqs), 'FAQs retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFaqRequest $request
     * @return JsonResponse
     */
    public function store(StoreFaqRequest $request): JsonResponse
    {
        $data = $request->validated();
        $faq = $this->faqService->createFaq($data);

        return $this->success(new FaqResource($faq), 'FAQ created successfully', 201);
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
            return $this->success(new FaqResource($faq), 'FAQ retrieved successfully');
        } catch (ModelNotFoundException $e) {
            return $this->error($e->getMessage(), 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFaqRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateFaqRequest $request, int $id): JsonResponse
    {
        try {
            $data = $request->validated();
            $faq = $this->faqService->updateFaq($id, $data);

            return $this->success(new FaqResource($faq), 'FAQ updated successfully');
        } catch (ModelNotFoundException $e) {
            return $this->error("FAQ with ID {$id} not found.", 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->faqService->deleteFaq($id);
            return $this->success(null, 'FAQ deleted successfully');
        } catch (ModelNotFoundException $e) {
            return $this->error("FAQ with ID {$id} not found.", 404);
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

        return $this->successWithPagination(FaqResource::collection($faqs), 'FAQs search results retrieved successfully');
    }
}
