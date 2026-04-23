<?php

namespace App\Services\Interfaces;

use App\Models\OauthAccount;
use Illuminate\Pagination\LengthAwarePaginator;

interface OauthAccountServiceInterface
{
    /**
     * Get all OAuth accounts with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllOauthAccounts(int $perPage): LengthAwarePaginator;

    /**
     * Get OAuth account by ID.
     *
     * @param int $id
     * @return OauthAccount
     */
    public function getOauthAccountById(int $id): OauthAccount;

    /**
     * Search OAuth accounts.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function searchOauthAccounts(string $keyword, int $perPage): LengthAwarePaginator;
}
