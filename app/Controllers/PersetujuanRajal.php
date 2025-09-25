<?php

namespace App\Controllers;

use App\Models\PasienModel;
use App\Models\PersetujuanRajalModel;
use App\Models\PasienPersRajalModel;

class PersetujuanRajal extends BaseController
{
    public function __construct()
    {
        $this->pasienModel = new PasienModel();
        $this->persetujuanRajalModel = new PersetujuanRajalModel();
        $this->pasienPersRajalModel = new PasienPersRajalModel();
    }

    public function index()
    {
        if (!session()->get('nama')) {
            return redirect()->to(base_url() . "login");
        }

        echo view('persetujuanRajal');
    }

    public function muatDataPasien()
    {
        echo json_encode($this->pasienPersRajalModel->findAll());
    }

    public function muatTambahPasien()
    {
        echo json_encode($this->pasienModel->findAll());
    }

    public function editPasien()
    {
        $noRm = $this->request->getPost("noRm");
        $data = [
            "keluarga" => $this->request->getPost("namaKeluarga"),
            "noHp" => $this->request->getPost("noTelp")
        ];

        $this->persetujuanRajalModel->where('noRm', $noRm);
        $this->persetujuanRajalModel->update(null, $data);
        echo json_encode('');
    }

    public function tambahPasien()
    {
        $dataPersRajal = $this->persetujuanRajalModel->where('noRm', $this->request->getPost("noRm"))->findAll();
        if (empty($dataPersRajal)) {
            $data = [
                "noRm" => $this->request->getPost("noRm"),
                "nama" => $this->request->getPost("namaWali"),
                "noHp" => $this->request->getPost("noTelp"),
                "alamat" => $this->request->getPost("alamat"),
                "sebagai" => $this->request->getPost("sebagai"),
                "petugas" => $this->request->getPost("petugas"),
                "saksi" => $this->request->getPost("saksi"),
                "keluarga" => $this->request->getPost("namaKeluarga"),
                "pembayaran" => $this->request->getPost("pembayaran"),
                "selesai" => '0'
            ];

            $this->persetujuanRajalModel->save($data);
        }


        echo json_encode("");
    }

    public function hapusPasien()
    {
        $this->persetujuanRajalModel->where("noRm", $this->request->getPost("noRm"))->delete();
        echo json_encode("");
    }


    public function cetakPersRajal($noRm)
    {
        $dataPasien = $this->pasienPersRajalModel->where('noRm', $noRm)->findAll();
        $pasien = $this->persetujuanRajalModel->where('noRm', $noRm)->findAll();

        $dataPasien[0]["ttdWali"] = $pasien[0]["ttdWali"];
        $dataPasien[0]["ttdSaksi"] = $pasien[0]["ttdSaksi"];

        $dataPasien[0]["tglinput"] = $this->formatTanggalIndonesia($dataPasien[0]["tglinput"]);

        echo view("cetakPersRajal", $dataPasien[0]);

        // Load the view file and get its HTML content

    }

    public function simpanTtd()
    {
        $noRm = $this->request->getPost("noRm");
        $ttdSaksi = $this->request->getPost("ttdSaksi");
        $ttdWali = $this->request->getPost("ttdWali");

        $data = [
            "ttdSaksi" => $ttdSaksi,
            "ttdWali" => $ttdWali,
            "selesai" => "1"
        ];

        $this->persetujuanRajalModel->where('noRm', $noRm);
        $this->persetujuanRajalModel->update(null, $data);

        echo json_encode("");
    }

    function formatTanggalIndonesia($tanggalInput)
    {
        $bulan = [
            1 => "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];

        // Ubah input ke timestamp
        $timestamp = strtotime($tanggalInput);

        $hari = date("j", $timestamp);
        $bulanNama = $bulan[(int)date("n", $timestamp)];
        $tahun = date("Y", $timestamp);

        return $hari . " " . $bulanNama . " " . $tahun;
    }
}
