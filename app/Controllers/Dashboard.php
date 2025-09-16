<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function __construct() {}
    public function index()
    {
        if (!session()->get('nama')) {
            return redirect()->to(base_url() . "login");
        }
        echo view('dashboard');
    }
}
