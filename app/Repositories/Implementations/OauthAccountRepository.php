<?php

namespace App\Repositories\Implementations;

use App\Models\OauthAccount;
use App\Repositories\Interfaces\OauthAccountRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class OauthAccountRepository implements OauthAccountRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator
    {
        return OauthAccount::paginate($perPage);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?OauthAccount
    {
        return OauthAccount::find($id);
    }

    /**
     * @inheritDoc
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator
    {
        return OauthAccount::where('provider', 'like', "%{$keyword}%")
            ->orWhere('provider_id', 'like', "%{$keyword}%")
            ->paginate($perPage);
    }
}
