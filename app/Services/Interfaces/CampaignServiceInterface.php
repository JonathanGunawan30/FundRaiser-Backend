<?php

namespace App\Services\Interfaces;

use App\Models\Campaign;
use Illuminate\Pagination\LengthAwarePaginator;

interface CampaignServiceInterface
{
    /**
     * Get all campaigns paginated.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllCampaigns(int $perPage): LengthAwarePaginator;

    /**
     * Get campaign by ID.
     *
     * @param int $id
     * @return Campaign
     */
    public function getCampaignById(int $id): Campaign;

    /**
     * Search campaigns.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function searchCampaigns(string $keyword, int $perPage): LengthAwarePaginator;
}
