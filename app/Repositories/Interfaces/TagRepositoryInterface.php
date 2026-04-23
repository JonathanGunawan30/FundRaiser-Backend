<?php

namespace App\Repositories\Interfaces;

use App\Models\Tag;
use Illuminate\Pagination\LengthAwarePaginator;

interface TagRepositoryInterface
{
    /**
     * Get all tags with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator;

    /**
     * Get tag by ID.
     *
     * @param int $id
     * @return Tag|null
     */
    public function findById(int $id): ?Tag;

    /**
     * Search tags by keyword.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator;
}
