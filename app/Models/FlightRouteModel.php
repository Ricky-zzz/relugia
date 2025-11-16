<?php

namespace App\Models;

use CodeIgniter\Model;

class FlightRouteModel extends Model
{
    protected $table      = 'tblflightroute';
    protected $primaryKey = 'id';
    protected $allowedFields = ['aid', 'oapid', 'dapid', 'round_trip', 'acid'];
    protected $useTimestamps = false;

    /**
     * Fetch flight routes with joins and optional filters.
     */
    public function getFiltered(array $filters = [], int $limit = 0, int $offset = 0): array
    {
        $builder = $this->db->table($this->table . ' fr')
            ->select('
                fr.id,
                fr.aid,
                fr.oapid,
                fr.dapid,
                fr.round_trip,
                fr.acid,
                a.airline_name,
                ao.airport_name AS origin_airport,
                ao.iata AS origin_iata,
                ad.airport_name AS destination_airport,
                ad.iata AS destination_iata,
                ac.model AS aircraft_model
            ')
            ->join('tblairline a', 'fr.aid = a.id', 'left')
            ->join('tblairport ao', 'fr.oapid = ao.id', 'left')
            ->join('tblairport ad', 'fr.dapid = ad.id', 'left')
            ->join('tblaircraft ac', 'fr.acid = ac.id', 'left');

        // Apply filters (skip id)
        if (!empty($filters['aid'])) {
            $builder->where('fr.aid', $filters['aid']);
        }
        if (!empty($filters['oapid'])) {
            $builder->where('fr.oapid', $filters['oapid']);
        }
        if (!empty($filters['dapid'])) {
            $builder->where('fr.dapid', $filters['dapid']);
        }
        if (!empty($filters['acid'])) {
            $builder->where('fr.acid', $filters['acid']);
        }
        if (isset($filters['round_trip']) && $filters['round_trip'] !== '') {
            $builder->where('fr.round_trip', $filters['round_trip']);
        }

        // Run the query
        $query = $limit > 0
            ? $builder->get($limit, $offset)
            : $builder->get();

        return $query->getResultArray();
    }

    /**
     * Count filtered routes.
     */
    public function countFiltered(array $filters = []): int
    {
        $builder = $this->db->table($this->table . ' fr')
            ->join('tblairline a', 'fr.aid = a.id', 'left')
            ->join('tblairport ao', 'fr.oapid = ao.id', 'left')
            ->join('tblairport ad', 'fr.dapid = ad.id', 'left')
            ->join('tblaircraft ac', 'fr.acid = ac.id', 'left');

        if (!empty($filters['aid'])) {
            $builder->where('fr.aid', $filters['aid']);
        }
        if (!empty($filters['oapid'])) {
            $builder->where('fr.oapid', $filters['oapid']);
        }
        if (!empty($filters['dapid'])) {
            $builder->where('fr.dapid', $filters['dapid']);
        }
        if (!empty($filters['acid'])) {
            $builder->where('fr.acid', $filters['acid']);
        }
        if (isset($filters['round_trip']) && $filters['round_trip'] !== '') {
            $builder->where('fr.round_trip', $filters['round_trip']);
        }

        return $builder->countAllResults();
    }

    /**
     * Get a single flight route with joins.
     */
    public function findWithDetails(int $id): ?array
    {
        return $this->db->table($this->table . ' fr')
            ->select('
                fr.id,
                fr.aid,
                fr.oapid,
                fr.dapid,
                fr.round_trip,
                fr.acid,
                a.airline_name,
                ao.airport_name AS origin_airport,
                ao.iata AS origin_iata,
                ad.airport_name AS destination_airport,
                ad.iata AS destination_iata,
                ac.model AS aircraft_model
            ')
            ->join('tblairline a', 'fr.aid = a.id', 'left')
            ->join('tblairport ao', 'fr.oapid = ao.id', 'left')
            ->join('tblairport ad', 'fr.dapid = ad.id', 'left')
            ->join('tblaircraft ac', 'fr.acid = ac.id', 'left')
            ->where('fr.id', $id)
            ->get()
            ->getRowArray();
    }
}
