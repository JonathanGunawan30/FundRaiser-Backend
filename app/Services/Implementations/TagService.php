<?php

namespace App\Services\Implementations;

use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Services\Interfaces\TagServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TagService implements TagServiceInterface
{
    protected TagRepositoryInterface $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @inheritDoc
     */
    public function getAllTags(int $perPage): LengthAwarePaginator
    {
        return $this->tagRepository->getAllPaginated($perPage);
    }

    /**
     * @inheritDoc
     */
    public function getTagById(int $id): Tag
    {
        $tag = $this->tagRepository->findById($id);

        if (!$tag) {
            throw new ModelNotFoundException("Tag with ID {$id} not found.");
        }

        return $tag;
    }

    /**
     * @inheritDoc
     */
    public function searchTags(string $keyword, int $perPage): LengthAwarePaginator
    {
        return $this->tagRepository->search($keyword, $perPage);
    }
}
