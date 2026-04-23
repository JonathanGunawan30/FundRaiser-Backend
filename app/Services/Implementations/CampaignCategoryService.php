<?php

namespace App\Services\Implementations;

use App\Models\CampaignCategory;
use App\Repositories\Interfaces\CampaignCategoryRepositoryInterface;
use App\Services\Interfaces\CampaignCategoryServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CampaignCategoryService implements CampaignCategoryServiceInterface
{
    protected CampaignCategoryRepositoryInterface $categoryRepository;

    public function __construct(CampaignCategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @inheritDoc
     */
    public function getAllCategories(int $perPage): LengthAwarePaginator
    {
        return $this->categoryRepository->getAllPaginated($perPage);
    }

    /**
     * @inheritDoc
     */
    public function getCategoryById(int $id): CampaignCategory
    {
        $category = $this->categoryRepository->findById($id);

        if (!$category) {
            throw new ModelNotFoundException("Campaign category with ID {$id} not found.");
        }

        return $category;
    }

    /**
     * @inheritDoc
     */
    public function searchCategories(string $keyword, int $perPage): LengthAwarePaginator
    {
        return $this->categoryRepository->search($keyword, $perPage);
    }
}
