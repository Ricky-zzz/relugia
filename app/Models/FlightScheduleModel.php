<?php

namespace App\Models;

use CodeIgniter\Model;

class FlightScheduleModel extends Model
{
    protected $table = 'tblflightschedule';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'auid', 'frid', 'date_departure', 'time_departure',
        'date_arrival', 'time_arrival', 'status',
        'first_price', 'business_price', 'economy_price'
    ];

    /** Get schedules with related details and filters */
    public function getDetailedSchedules($filters = [], $limit = 10, $offset = 0)
    {
        $builder = $this->db->table($this->table);
        $builder->select(
            'tblflightschedule.*,
             tblairlineuser.user AS airline_user,
             tblairline.airline_name AS airline_name,
             origin.airport_name AS origin_airport,
             dest.airport_name AS destination_airport,
             tblaircraft.model AS aircraft_model'
        );

        $builder->join('tblairlineuser', 'tblairlineuser.id = tblflightschedule.auid', 'left');
        $builder->join('tblflightroute', 'tblflightroute.id = tblflightschedule.frid', 'left');
        $builder->join('tblairline', 'tblairline.id = tblflightroute.aid', 'left');
        $builder->join('tblairport AS origin', 'origin.id = tblflightroute.oapid', 'left');
        $builder->join('tblairport AS dest', 'dest.id = tblflightroute.dapid', 'left');
        $builder->join('tblaircraft', 'tblaircraft.id = tblflightroute.acid', 'left');

        // ✅ FILTERS
        if (!empty($filters['aid'])) {
            $builder->where('tblflightroute.aid', $filters['aid']);
        }

        if (!empty($filters['frid'])) {
            $builder->where('tblflightschedule.frid', $filters['frid']);
        }

        if (!empty($filters['status'])) {
            $builder->where('tblflightschedule.status', $filters['status']);
        }

        $builder->limit($limit, $offset);
        return $builder->get()->getResultArray();
    }

    /** Count schedules for pagination */
    public function countDetailedSchedules($filters = [])
    {
        $builder = $this->db->table($this->table);
        $builder->join('tblflightroute', 'tblflightroute.id = tblflightschedule.frid', 'left');

        if (!empty($filters['aid'])) {
            $builder->where('tblflightroute.aid', $filters['aid']);
        }

        if (!empty($filters['frid'])) {
            $builder->where('tblflightschedule.frid', $filters['frid']);
        }

        if (!empty($filters['status'])) {
            $builder->where('tblflightschedule.status', $filters['status']);
        }

        return $builder->countAllResults();
    }
}
