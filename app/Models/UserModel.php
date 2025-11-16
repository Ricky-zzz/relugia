<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'tbluser';
    protected $primaryKey = 'id';

    protected $allowedFields = ['user', 'pass', 'role'];

    protected $useTimestamps = false;

    /**
     * Find user by username (for login)
     */
    public function findByUsername(string $username)
    {
        return $this->where('user', $username)->first();
    }

    /**
     * Get filtered users + pagination
     */
    public function getFiltered(array $filters = [], int $limit = 20, int $offset = 0, string $orderBy = 'id', string $orderDir = 'ASC')
    {
        $builder = $this->builder();

        if (!empty($filters['user'])) {
            $builder->like('user', $filters['user']);
        }

        if (!empty($filters['role'])) {
            $builder->like('role', $filters['role']);
        }

        $allowedOrder = ['id', 'user', 'role'];
        if (!in_array($orderBy, $allowedOrder)) {
            $orderBy = 'id';
        }

        $builder->orderBy($orderBy, $orderDir);

        return $builder->get($limit, $offset)->getResultArray();
    }

    /**
     * Count filtered users
     */
    public function countFiltered(array $filters = []): int
    {
        $builder = $this->builder();

        if (!empty($filters['user'])) {
            $builder->like('user', $filters['user']);
        }

        if (!empty($filters['role'])) {
            $builder->like('role', $filters['role']);
        }

        return $builder->countAllResults();
    }
}
