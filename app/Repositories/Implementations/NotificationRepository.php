<?php

namespace App\Repositories\Implementations;

use App\Models\Notification;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class NotificationRepository implements NotificationRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator
    {
        return Notification::paginate($perPage);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?Notification
    {
        return Notification::find($id);
    }

    /**
     * @inheritDoc
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator
    {
        return Notification::where('title', 'like', "%{$keyword}%")
            ->paginate($perPage);
    }
}
