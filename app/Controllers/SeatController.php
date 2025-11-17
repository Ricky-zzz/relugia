<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AircraftModel;
use App\Models\SeatModel;
use App\Models\FlightScheduleModel;
use App\Models\FlightRouteModel;
use App\Models\AirportModel;
use App\Libraries\Auth;


class SeatController extends BaseController
{
    protected $seatModel;
    protected $flightScheduleModel;
    protected $flightRouteModel;
    protected $airportModel;

    protected $aircraftModel;

    protected $auth;

    public function __construct()
    {
        $this->seatModel = new SeatModel();
        $this->flightScheduleModel = new FlightScheduleModel();
        $this->flightRouteModel = new FlightRouteModel();
        $this->airportModel = new AirportModel();
        $this->aircraftModel = new AircraftModel();
        $this->auth = new Auth();
    }

    public function index($fid = null)
    {
        if (!$fid) {
            return redirect()->back()->with('error', 'Missing flight ID.');
        }

        $schedule = $this->flightScheduleModel->find($fid);
        if (!$schedule) {
            return redirect()->back()->with('error', 'Flight schedule not found.');
        }

        $route = $this->flightRouteModel->find($schedule['frid']);
        if (!$route) {
            return redirect()->back()->with('error', 'Associated route not found.');
        }

        $aircraft = $this->aircraftModel->find($route['acid'] ?? null);

        $originAirport = $this->airportModel->find($route['oapid'] ?? null);
        $destinationAirport = $this->airportModel->find($route['dapid'] ?? null);

        $schedule['frid'] = $route['id'] ?? null;
        $schedule['origin_airport'] = $originAirport['airport_name'] ?? 'Unknown';
        $schedule['destination_airport'] = $destinationAirport['airport_name'] ?? 'Unknown';

        $page = (int) ($this->request->getGet('page') ?? 1);
        $limit = 15;
        $offset = ($page - 1) * $limit;

        $allSeats = $this->seatModel
            ->where('fid', $fid)
            ->orderBy("CASE class
        WHEN 'First' THEN 1
        WHEN 'Business' THEN 2
        WHEN 'Economy' THEN 3
    END", '', false)
            ->orderBy('seat_name', 'ASC')
            ->findAll();

        $totalSeats = count($allSeats);
        $totalPages = ceil($totalSeats / $limit);
        $seats = array_slice($allSeats, $offset, $limit);

        $role = $this->auth->isAdmin() ? 'admin' : 'airline';
        $view_target = $role . '/seat';


        return view($view_target, [
            'fid' => $fid,
            'aircraft' => $aircraft,
            'schedule' => $schedule,
            'seats' => $seats,
            'allSeats' => $allSeats,
            'totalPages' => $totalPages,
            'page' => $page,
        ]);

    }

}
