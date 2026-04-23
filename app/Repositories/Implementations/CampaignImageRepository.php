<?php

namespace App\Repositories\Implementations;

use App\Models\CampaignImage;
use App\Repositories\Interfaces\CampaignImageRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CampaignImageRepository implements CampaignImageRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator
    {
        return CampaignImage::with('campaign')->paginate($perPage);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?CampaignImage
    {
        return CampaignImage::with('campaign')->find($id);
    }

    /**
     * @inheritDoc
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator
    {
        return CampaignImage::with('campaign')
            ->where('image_url', 'like', "%{$keyword}%")
            ->paginate($perPage);
    }
}
