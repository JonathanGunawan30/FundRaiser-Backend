<?php

namespace App\Services\Implementations;

use App\Models\CampaignUpdate;
use App\Repositories\Interfaces\CampaignUpdateRepositoryInterface;
use App\Services\Interfaces\CampaignUpdateServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CampaignUpdateService implements CampaignUpdateServiceInterface
{
    protected CampaignUpdateRepositoryInterface $updateRepository;

    public function __construct(CampaignUpdateRepositoryInterface $updateRepository)
    {
        $this->updateRepository = $updateRepository;
    }

    /**
     * @inheritDoc
     */
    public function getAllUpdates(int $perPage): LengthAwarePaginator
    {
        return $this->updateRepository->getAllPaginated($perPage);
    }

    /**
     * @inheritDoc
     */
    public function getUpdateById(int $id): CampaignUpdate
    {
        $update = $this->updateRepository->findById($id);

        if (!$update) {
            throw new ModelNotFoundException("Campaign update with ID {$id} not found.");
        }

        return $update;
    }

    /**
     * @inheritDoc
     */
    public function searchUpdates(string $keyword, int $perPage): LengthAwarePaginator
    {
        return $this->updateRepository->search($keyword, $perPage);
    }
}
