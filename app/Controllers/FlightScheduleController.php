<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FlightScheduleModel;
use App\Models\FlightRouteModel;
use App\Models\AirlineModel;
use App\Models\AirportModel;
use App\Models\AircraftModel;
use App\Models\AirlineUserModel;
use App\Libraries\Auth;
use App\Libraries\SeatService;


class FlightScheduleController extends BaseController
{
    protected $flightScheduleModel;
    protected $flightRouteModel;
    protected $airlineModel;
    protected $airportModel;
    protected $aircraftModel;
    protected $airlineUserModel;
    protected $auth;
    protected $seatService;


    public function __construct()
    {
        $this->flightScheduleModel = new FlightScheduleModel();
        $this->flightRouteModel = new FlightRouteModel();
        $this->airlineModel = new AirlineModel();
        $this->airportModel = new AirportModel();
        $this->aircraftModel = new AircraftModel();
        $this->airlineUserModel = new AirlineUserModel();
        $this->auth = new Auth();
        $this->seatService = new SeatService();

    }

    /** Show schedules depending on role */
    public function index($frid = null)
    {
        $filters = $this->request->getGet([
            'id',
            'auid',
            'frid',
            'status',
            'date_departure_from',
            'date_departure_to',
            'date_arrival_from',
            'date_arrival_to'
        ]);

        if ($frid !== null) {
            $filters['frid'] = $frid;
        }


        if ($this->auth->isAirlineUser()) {
            $filters['aid'] = $this->auth->airlineId();
        }

        $page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        $schedules = $this->flightScheduleModel->getDetailedSchedules($filters, $perPage, $offset);
        $total = $this->flightScheduleModel->countDetailedSchedules($filters);
        $pages = ceil($total / $perPage);

        $routes = $this->flightRouteModel->findAll();
        $airlines = $this->airlineModel->findAll();
        $airports = $this->airportModel->findAll();
        $aircrafts = $this->aircraftModel->findAll();


        $selectedRoute = $frid ? $this->flightRouteModel->findWithDetails($frid) : null;

        $airlineUsers = $this->airlineUserModel->findSpecificUsers($selectedRoute['aid'] ?? null);

        foreach ($routes as &$route) {
            $airline = $this->airlineModel->find($route['aid'] ?? null);
            $route['airline_name'] = $airline['airline_name'] ?? 'Unknown Airline';
        }

        if ($this->auth->isAdmin()) {
            return view('admin/flightschedule', compact(
                'schedules',
                'routes',
                'airlines',
                'airports',
                'aircrafts',
                'airlineUsers',
                'page',
                'pages',
                'filters',
                'selectedRoute'
            ));
        }

        if ($this->auth->isAirlineUser()) {
            return view('airline/flightschedule', compact(
                'schedules',
                'routes',
                'airlines',
                'airports',
                'aircrafts',
                'airlineUsers',
                'page',
                'pages',
                'filters',
                'selectedRoute'
            ));
        }

        // For regular users
        return view('user/flightschedules', compact(
            'schedules',
            'routes',
            'airlines',
            'airports',
            'aircrafts',
            'selectedRoute'
        ));
    }

    /** Store new flight schedule */
    public function store()
    {
        if (!$this->auth->check()) {
            return redirect()->to('/login');
        }

        $data = $this->request->getPost([
            'auid',
            'frid',
            'date_departure',
            'time_departure',
            'date_arrival',
            'time_arrival',
            'status',
            'first_price',
            'business_price',
            'economy_price'
        ]);

        $data['status'] = $data['status'] ?? 'scheduled';

        if ($this->auth->isAirlineUser()) {
            $route = $this->flightRouteModel->find($data['frid']);
            if (!$route || $route['aid'] != $this->auth->airlineId()) {
                return redirect()->back()->with('error', 'Unauthorized: Route does not belong to your airline.');
            }

            $data['auid'] = $this->auth->id();
        }

        $this->flightScheduleModel->insert($data);
        $scheduleId = $this->flightScheduleModel->getInsertID();
        $route = $this->flightRouteModel->find($data['frid']);
        $aircraftId = $route['acid'] ?? null;

        if ($aircraftId) {
            $this->seatService->generateSeats($scheduleId, $aircraftId);
        }

        return redirect()->back()->with('success', 'Flight schedule created successfully!');
    }

    /** Update existing flight schedule */
    public function update($id = null)
    {
        if (!$this->auth->check()) {
            return redirect()->to('/login');
        }

        if (!$id) {
            return redirect()->back()->with('error', 'Missing flight schedule ID');
        }

        $schedule = $this->flightScheduleModel->find($id);
        if (!$schedule) {
            return redirect()->back()->with('error', 'Flight schedule not found');
        }

        $data = $this->request->getPost([
            'date_departure',
            'time_departure',
            'date_arrival',
            'time_arrival',
            'status',
            'first_price',
            'business_price',
            'economy_price'
        ]);

        $data['status'] = $data['status'] ?? 'scheduled';

        // Airline restriction check
        if ($this->auth->isAirlineUser()) {
            $route = $this->flightRouteModel->find($schedule['frid']);
            if (!$route || $route['aid'] != $this->auth->airlineId()) {
                return redirect()->back()->with('error', 'Unauthorized action.');
            }
        }

        $this->flightScheduleModel->update($id, $data);

        return redirect()->back()->with('success', 'Flight schedule updated successfully!');
    }

    /** Delete flight schedule */
    public function destroy($id = null)
    {
        if (!$this->auth->check()) {
            return redirect()->to('/login');
        }

        if (!$id) {
            return redirect()->back()->with('error', 'Missing ID');
        }

        $schedule = $this->flightScheduleModel->find($id);
        if (!$schedule) {
            return redirect()->back()->with('error', 'Schedule not found');
        }

        if ($this->auth->isAirlineUser()) {
            $route = $this->flightRouteModel->find($schedule['frid']);
            if (!$route || $route['aid'] != $this->auth->airlineId()) {
                return redirect()->back()->with('error', 'Unauthorized action.');
            }
        }

        $this->seatService->deleteSeatsBySchedule($id);
        $this->flightScheduleModel->delete($id);

        return redirect()->back()->with('success', 'Flight schedule deleted successfully!');
    }
}
