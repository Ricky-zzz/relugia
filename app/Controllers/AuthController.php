<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AirlineUserModel;
use App\Libraries\Auth; 

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }
    

    public function doLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $role     = $this->request->getPost('role');

        $auth = new Auth();

        if ($role === 'airlineuser') {
            $model = new AirlineUserModel();
            $user  = $model->findByUsername($username);

            if ($user && $user['pass'] === $password) {
                $auth->login([
                    'id'         => $user['id'],
                    'name'       => $user['user'],
                    'role'       => $user['type'],   
                    'airline_id' => $user['aid']
                ]);
               
                return view('/airline/dashboard');
            }
        } elseif ($role === 'admin' || $role === 'user') {
            $model = new UserModel();
            $user  = $model->findByUsername($username);

            if ($user && $user['pass'] === $password) {
                $auth->login([
                    'id'   => $user['id'],
                    'name' => $user['user'],
                    'role' => $user['role']
                ]);
                
                return redirect()->to($user['role'] === 'admin' ? '/admin/dashboard' : '/user/dashboard');
            }
        }

        
        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        $auth = new Auth();
        $auth->logout();

        return redirect()->to('/');
    }

    public function admin()
    {
        return view('admin/dashboard');
    }
}
