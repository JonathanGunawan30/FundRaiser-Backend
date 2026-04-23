<?php

namespace App\Services\Implementations;

use App\Models\Banner;
use App\Repositories\Interfaces\BannerRepositoryInterface;
use App\Services\Interfaces\BannerServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BannerService implements BannerServiceInterface
{
    protected BannerRepositoryInterface $bannerRepository;

    public function __construct(BannerRepositoryInterface $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    /**
     * @inheritDoc
     */
    public function getAllBanners(int $perPage): LengthAwarePaginator
    {
        return $this->bannerRepository->getAllPaginated($perPage);
    }

    /**
     * @inheritDoc
     */
    public function getBannerById(int $id): Banner
    {
        $banner = $this->bannerRepository->findById($id);

        if (!$banner) {
            throw new ModelNotFoundException("Banner with ID {$id} not found.");
        }

        return $banner;
    }

    /**
     * @inheritDoc
     */
    public function searchBanners(string $keyword, int $perPage): LengthAwarePaginator
    {
        return $this->bannerRepository->search($keyword, $perPage);
    }
}
