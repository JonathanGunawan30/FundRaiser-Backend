<?php

namespace App\Repositories\Interfaces;

use App\Models\OauthAccount;
use Illuminate\Pagination\LengthAwarePaginator;

interface OauthAccountRepositoryInterface
{
    /**
     * Get all OAuth accounts with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator;

    /**
     * Get OAuth account by ID.
     *
     * @param int $id
     * @return OauthAccount|null
     */
    public function findById(int $id): ?OauthAccount;

    /**
     * Search OAuth accounts by keyword.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator;
}
