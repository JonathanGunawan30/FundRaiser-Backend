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

    /**
     * Create a new FAQ.
     *
     * @param array $data
     * @return Faq
     */
    public function create(array $data): Faq;

    /**
     * Update an existing FAQ.
     *
     * @param int $id
     * @param array $data
     * @return Faq
     */
    public function update(int $id, array $data): Faq;

    /**
     * Delete an FAQ.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
