<?php

namespace App\Services\Interfaces;

use App\Models\Banner;
use Illuminate\Pagination\LengthAwarePaginator;

interface BannerServiceInterface
{
    /**
     * Get all banners with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllBanners(int $perPage): LengthAwarePaginator;

    /**
     * Get banner by ID.
     *
     * @param int $id
     * @return Banner
     */
    public function getBannerById(int $id): Banner;

    /**
     * Search banners.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function searchBanners(string $keyword, int $perPage): LengthAwarePaginator;
}
