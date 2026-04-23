<?php

namespace App\Services\Interfaces;

use App\Models\DonationPayment;
use Illuminate\Pagination\LengthAwarePaginator;

interface DonationPaymentServiceInterface
{
    /**
     * Get all donation payments paginated.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllDonationPayments(int $perPage): LengthAwarePaginator;

    /**
     * Get donation payment by ID.
     *
     * @param int $id
     * @return DonationPayment
     */
    public function getDonationPaymentById(int $id): DonationPayment;

    /**
     * Search donation payments.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function searchDonationPayments(string $keyword, int $perPage): LengthAwarePaginator;
}
