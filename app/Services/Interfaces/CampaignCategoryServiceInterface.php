<?php

namespace App\Services\Interfaces;

use App\Models\CampaignCategory;
use Illuminate\Pagination\LengthAwarePaginator;

interface CampaignCategoryServiceInterface
{
    /**
     * Get all categories with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllCategories(int $perPage): LengthAwarePaginator;

    /**
     * Get category by ID.
     *
     * @param int $id
     * @return CampaignCategory
     */
    public function getCategoryById(int $id): CampaignCategory;

    /**
     * Search categories.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function searchCategories(string $keyword, int $perPage): LengthAwarePaginator;
}
