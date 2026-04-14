<?php

namespace App\Repositories\Interfaces;

use App\Models\CampaignImage;
use Illuminate\Pagination\LengthAwarePaginator;

interface CampaignImageRepositoryInterface
{
    /**
     * Get all campaign images paginated.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator;

    /**
     * Find campaign image by ID.
     *
     * @param int $id
     * @return CampaignImage|null
     */
    public function findById(int $id): ?CampaignImage;

    /**
     * Search campaign images.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator;
}
