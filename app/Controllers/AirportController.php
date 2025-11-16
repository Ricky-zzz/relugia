<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AirportModel;

class AirportController extends BaseController
{
    protected $airportModel;

    public function __construct()
    {
        $this->airportModel = new AirportModel();
    }

    /** List airports with filters + pagination */
    public function index()
    {
        $filters = $this->request->getGet([
            'iata', 'icao', 'airport_name', 'location_serve', 'time', 'dst'
        ]);

        $page    = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 9;
        $offset  = ($page - 1) * $perPage;

        $airports = $this->airportModel->getFiltered($filters, $perPage, $offset);
        $total    = $this->airportModel->countFiltered($filters);
        $pages    = ceil($total / $perPage);

        return view('admin/airport', compact('airports', 'page', 'pages', 'filters'));
    }

    /** Store new airport */
    public function store()
    {
        $data = $this->request->getPost([
            'iata','icao','airport_name','location_serve','time','dst'
        ]);

        $this->airportModel->insert($data);

        return redirect()->to('/admin/airport')->with('success', 'Airport created successfully!');
    }

    /** Update airport */
    public function update($id = null)
    {
        if (! $id) {
            return redirect()->back()->with('error', 'Missing airport ID');
        }

        $data = $this->request->getPost([
            'iata','icao','airport_name','location_serve','time','dst'
        ]);

        $this->airportModel->update($id, $data);

        return redirect()->to('/admin/airport')->with('success', 'Airport updated successfully!');
    }

    /** Delete airport */
    public function destroy($id = null)
    {
        if (! $id) {
            return redirect()->back()->with('error', 'Missing airport ID');
        }

        $this->airportModel->delete($id);

        return redirect()->to('/admin/airport')->with('success', 'Airport deleted successfully!');
    }
}
