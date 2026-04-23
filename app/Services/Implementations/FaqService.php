<?php

namespace App\Services\Implementations;

use App\Models\Faq;
use App\Repositories\Interfaces\FaqRepositoryInterface;
use App\Services\Interfaces\FaqServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FaqService implements FaqServiceInterface
{
    protected FaqRepositoryInterface $faqRepository;

    public function __construct(FaqRepositoryInterface $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    /**
     * @inheritDoc
     */
    public function getAllFaqs(int $perPage): LengthAwarePaginator
    {
        return $this->faqRepository->getAllPaginated($perPage);
    }

    /**
     * @inheritDoc
     */
    public function getFaqById(int $id): Faq
    {
        $faq = $this->faqRepository->findById($id);

        if (!$faq) {
            throw new ModelNotFoundException("FAQ with ID {$id} not found.");
        }

        return $faq;
    }

    /**
     * @inheritDoc
     */
    public function searchFaqs(string $keyword, int $perPage): LengthAwarePaginator
    {
        return $this->faqRepository->search($keyword, $perPage);
    }

    /**
     * @inheritDoc
     */
    public function createFaq(array $data): Faq
    {
        return $this->faqRepository->create($data);
    }

    /**
     * @inheritDoc
     */
    public function updateFaq(int $id, array $data): Faq
    {
        return $this->faqRepository->update($id, $data);
    }

    /**
     * @inheritDoc
     */
    public function deleteFaq(int $id): bool
    {
        return $this->faqRepository->delete($id);
    }
}
