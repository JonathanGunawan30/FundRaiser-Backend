<?php

namespace App\Repositories\Implementations;

use App\Models\Banner;
use App\Repositories\Interfaces\BannerRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class BannerRepository implements BannerRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator
    {
        return Banner::paginate($perPage);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?Banner
    {
        return Banner::find($id);
    }

    /**
     * @inheritDoc
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator
    {
        return Banner::where('title', 'like', "%{$keyword}%")
            ->paginate($perPage);
    }
}
