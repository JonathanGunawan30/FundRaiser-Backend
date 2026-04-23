<?php

namespace App\Services\Interfaces;

use App\Models\Notification;
use Illuminate\Pagination\LengthAwarePaginator;

interface NotificationServiceInterface
{
    /**
     * Get all notifications with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllNotifications(int $perPage): LengthAwarePaginator;

    /**
     * Get notification by ID.
     *
     * @param int $id
     * @return Notification
     */
    public function getNotificationById(int $id): Notification;

    /**
     * Search notifications.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function searchNotifications(string $keyword, int $perPage): LengthAwarePaginator;
}
