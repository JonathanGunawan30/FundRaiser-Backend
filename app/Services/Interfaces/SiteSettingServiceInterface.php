<?php

namespace App\Services\Interfaces;

use App\Models\SiteSetting;
use Illuminate\Pagination\LengthAwarePaginator;

interface SiteSettingServiceInterface
{
    /**
     * Get all site settings with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllSiteSettings(int $perPage): LengthAwarePaginator;

    /**
     * Get site setting by ID.
     *
     * @param int $id
     * @return SiteSetting
     */
    public function getSiteSettingById(int $id): SiteSetting;

    /**
     * Search site settings.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function searchSiteSettings(string $keyword, int $perPage): LengthAwarePaginator;
}
