<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AirlineModel;

class AirlineController extends BaseController
{
    protected $airlineModel;

    public function __construct()
    {
        $this->airlineModel = new AirlineModel();
    }

    public function index()
    {
        $filters = $this->request->getGet([
            'iata', 'icao', 'airline_name', 'callsign', 'region'
        ]);

        $page     = (int) ($this->request->getGet('page') ?? 1);
        $perPage  = 9;
        $offset   = ($page - 1) * $perPage;

        $airlines = $this->airlineModel->getFiltered($filters, $perPage, $offset);
        $total    = $this->airlineModel->countFiltered($filters);
        $pages    = ceil($total / $perPage);

        return view('admin/airline', compact('airlines','page','pages','filters'));
    }

    public function store()
    {
        $data = $this->request->getPost([
            'iata','icao','airline_name','callsign','region','comments'
        ]);

        $this->airlineModel->insert($data);

        return redirect()->to('/admin/airline')->with('success', 'Airline created successfully!');
    }

    public function update($id = null)
    {
        if (!$id) {
            return redirect()->back()->with('error', 'Missing airline ID');
        }

        $data = $this->request->getPost([
            'iata','icao','airline_name','callsign','region','comments'
        ]);

        $this->airlineModel->update($id, $data);

        return redirect()->to('/admin/airline')->with('success', 'Airline updated successfully!');
    }

    public function destroy($id = null)
    {
        if (!$id) {
            return redirect()->back()->with('error', 'Missing airline ID');
        }

        $this->airlineModel->delete($id);

        return redirect()->to('/admin/airline')->with('success', 'Airline deleted successfully!');
    }
}
