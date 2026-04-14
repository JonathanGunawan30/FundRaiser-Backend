<?php

namespace App\Repositories\Interfaces;

use App\Models\Campaign;
use Illuminate\Pagination\LengthAwarePaginator;

interface CampaignRepositoryInterface
{
    /**
     * Get all campaigns paginated.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator;

    /**
     * Find campaign by ID.
     *
     * @param int $id
     * @return Campaign|null
     */
    public function findById(int $id): ?Campaign;

    /**
     * Search campaigns.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator;
}
