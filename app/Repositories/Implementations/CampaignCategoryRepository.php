<?php

namespace App\Repositories\Implementations;

use App\Models\CampaignCategory;
use App\Repositories\Interfaces\CampaignCategoryRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CampaignCategoryRepository implements CampaignCategoryRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator
    {
        return CampaignCategory::paginate($perPage);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?CampaignCategory
    {
        return CampaignCategory::find($id);
    }

    /**
     * @inheritDoc
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator
    {
        return CampaignCategory::where('name', 'like', "%{$keyword}%")
            ->orWhere('slug', 'like', "%{$keyword}%")
            ->paginate($perPage);
    }
}
