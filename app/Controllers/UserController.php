<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /** List users with filters + pagination */
    public function index()
    {
        $filters = $this->request->getGet(['user', 'role']);

        $page    = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 20;
        $offset  = ($page - 1) * $perPage;

        $users = $this->userModel->getFiltered($filters, $perPage, $offset);
        $total = $this->userModel->countFiltered($filters);
        $pages = ceil($total / $perPage);

        return view('admin/user', compact('users', 'page', 'pages', 'filters'));
    }

    /** Store new user */
    public function store()
    {
        $data = $this->request->getPost([
            'user',
            'pass',
            'role'
        ]);

        $this->userModel->insert($data);

        return redirect()->to('/admin/user')->with('success', 'User created successfully!');
    }

    /** Update a user */
    public function update($id = null)
    {
        if (!$id) {
            return redirect()->back()->with('error', 'Missing user ID');
        }

        $data = $this->request->getPost([
            'user',
            'pass',
            'role'
        ]);

        $this->userModel->update($id, $data);

        return redirect()->to('/admin/user')->with('success', 'User updated successfully!');
    }

    /** Delete a user */
    public function destroy($id = null)
    {
        if (!$id) {
            return redirect()->back()->with('error', 'Missing user ID');
        }

        $this->userModel->delete($id);

        return redirect()->to('/admin/user')->with('success', 'User deleted successfully!');
    }
}
