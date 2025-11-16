<?php

namespace App\Models;

use CodeIgniter\Model;

class AirportModel extends Model
{
    protected $table      = 'tblairport';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'iata', 'icao', 'airport_name', 'location_serve', 'time', 'dst'
    ];

    protected $useTimestamps = false;

    /**
     * Get filtered airports with pagination
     */
    public function getFiltered(
        array $filters = [],
        int $limit = 20,
        int $offset = 0,
        string $orderBy = 'airport_name',
        string $orderDir = 'ASC'
    ): array {
        $builder = $this->builder();

        if (!empty($filters['iata'])) {
            $builder->like('iata', $filters['iata'], 'after');
        }
        if (!empty($filters['icao'])) {
            $builder->like('icao', $filters['icao'], 'after');
        }
        if (!empty($filters['airport_name'])) {
            $builder->like('airport_name', $filters['airport_name']);
        }
        if (!empty($filters['location_serve'])) {
            $builder->like('location_serve', $filters['location_serve']);
        }
        if (!empty($filters['time'])) {
            $builder->where('time', $filters['time']);
        }
        if (!empty($filters['dst'])) {
            $builder->where('dst', $filters['dst']);
        }

        $allowedOrder = ['id','iata','icao','airport_name','location_serve','time','dst'];
        if (! in_array($orderBy, $allowedOrder)) {
            $orderBy = 'airport_name';
        }
        $builder->orderBy($orderBy, $orderDir);

        return $builder->get($limit, $offset)->getResultArray();
    }

    /**
     * Count filtered airports (for pagination)
     */
    public function countFiltered(array $filters = []): int
    {
        $builder = $this->builder();

        if (!empty($filters['iata'])) {
            $builder->like('iata', $filters['iata'], 'after');
        }
        if (!empty($filters['icao'])) {
            $builder->like('icao', $filters['icao'], 'after');
        }
        if (!empty($filters['airport_name'])) {
            $builder->like('airport_name', $filters['airport_name']);
        }
        if (!empty($filters['location_serve'])) {
            $builder->like('location_serve', $filters['location_serve']);
        }
        if (!empty($filters['time'])) {
            $builder->where('time', $filters['time']);
        }
        if (!empty($filters['dst'])) {
            $builder->where('dst', $filters['dst']);
        }

        return $builder->countAllResults();
    }
}
