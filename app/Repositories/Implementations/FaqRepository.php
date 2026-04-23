<?php

namespace App\Repositories\Implementations;

use App\Models\Faq;
use App\Repositories\Interfaces\FaqRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class FaqRepository implements FaqRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator
    {
        return Faq::paginate($perPage);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?Faq
    {
        return Faq::find($id);
    }

    /**
     * @inheritDoc
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator
    {
        return Faq::where('question', 'like', "%{$keyword}%")
            ->paginate($perPage);
    }
}
