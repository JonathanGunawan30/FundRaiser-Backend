<?php

namespace App\Services\Interfaces;

use App\Models\Tag;
use Illuminate\Pagination\LengthAwarePaginator;

interface TagServiceInterface
{
    /**
     * Get all tags with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllTags(int $perPage): LengthAwarePaginator;

    /**
     * Get tag by ID.
     *
     * @param int $id
     * @return Tag
     */
    public function getTagById(int $id): Tag;

    /**
     * Search tags.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function searchTags(string $keyword, int $perPage): LengthAwarePaginator;
}
