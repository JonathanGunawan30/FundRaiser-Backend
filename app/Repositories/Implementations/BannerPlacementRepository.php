<?php

namespace App\Repositories\Implementations;

use App\Models\BannerPlacement;
use App\Repositories\Interfaces\BannerPlacementRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class BannerPlacementRepository implements BannerPlacementRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator
    {
        return BannerPlacement::paginate($perPage);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?BannerPlacement
    {
        return BannerPlacement::find($id);
    }

    /**
     * @inheritDoc
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator
    {
        return BannerPlacement::where('placement', 'like', "%{$keyword}%")
            ->paginate($perPage);
    }
}
