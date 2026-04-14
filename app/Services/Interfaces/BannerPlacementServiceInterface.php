<?php

namespace App\Services\Interfaces;

use App\Models\BannerPlacement;
use Illuminate\Pagination\LengthAwarePaginator;

interface BannerPlacementServiceInterface
{
    /**
     * Get all banner placements with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllBannerPlacements(int $perPage): LengthAwarePaginator;

    /**
     * Get banner placement by ID.
     *
     * @param int $id
     * @return BannerPlacement
     */
    public function getBannerPlacementById(int $id): BannerPlacement;

    /**
     * Search banner placements.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function searchBannerPlacements(string $keyword, int $perPage): LengthAwarePaginator;
}
