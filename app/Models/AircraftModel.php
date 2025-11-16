<?php

namespace App\Models;

use CodeIgniter\Model;

class AircraftModel extends Model
{
    protected $table      = 'tblaircraft';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'iata',
        'icao',
        'model',
        'first_class',
        'business_class',
        'economy_class',
        'row_nums',
        'col_nums',
        'col_sizes'
    ];

    protected $useTimestamps = false;

    public function getFiltered(array $filters = [], int $limit = 20, int $offset = 0, string $orderBy = 'model', string $orderDir = 'ASC')
    {
        $builder = $this->builder();

        if (!empty($filters['iata'])) {
            $builder->like('iata', $filters['iata'], 'after');
        }
        if (!empty($filters['icao'])) {
            $builder->like('icao', $filters['icao'], 'after');
        }
        if (!empty($filters['model'])) {
            $builder->like('model', $filters['model']);
        }

        $allowedOrder = ['id','iata','icao','model'];
        if (!in_array($orderBy, $allowedOrder)) {
            $orderBy = 'model';
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
        if (!empty($filters['model'])) {
            $builder->like('model', $filters['model']);
        }

        return $builder->countAllResults();
    }
}
