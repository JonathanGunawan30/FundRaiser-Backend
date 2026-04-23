<?php

namespace App\Services\Interfaces;

use App\Models\CampaignImage;
use Illuminate\Pagination\LengthAwarePaginator;

interface CampaignImageServiceInterface
{
    /**
     * Get all campaign images paginated.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllImages(int $perPage): LengthAwarePaginator;

    /**
     * Get campaign image by ID.
     *
     * @param int $id
     * @return CampaignImage
     */
    public function getImageById(int $id): CampaignImage;

    /**
     * Search campaign images.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function searchImages(string $keyword, int $perPage): LengthAwarePaginator;
}
