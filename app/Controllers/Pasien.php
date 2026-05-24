<?php

namespace App\Controllers;

use App\Models\RegPeriksaModel;
use App\Models\PasienModel;
use App\Models\PjPasienModel;

class Pasien extends BaseController
{
    protected $regPeriksaModel;
    protected $pasienModel;
    protected $pjPasienModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }

        $this->regPeriksaModel = new RegPeriksaModel();
        $this->pasienModel = new PasienModel();
        $this->pjPasienModel = new PjPasienModel();
    }
    public function index()
    {
        $pasien = $this->pasienModel->findAll();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien
        ];

        return view('pasien', ['data' => $data]);
    }

    public function lihatPj()
    {
        $dataPj = $this->pjPasienModel->where('noRm', $this->request->getPost("noRm"))->first();
        echo json_encode($dataPj);
    }

    public function simpanPj()
    {
        $noRm = $this->request->getPost("noRm");
        $data = [
            'noRm' => $noRm,
            'namaPj'      => $this->request->getPost("namaPj"),
            'nikPj'       => $this->request->getPost("nikPj"),
            'tglLahirPj' => $this->request->getPost("tglLahirPj"),
            'tempatLahirPj' => $this->request->getPost("tempatLahirPj"),
            'jkPj'        => $this->request->getPost("jkPj"),
            'alamatPj'    => $this->request->getPost("alamatPj"),
        ];

        if ($this->pjPasienModel->where('noRm', $noRm)->first()) {
            unset($data['noRm']);
            $this->pjPasienModel->where('noRm', $noRm)->set($data)->update();
        } else {
            $this->pjPasienModel->insert($data);
        }

        echo json_encode('');
    }
}
