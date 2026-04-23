<?php

namespace App\Services\Implementations;

use App\Models\Campaign;
use App\Repositories\Interfaces\CampaignRepositoryInterface;
use App\Services\Interfaces\CampaignServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CampaignService implements CampaignServiceInterface
{
    protected CampaignRepositoryInterface $campaignRepository;

    public function __construct(CampaignRepositoryInterface $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
    }

    /**
     * @inheritDoc
     */
    public function getAllCampaigns(int $perPage): LengthAwarePaginator
    {
        return $this->campaignRepository->getAllPaginated($perPage);
    }

    /**
     * @inheritDoc
     */
    public function getCampaignById(int $id): Campaign
    {
        $campaign = $this->campaignRepository->findById($id);

        if (!$campaign) {
            throw new ModelNotFoundException("Campaign with ID {$id} not found.");
        }

        return $campaign;
    }

    /**
     * @inheritDoc
     */
    public function searchCampaigns(string $keyword, int $perPage): LengthAwarePaginator
    {
        return $this->campaignRepository->search($keyword, $perPage);
    }
}
