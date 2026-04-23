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

    /**
     * @inheritDoc
     */
    public function create(array $data): Faq
    {
        return Faq::create($data);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $data): Faq
    {
        $faq = Faq::findOrFail($id);
        $faq->update($data);
        return $faq;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        $faq = Faq::findOrFail($id);
        return $faq->delete();
    }
}
