<?php

namespace App\Repositories\Implementations;

use App\Models\Campaign;
use App\Repositories\Interfaces\CampaignRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CampaignRepository implements CampaignRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator
    {
        return Campaign::with(['user', 'category'])->paginate($perPage);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?Campaign
    {
        return Campaign::with(['user', 'category', 'tags', 'images', 'updates', 'verifier'])->find($id);
    }

    /**
     * @inheritDoc
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator
    {
        return Campaign::with(['user', 'category'])
            ->where('title', 'like', "%{$keyword}%")
            ->orWhere('slug', 'like', "%{$keyword}%")
            ->paginate($perPage);
    }
}
