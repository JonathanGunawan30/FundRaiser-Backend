<?php

namespace App\Repositories\Interfaces;

use App\Models\Donation;
use Illuminate\Pagination\LengthAwarePaginator;

interface DonationRepositoryInterface
{
    /**
     * Get all donations paginated.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator;

    /**
     * Find donation by ID.
     *
     * @param int $id
     * @return Donation|null
     */
    public function findById(int $id): ?Donation;

    /**
     * Search donations.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator;
}
