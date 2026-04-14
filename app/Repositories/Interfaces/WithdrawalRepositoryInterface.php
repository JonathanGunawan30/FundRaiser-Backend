<?php

namespace App\Repositories\Interfaces;

use App\Models\Withdrawal;
use Illuminate\Pagination\LengthAwarePaginator;

interface WithdrawalRepositoryInterface
{
    /**
     * Get all withdrawals paginated.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator;

    /**
     * Find withdrawal by ID.
     *
     * @param int $id
     * @return Withdrawal|null
     */
    public function findById(int $id): ?Withdrawal;

    /**
     * Search withdrawals.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator;
}
