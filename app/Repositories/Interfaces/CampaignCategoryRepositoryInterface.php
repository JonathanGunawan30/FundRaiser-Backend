<?php

namespace App\Repositories\Interfaces;

use App\Models\CampaignCategory;
use Illuminate\Pagination\LengthAwarePaginator;

interface CampaignCategoryRepositoryInterface
{
    /**
     * Get all categories with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator;

    /**
     * Get category by ID.
     *
     * @param int $id
     * @return CampaignCategory|null
     */
    public function findById(int $id): ?CampaignCategory;

    /**
     * Search categories by keyword.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator;
}
