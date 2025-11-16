<?php

namespace App\Libraries;

class Auth
{
    protected $session;
    protected $user;

    public function __construct()
    {
        $this->session = session();
        $this->user    = $this->session->get('user');
    }

    public function login(array $userData)
    {

        $this->session->set('user', $userData);
        $this->user = $userData;
    }

    public function logout()
    {
        $this->session->remove('user');
        $this->user = null;
    }

public function check(): bool
{
    $this->user = $this->session->get('user'); 
    return !empty($this->user);
}


    public function isAdmin(): bool
    {
        return $this->user && $this->user['role'] === 'admin';
    }

    public function isAirlineUser(): bool
    {
        return $this->user && $this->user['role'] === 'airlineUser';
    }

    public function id()
    {
        return $this->user['id'] ?? null;
    }

    public function name()
    {
        return $this->user['name'] ?? null;
    }

    public function airlineId()
    {
        return $this->user['airline_id'] ?? null;
    }

    public function user()
    {
        return $this->user;
    }
    
}
