<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AirlineUserModel;
use App\Models\AirlineModel;

class AirlineUserController extends BaseController
{
    protected $airlineUserModel;
    protected $airlineModel;

    public function __construct()
    {
        $this->airlineUserModel = new AirlineUserModel();
        $this->airlineModel     = new AirlineModel();
    }

    /**
     * List airline users with filters + pagination
     */
    public function index()
    {
        $filters = $this->request->getGet([
            'user',
            'type',
            'aid'
        ]);

        $page    = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 9;
        $offset  = ($page - 1) * $perPage;

        $users = $this->airlineUserModel->getFiltered($filters, $perPage, $offset);
        $total = $this->airlineUserModel->countFiltered($filters);
        $pages = ceil($total / $perPage);

        $airlines = $this->airlineModel->findAll();

        return view('admin/airlineuser', compact(
            'users',
            'page',
            'pages',
            'filters',
            'airlines'
        ));
    }

    /**
     * Store new airline user
     */
    public function store()
    {
        $data = $this->request->getPost([
            'user',
            'pass',
            'type',
            'aid'
        ]);

        $this->airlineUserModel->insert($data);

        return redirect()
            ->to('/admin/airlineuser')
            ->with('success', 'Airline user created successfully!');
    }

    /**
     * Update airline user
     */
    public function update($id = null)
    {
        if (!$id) {
            return redirect()->back()->with('error', 'Missing user ID');
        }

        $data = $this->request->getPost([
            'user',
            'type',
            'aid'
        ]);

        // only update password if entered
        $password = $this->request->getPost('pass');
        if (!empty($password)) {
            $data['pass'] = $password;
        }

        $this->airlineUserModel->update($id, $data);

        return redirect()
            ->to('/admin/airlineuser')
            ->with('success', 'Airline user updated successfully!');
    }

    /**
     * Delete airline user
     */
    public function destroy($id = null)
    {
        if (!$id) {
            return redirect()->back()->with('error', 'Missing user ID');
        }

        $this->airlineUserModel->delete($id);

        return redirect()
            ->to('/admin/airlineuser')
            ->with('success', 'Airline user deleted successfully!');
    }
}
