<?php

namespace App\Repositories\Interfaces;

use App\Models\SiteSetting;
use Illuminate\Pagination\LengthAwarePaginator;

interface SiteSettingRepositoryInterface
{
    /**
     * Get all site settings with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator;

    /**
     * Get site setting by ID.
     *
     * @param int $id
     * @return SiteSetting|null
     */
    public function findById(int $id): ?SiteSetting;

    /**
     * Search site settings by keyword.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator;
}
