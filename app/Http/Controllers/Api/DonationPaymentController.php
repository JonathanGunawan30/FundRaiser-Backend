<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\DonationPaymentServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DonationPaymentController extends Controller
{
    use ApiResponse;

    protected DonationPaymentServiceInterface $donationPaymentService;

    public function __construct(DonationPaymentServiceInterface $donationPaymentService)
    {
        $this->donationPaymentService = $donationPaymentService;
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
        $donationPayments = $this->donationPaymentService->getAllDonationPayments($perPage);

        return $this->successWithPagination($donationPayments, 'Donation payments retrieved successfully');
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
            $donationPayment = $this->donationPaymentService->getDonationPaymentById($id);
            return $this->success($donationPayment, 'Donation payment retrieved successfully');
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
        
        $donationPayments = $this->donationPaymentService->searchDonationPayments($keyword, $perPage);

        return $this->successWithPagination($donationPayments, 'Donation payments search results retrieved successfully');
    }
}
