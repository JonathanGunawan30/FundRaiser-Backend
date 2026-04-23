<?php

namespace App\Services\Implementations;

use App\Models\Donation;
use App\Repositories\Interfaces\DonationRepositoryInterface;
use App\Services\Interfaces\DonationServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DonationService implements DonationServiceInterface
{
    protected DonationRepositoryInterface $donationRepository;

    public function __construct(DonationRepositoryInterface $donationRepository)
    {
        $this->donationRepository = $donationRepository;
    }

    /**
     * @inheritDoc
     */
    public function getAllDonations(int $perPage): LengthAwarePaginator
    {
        return $this->donationRepository->getAllPaginated($perPage);
    }

    /**
     * @inheritDoc
     */
    public function getDonationById(int $id): Donation
    {
        $donation = $this->donationRepository->findById($id);

        if (!$donation) {
            throw new ModelNotFoundException("Donation with ID {$id} not found.");
        }

        return $donation;
    }

    /**
     * @inheritDoc
     */
    public function searchDonations(string $keyword, int $perPage): LengthAwarePaginator
    {
        return $this->donationRepository->search($keyword, $perPage);
    }
}
