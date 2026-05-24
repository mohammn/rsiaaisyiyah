<?php

namespace App\Controllers;

use App\Models\SysLogModel;

class Log extends BaseController
{
    protected $sysLog;

    public function __construct()
    {
        if (!session()->get('nama') or (session()->get('rule') != 1 and session()->get('rule') != 2)) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->sysLog = new SysLogModel();
    }
    public function index()
    {
        $log = $this->sysLog->findAll();

        $data = (object) [
            'log'     => $log
        ];

        return view('log', ['data' => $data]);
    }

    public function muatLog($id)
    {
        $log = $this->sysLog->where('id', $id)->first();

        echo json_encode($log);
    }
}
