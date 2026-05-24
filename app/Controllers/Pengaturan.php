<?php

namespace App\Controllers;

use App\Models\PengaturanModel;

class Pengaturan extends BaseController
{
    protected $pengaturanModel;

    public function __construct()
    {
        if (!session()->get('nama') or (session()->get('rule') != 1 and session()->get('rule') != 2)) {
            header('Location: ' . base_url('login'));
            exit();
        }

        $this->pengaturanModel = new PengaturanModel();
    }
    public function index()
    {

        $dataAwal = $this->pengaturanModel->where('id', 1)->first();

        echo view('pengaturan', $dataAwal);
    }

    public function ubahWaktu()
    {
        $dataAwal = $this->pengaturanModel->where('id', 1)->first();
        $nilaiBaru = ($dataAwal['waktu'] == 1) ? 0 : 1;

        $data = [
            "waktu" => $nilaiBaru
        ];

        $this->pengaturanModel->update(1, $data);
        echo json_encode('');
    }
}
