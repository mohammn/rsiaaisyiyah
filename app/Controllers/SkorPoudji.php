<?php

namespace App\Controllers;

use App\Models\PasienModel;
use App\Models\SkorModel;
use App\Models\PasienSkorpModel;

class SkorPoudji extends BaseController
{
    public function __construct()
    {
        $this->pasienModel = new PasienModel();
        $this->skorModel = new SkorModel();
        $this->pasienSkorpModel = new PasienSkorpModel();
    }

    public function index()
    {
        if (!session()->get('nama')) {
            return redirect()->to(base_url() . "login");
        }

        echo view('skorPoudji');
    }

    public function muatDataPasien()
    {
        echo json_encode($this->pasienSkorpModel->findAll());
    }

    public function muatTambahPasien()
    {
        echo json_encode($this->pasienModel->findAll());
    }

    public function tambahPasien()
    {
        $dataSkor = $this->skorModel->where('noRm', $this->request->getPost("noRm"))->findAll();
        if (empty($dataSkor)) {
            $data = [
                "noRm" => $this->request->getPost("noRm"),
                "i" => '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0',
                "ii" => '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0',
                "iii" => '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0',
                "iiii" => '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0'
            ];

            $this->skorModel->save($data);
        }


        echo json_encode("");
    }

    public function hapusPasien()
    {
        $this->skorModel->where("noRm", $this->request->getPost("noRm"))->delete();
        echo json_encode("");
    }

    public function muatSkor()
    {
        $noRm = $this->request->getPost("noRm");

        $dataSkor = $this->skorModel->where('noRm', $noRm)->findAll();

        echo json_encode($dataSkor);
    }

    public function ubahSkor()
    {
        $noRm = $this->request->getPost("noRm");
        $data = [
            "i" => $this->request->getPost("i"),
            "ii" => $this->request->getPost("ii"),
            "iii" => $this->request->getPost("iii"),
            "iiii" => $this->request->getPost("iiii")
        ];

        $this->skorModel->where('noRm', $noRm);
        $this->skorModel->update(null, $data);
        echo json_encode('');
    }

    public function printSkor($noRm)
    {
        $dataPasien = $this->pasienSkorpModel->where('noRm', $noRm)->findAll();
        // print_r($dataPasien[0]);
        echo view("cetakskor", $dataPasien[0]);
    }
}
