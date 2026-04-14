<?php

namespace App\Repositories\Interfaces;

use App\Models\Notification;
use Illuminate\Pagination\LengthAwarePaginator;

interface NotificationRepositoryInterface
{
    /**
     * Get all notifications with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $perPage): LengthAwarePaginator;

    /**
     * Get notification by ID.
     *
     * @param int $id
     * @return Notification|null
     */
    public function findById(int $id): ?Notification;

    /**
     * Search notifications by keyword.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function search(string $keyword, int $perPage): LengthAwarePaginator;
}
