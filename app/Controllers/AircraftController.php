<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AircraftModel;

class AircraftController extends BaseController
{
    protected $aircraftModel;

    public function __construct()
    {
        $this->aircraftModel = new AircraftModel();
    }

    public function index()
    {
        $filters = $this->request->getGet([
            'iata', 'icao', 'model'
        ]);

        $page     = (int) ($this->request->getGet('page') ?? 1);
        $perPage  = 9;
        $offset   = ($page - 1) * $perPage;

        $aircrafts = $this->aircraftModel->getFiltered($filters, $perPage, $offset);
        $total     = $this->aircraftModel->countFiltered($filters);
        $pages     = ceil($total / $perPage);

    
        return view('admin/aircraft', compact('aircrafts','page','pages','filters'));
    }

public function store()
{
    $data = $this->request->getPost([
        'iata',
        'icao',
        'model',
        'first_class',
        'business_class',
        'economy_class',
        'row_nums',
        'col_nums',
        'col_sizes'
    ]);

    $this->aircraftModel->insert($data);

    return redirect()->to('/admin/aircraft')->with('success', 'Aircraft created successfully!');
}

public function update($id = null)
{
    if (!$id) {
        return redirect()->back()->with('error', 'Missing aircraft ID');
    }

    $data = $this->request->getPost([
        'iata',
        'icao',
        'model',
        'first_class',
        'business_class',
        'economy_class',
        'row_nums',
        'col_nums',
        'col_sizes'
    ]);

    $this->aircraftModel->update($id, $data);

    return redirect()->to('/admin/aircraft')->with('success', 'Aircraft updated successfully!');
}


    public function destroy($id = null)
    {
        if (! $id) {
            return redirect()->back()->with('error', 'Missing aircraft ID');
        }

        $this->aircraftModel->delete($id);

        return redirect()->to('/admin/aircraft')->with('success', 'Aircraft deleted successfully!');
    }
}
