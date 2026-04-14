<?php

namespace App\Services\Interfaces;

use App\Models\Donation;
use Illuminate\Pagination\LengthAwarePaginator;

interface DonationServiceInterface
{
    /**
     * Get all donations paginated.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllDonations(int $perPage): LengthAwarePaginator;

    /**
     * Get donation by ID.
     *
     * @param int $id
     * @return Donation
     */
    public function getDonationById(int $id): Donation;

    /**
     * Search donations.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function searchDonations(string $keyword, int $perPage): LengthAwarePaginator;
}
