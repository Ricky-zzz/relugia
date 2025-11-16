<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FlightRouteModel;
use App\Models\AirlineModel;
use App\Models\AirportModel;
use App\Models\AircraftModel;
use App\Libraries\Auth;

class FlightRouteController extends BaseController
{
    protected $flightRouteModel;
    protected $airlineModel;
    protected $airportModel;
    protected $aircraftModel;
    protected $auth;

    public function __construct()
    {
        $this->flightRouteModel = new FlightRouteModel();
        $this->airlineModel     = new AirlineModel();
        $this->airportModel     = new AirportModel();
        $this->aircraftModel    = new AircraftModel();
        $this->auth             = new Auth();
    }

    /** Show flight routes depending on role */
    public function index()
    {
        $filters = $this->request->getGet([
            'id', 'aid', 'oapid', 'dapid', 'acid', 'round_trip'
        ]);

        if ($this->auth->isAirlineUser()) {
            $filters['aid'] = $this->auth->airlineId();
        }

        $page     = (int) ($this->request->getGet('page') ?? 1);
        $perPage  = 10;
        $offset   = ($page - 1) * $perPage;

        $routes = $this->flightRouteModel->getFiltered($filters, $perPage, $offset);
        $total  = $this->flightRouteModel->countFiltered($filters);
        $pages  = ceil($total / $perPage);

        $airlines  = $this->airlineModel->findAll();
        $airports  = $this->airportModel->findAll();
        $aircrafts = $this->aircraftModel->findAll();

        if ($this->auth->isAdmin()) {
            return view('admin/flightroute', compact('routes', 'airlines', 'airports', 'aircrafts', 'page', 'pages', 'filters'));
        } 
        
        if ($this->auth->isAirlineUser()) {
            return view('airline/flightroute', compact('routes', 'airlines', 'airports', 'aircrafts', 'page', 'pages', 'filters'));
        } 
        
        return view('user/flightroute', compact('routes', 'airlines', 'airports', 'aircrafts'));
        
    }

    /** Store new flight route */
    public function store()
    {
        if (! $this->auth->check()) {
            return redirect()->to('/login');
        }

        $data = $this->request->getPost([
            'aid', 'oapid', 'dapid', 'acid'
        ]);

        $data['round_trip'] = $this->request->getPost('round_trip') ? 1 : 0;

        if ($this->auth->isAirlineUser()) {
            $data['aid'] = $this->auth->airlineId();
        }

        $this->flightRouteModel->insert($data);

        return redirect()->back()->with('success', 'Flight route created successfully!');
    }

    /** Update existing route */
    public function update($id = null)
    {
        if (! $this->auth->check()) {
            return redirect()->to('/login');
        }

        if (! $id) {
            return redirect()->back()->with('error', 'Missing flight route ID');
        }

        $data = $this->request->getPost([
            'aid', 'oapid', 'dapid', 'acid'
        ]);
        $data['round_trip'] = $this->request->getPost('round_trip') ? 1 : 0;


        if ($this->auth->isAirlineUser()) {
            $route = $this->flightRouteModel->find($id);
            if (! $route || $route['aid'] != $this->auth->airlineId()) {
                return redirect()->back()->with('error', 'Unauthorized action!');
            }

            $data['aid'] = $this->auth->airlineId(); 
        }

        $this->flightRouteModel->update($id, $data);

        return redirect()->back()->with('success', 'Flight route updated successfully!');
    }

    /** Delete route */
    public function destroy($id = null)
    {
        if (! $this->auth->check()) {
            return redirect()->to('/login');
        }

        if (! $id) {
            return redirect()->back()->with('error', 'Missing ID');
        }

        if ($this->auth->isAirlineUser()) {
            $route = $this->flightRouteModel->find($id);
            if (! $route || $route['aid'] != $this->auth->airlineId()) {
                return redirect()->back()->with('error', 'Unauthorized action!');
            }
        }

        $this->flightRouteModel->delete($id);

        return redirect()->back()->with('success', 'Flight route deleted successfully!');
    }
}
