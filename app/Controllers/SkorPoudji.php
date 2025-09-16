<?php

namespace App\Controllers;

use App\Models\PasienModel;
use App\Models\SkorModel;

class SkorPoudji extends BaseController
{
    public function __construct()
    {
        $this->pasienModel = new PasienModel();
        $this->skorModel = new SkorModel();
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
        echo json_encode($this->pasienModel->findAll());
    }

    public function muatPasien()
    {
        echo json_encode($this->pasienModel->where('id', $this->request->getPost("idPasien"))->findAll());
    }

    public function tambahPasien()
    {
        $data = [
            "noRm" => $this->request->getPost("noRm"),
            "nik" => $this->request->getPost("nik"),
            "nama" => $this->request->getPost("nama"),
            "alamat" => $this->request->getPost("alamat"),
            "tanggalLahir" => $this->request->getPost("tglLahir"),
            "status" => $this->request->getPost("status")
        ];

        $this->pasienModel->save($data);

        echo json_encode("");
    }

    public function editPasien()
    {
        $data = [
            "noRm" => $this->request->getPost("noRm"),
            "nik" => $this->request->getPost("nik"),
            "nama" => $this->request->getPost("nama"),
            "alamat" => $this->request->getPost("alamat"),
            "tanggalLahir" => $this->request->getPost("tglLahir"),
            "status" => $this->request->getPost("status"),
        ];

        $this->pasienModel->update($this->request->getPost("id"), $data);
        echo json_encode("");
    }

    public function hapusPasien()
    {
        $this->skorModel->where("idPasien", $this->request->getPost("id"))->delete();
        $this->pasienModel->delete($this->request->getPost("id"));
        echo json_encode("");
    }

    public function muatSkor()
    {
        $idPasien = $this->request->getPost("idPasien");
        $dataSkor = $this->skorModel->where('idPasien', $idPasien)->findAll();
        if (count($dataSkor) == 0) {
            $data = [
                "idPasien" => $idPasien,
                "i" => '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0',
                "ii" => '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0',
                "iii" => '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0',
                "iiii" => '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0'
            ];

            $this->skorModel->save($data);
        }
        $dataSkor = $this->skorModel->where('idPasien', $idPasien)->findAll();

        echo json_encode($dataSkor);
    }

    public function lihatSkor()
    {
        $idPasien = $this->request->getPost("idPasien");
        $dataSkor = $this->skorModel->where('idPasien', $idPasien)->findAll();

        echo json_encode($dataSkor);
    }

    public function ubahSkor()
    {
        $idPasien = $this->request->getPost("id");
        $data = [
            "i" => $this->request->getPost("i"),
            "ii" => $this->request->getPost("ii"),
            "iii" => $this->request->getPost("iii"),
            "iiii" => $this->request->getPost("iiii")
        ];

        $this->skorModel->where('idPasien', $idPasien);
        $this->skorModel->update(null, $data);
        echo json_encode('');
    }

    public function printSkor($idPasien)
    {
        $dataPasien = $this->pasienModel->where('id', $idPasien)->findAll();
        // print_r($dataPasien[0]);
        echo view("cetakskor", $dataPasien[0]);
    }
}
