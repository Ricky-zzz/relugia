<?php

namespace App\Models;

use CodeIgniter\Model;

class AirlineUserModel extends Model
{
    protected $table      = 'tblairlineuser';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user', 'pass', 'type', 'aid'];

    /**
     * Find user by username
     */
    public function findByUsername(string $username)
    {
        return $this->where('user', $username)->first();
    }

    /**
     * Get users belonging to specific airline
     */
    public function findSpecificUsers(?int $aid = null): array
    {
        if ($aid === null) {
            return $this->findAll();
        }

        return $this->where('aid', $aid)->findAll();
    }
    public function getFiltered(array $filters = [], int $limit = 0, int $offset = 0): array
    {
        $builder = $this->db->table($this->table . ' u')
            ->select('
                u.id,
                u.user,
                u.pass,
                u.type,
                u.aid,
                a.airline_name
            ')
            ->join('tblairline a', 'u.aid = a.id', 'left');

        // Filters
        if (!empty($filters['user'])) {
            $builder->like('u.user', $filters['user']);
        }
        if (!empty($filters['type'])) {
            $builder->where('u.type', $filters['type']);
        }
        if (!empty($filters['aid'])) {
            $builder->where('u.aid', $filters['aid']);
        }
        if (!empty($filters['airline_name'])) {
            $builder->like('a.airline_name', $filters['airline_name']);
        }

        // Ordering (safe whitelist)
        $allowed = ['id', 'user', 'type', 'airline_name'];
        $orderBy = $filters['orderBy'] ?? 'user';
        if (!in_array($orderBy, $allowed)) {
            $orderBy = 'user';
        }

        $orderDir = (!empty($filters['orderDir']) && strtoupper($filters['orderDir']) === 'DESC')
            ? 'DESC'
            : 'ASC';

        $builder->orderBy($orderBy, $orderDir);

        // Execute
        $query = $limit > 0
            ? $builder->get($limit, $offset)
            : $builder->get();

        return $query->getResultArray();
    }

    /**
     * Count filtered users (for pagination)
     */
    public function countFiltered(array $filters = []): int
    {
        $builder = $this->db->table($this->table . ' u')
            ->join('tblairline a', 'u.aid = a.id', 'left')
            ->select('COUNT(*) AS total');

        // Filters
        if (!empty($filters['user'])) {
            $builder->like('u.user', $filters['user']);
        }
        if (!empty($filters['type'])) {
            $builder->where('u.type', $filters['type']);
        }
        if (!empty($filters['aid'])) {
            $builder->where('u.aid', $filters['aid']);
        }
        if (!empty($filters['airline_name'])) {
            $builder->like('a.airline_name', $filters['airline_name']);
        }

        return (int) $builder->countAllResults();
    }
}
