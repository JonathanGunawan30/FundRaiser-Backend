<?php

namespace App\Repositories\Interfaces;

use App\Models\Banner;
use Illuminate\Pagination\LengthAwarePaginator;

interface BannerRepositoryInterface
{
    /**
     * Get all banners with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator;

    /**
     * Get banner by ID.
     *
     * @param int $id
     * @return Banner|null
     */
    public function findById(int $id): ?Banner;

    /**
     * Search banners by keyword.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator;
}
