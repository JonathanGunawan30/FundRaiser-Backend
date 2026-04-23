<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\DonationServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DonationController extends Controller
{
    use ApiResponse;

    protected DonationServiceInterface $donationService;

    public function __construct(DonationServiceInterface $donationService)
    {
        $this->donationService = $donationService;
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
        $donations = $this->donationService->getAllDonations($perPage);

        return $this->successWithPagination($donations, 'Donations retrieved successfully');
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
            $donation = $this->donationService->getDonationById($id);
            return $this->success($donation, 'Donation retrieved successfully');
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
        
        $donations = $this->donationService->searchDonations($keyword, $perPage);

        return $this->successWithPagination($donations, 'Donations search results retrieved successfully');
    }
}
