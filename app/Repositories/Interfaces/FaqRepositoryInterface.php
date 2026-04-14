<?php

namespace App\Repositories\Interfaces;

use App\Models\Faq;
use Illuminate\Pagination\LengthAwarePaginator;

interface FaqRepositoryInterface
{
    /**
     * Get all FAQs with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator;

    /**
     * Get FAQ by ID.
     *
     * @param int $id
     * @return Faq|null
     */
    public function findById(int $id): ?Faq;

    /**
     * Search FAQs by keyword.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator;
}
