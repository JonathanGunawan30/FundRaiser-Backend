<?php

namespace App\Services\Interfaces;

use App\Models\Faq;
use Illuminate\Pagination\LengthAwarePaginator;

interface FaqServiceInterface
{
    /**
     * Get all FAQs with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllFaqs(int $perPage): LengthAwarePaginator;

    /**
     * Get FAQ by ID.
     *
     * @param int $id
     * @return Faq
     */
    public function getFaqById(int $id): Faq;

    /**
     * Search FAQs.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function searchFaqs(string $keyword, int $perPage): LengthAwarePaginator;

    /**
     * Create a new FAQ.
     *
     * @param array $data
     * @return Faq
     */
    public function createFaq(array $data): Faq;

    /**
     * Update an existing FAQ.
     *
     * @param int $id
     * @param array $data
     * @return Faq
     */
    public function updateFaq(int $id, array $data): Faq;

    /**
     * Delete an FAQ.
     *
     * @param int $id
     * @return bool
     */
    public function deleteFaq(int $id): bool;
}
