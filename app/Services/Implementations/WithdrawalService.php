<?php

namespace App\Services\Implementations;

use App\Models\Withdrawal;
use App\Repositories\Interfaces\WithdrawalRepositoryInterface;
use App\Services\Interfaces\WithdrawalServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WithdrawalService implements WithdrawalServiceInterface
{
    protected WithdrawalRepositoryInterface $withdrawalRepository;

    public function __construct(WithdrawalRepositoryInterface $withdrawalRepository)
    {
        $this->withdrawalRepository = $withdrawalRepository;
    }

    /**
     * @inheritDoc
     */
    public function getAllWithdrawals(int $perPage): LengthAwarePaginator
    {
        return $this->withdrawalRepository->getAllPaginated($perPage);
    }

    /**
     * @inheritDoc
     */
    public function getWithdrawalById(int $id): Withdrawal
    {
        $withdrawal = $this->withdrawalRepository->findById($id);

        if (!$withdrawal) {
            throw new ModelNotFoundException("Withdrawal with ID {$id} not found.");
        }

        return $withdrawal;
    }

    /**
     * @inheritDoc
     */
    public function searchWithdrawals(string $keyword, int $perPage): LengthAwarePaginator
    {
        return $this->withdrawalRepository->search($keyword, $perPage);
    }
}
