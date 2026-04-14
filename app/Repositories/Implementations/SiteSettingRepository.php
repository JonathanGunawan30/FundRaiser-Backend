<?php

namespace App\Repositories\Implementations;

use App\Models\SiteSetting;
use App\Repositories\Interfaces\SiteSettingRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class SiteSettingRepository implements SiteSettingRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator
    {
        return SiteSetting::paginate($perPage);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?SiteSetting
    {
        return SiteSetting::find($id);
    }

    /**
     * @inheritDoc
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator
    {
        return SiteSetting::where('key', 'like', "%{$keyword}%")
            ->paginate($perPage);
    }
}
