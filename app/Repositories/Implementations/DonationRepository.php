<?php

namespace App\Repositories\Implementations;

use App\Models\Donation;
use App\Repositories\Interfaces\DonationRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class DonationRepository implements DonationRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator
    {
        return Donation::with(['campaign', 'user', 'payment'])->paginate($perPage);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?Donation
    {
        return Donation::with(['campaign', 'user', 'payment'])->find($id);
    }

    /**
     * @inheritDoc
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator
    {
        return Donation::with(['campaign', 'user', 'payment'])
            ->where('donation_number', 'like', "%{$keyword}%")
            ->paginate($perPage);
    }
}
