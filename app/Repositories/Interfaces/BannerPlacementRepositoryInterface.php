<?php

namespace App\Repositories\Interfaces;

use App\Models\BannerPlacement;
use Illuminate\Pagination\LengthAwarePaginator;

interface BannerPlacementRepositoryInterface
{
    /**
     * Get all banner placements with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator;

    /**
     * Get banner placement by ID.
     *
     * @param int $id
     * @return BannerPlacement|null
     */
    public function findById(int $id): ?BannerPlacement;

    /**
     * Search banner placements by keyword.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator;
}
