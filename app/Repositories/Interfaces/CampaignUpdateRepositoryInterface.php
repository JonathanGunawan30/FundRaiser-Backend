<?php

namespace App\Repositories\Interfaces;

use App\Models\CampaignUpdate;
use Illuminate\Pagination\LengthAwarePaginator;

interface CampaignUpdateRepositoryInterface
{
    /**
     * Get all campaign updates paginated.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator;

    /**
     * Find campaign update by ID.
     *
     * @param int $id
     * @return CampaignUpdate|null
     */
    public function findById(int $id): ?CampaignUpdate;

    /**
     * Search campaign updates.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator;
}
