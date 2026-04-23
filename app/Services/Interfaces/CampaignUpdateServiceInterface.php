<?php

namespace App\Services\Interfaces;

use App\Models\CampaignUpdate;
use Illuminate\Pagination\LengthAwarePaginator;

interface CampaignUpdateServiceInterface
{
    /**
     * Get all campaign updates paginated.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllUpdates(int $perPage): LengthAwarePaginator;

    /**
     * Get campaign update by ID.
     *
     * @param int $id
     * @return CampaignUpdate
     */
    public function getUpdateById(int $id): CampaignUpdate;

    /**
     * Search campaign updates.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function searchUpdates(string $keyword, int $perPage): LengthAwarePaginator;
}
