<?php

namespace App\Models;

use CodeIgniter\Model;

class AirlineModel extends Model
{
    protected $table      = 'tblairline';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'iata', 'icao', 'airline_name', 'callsign', 'region', 'comments'
    ];

    protected $useTimestamps = false; 

    public function getFiltered(array $filters = [], int $limit = 20, int $offset = 0, string $orderBy = 'airline_name', string $orderDir = 'ASC')
    {
        $builder = $this->builder();

        if (!empty($filters['iata'])) {
            $builder->like('iata', $filters['iata'], 'after');
        }
        if (!empty($filters['icao'])) {
            $builder->like('icao', $filters['icao'], 'after');
        }
        if (!empty($filters['airline_name'])) {
            $builder->like('airline_name', $filters['airline_name']);
        }
        if (!empty($filters['callsign'])) {
            $builder->like('callsign', $filters['callsign']);
        }
        if (!empty($filters['region'])) {
            $builder->like('region', $filters['region']);
        }

  
        $allowedOrder = ['id','iata','icao','airline_name','callsign','region'];
        if (! in_array($orderBy, $allowedOrder)) {
            $orderBy = 'airline_name';
        }
        $builder->orderBy($orderBy, $orderDir);

        return $builder->get($limit, $offset)->getResultArray();
    }

    public function countFiltered(array $filters = []): int
    {
        $builder = $this->builder();

        if (!empty($filters['iata'])) {
            $builder->like('iata', $filters['iata'], 'after');
        }
        if (!empty($filters['icao'])) {
            $builder->like('icao', $filters['icao'], 'after');
        }
        if (!empty($filters['airline_name'])) {
            $builder->like('airline_name', $filters['airline_name']);
        }
        if (!empty($filters['callsign'])) {
            $builder->like('callsign', $filters['callsign']);
        }
        if (!empty($filters['region'])) {
            $builder->like('region', $filters['region']);
        }

        return $builder->countAllResults();
    }
}
