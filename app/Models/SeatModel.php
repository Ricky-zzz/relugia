<?php

namespace App\Models;

use CodeIgniter\Model;

class SeatModel extends Model
{
    protected $table      = 'tblseats';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'fid', 'ticket_no', 'seat_name', 'class', 'status','seat_price'
    ];

    protected $useTimestamps = false;

    /**
     * Get all seats with optional filters, pagination, and ordering
     */
    public function getFiltered(array $filters = [], int $limit = 200, int $offset = 0): array
    {
        $builder = $this->builder();

        if (!empty($filters['fid'])) {
            $builder->where('fid', $filters['fid']);
        }

        if (!empty($filters['class'])) {
            $builder->where('class', $filters['class']);
        }

        if (!empty($filters['status'])) {
            $builder->where('status', $filters['status']);
        }

        $builder->orderBy('id', 'ASC');

        return $builder->get($limit, $offset)->getResultArray();
    }

    /**
     * Count filtered seats
     */
    public function countFiltered(array $filters = []): int
    {
        $builder = $this->builder();

        if (!empty($filters['fid'])) {
            $builder->where('fid', $filters['fid']);
        }

        if (!empty($filters['class'])) {
            $builder->where('class', $filters['class']);
        }

        if (!empty($filters['status'])) {
            $builder->where('status', $filters['status']);
        }

        return $builder->countAllResults();
    }

    /**
     * Get all seats for a specific schedule
     */
    public function findBySchedule(int $fid): array
    {
        return $this->where('fid', $fid)
                    ->orderBy('seat_name', 'ASC')
                    ->findAll();
    }

}