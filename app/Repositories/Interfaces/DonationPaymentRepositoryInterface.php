<?php

namespace App\Repositories\Interfaces;

use App\Models\DonationPayment;
use Illuminate\Pagination\LengthAwarePaginator;

interface DonationPaymentRepositoryInterface
{
    /**
     * Get all donation payments paginated.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator;

    /**
     * Find donation payment by ID.
     *
     * @param int $id
     * @return DonationPayment|null
     */
    public function findById(int $id): ?DonationPayment;

    /**
     * Search donation payments.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator;
}
