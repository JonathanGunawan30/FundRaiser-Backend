<?php

namespace App\Repositories\Implementations;

use App\Models\DonationPayment;
use App\Repositories\Interfaces\DonationPaymentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class DonationPaymentRepository implements DonationPaymentRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator
    {
        return DonationPayment::with(['donation'])->paginate($perPage);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?DonationPayment
    {
        return DonationPayment::with(['donation'])->find($id);
    }

    /**
     * @inheritDoc
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator
    {
        return DonationPayment::with(['donation'])
            ->where('external_ref', 'like', "%{$keyword}%")
            ->orWhere('payment_method', 'like', "%{$keyword}%")
            ->orWhere('payment_channel', 'like', "%{$keyword}%")
            ->paginate($perPage);
    }
}
