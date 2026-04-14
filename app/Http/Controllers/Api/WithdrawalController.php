<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\WithdrawalServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WithdrawalController extends Controller
{
    use ApiResponse;

    protected WithdrawalServiceInterface $withdrawalService;

    public function __construct(WithdrawalServiceInterface $withdrawalService)
    {
        $this->withdrawalService = $withdrawalService;
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
        $withdrawals = $this->withdrawalService->getAllWithdrawals($perPage);

        return $this->successWithPagination($withdrawals, 'Withdrawals retrieved successfully');
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
            $withdrawal = $this->withdrawalService->getWithdrawalById($id);
            return $this->success($withdrawal, 'Withdrawal retrieved successfully');
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
        
        $withdrawals = $this->withdrawalService->searchWithdrawals($keyword, $perPage);

        return $this->successWithPagination($withdrawals, 'Withdrawals search results retrieved successfully');
    }
}
