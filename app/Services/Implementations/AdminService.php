<?php

namespace App\Services\Implementations;

use App\Models\Admin;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Services\Interfaces\AdminServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminService implements AdminServiceInterface
{
    protected AdminRepositoryInterface $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * @inheritDoc
     */
    public function getAllAdmins(int $perPage): LengthAwarePaginator
    {
        return $this->adminRepository->getAllPaginated($perPage);
    }

    /**
     * @inheritDoc
     */
    public function getAdminById(int $id): Admin
    {
        $admin = $this->adminRepository->findById($id);

        if (!$admin) {
            throw new ModelNotFoundException("Admin with ID {$id} not found.");
        }

        return $admin;
    }

    /**
     * @inheritDoc
     */
    public function searchAdmins(string $keyword, int $perPage): LengthAwarePaginator
    {
        return $this->adminRepository->search($keyword, $perPage);
    }
}
