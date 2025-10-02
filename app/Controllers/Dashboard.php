<?php

namespace App\Controllers;

use App\Models\RegPeriksaModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->regPeriksaModel = new RegPeriksaModel();
    }

    public function index()
    {
        if (!session()->get('nama')) {
            return redirect()->to(base_url() . "login");
        }
        $data = [];

        $tglHariIni = date('Y-m-d');
        $tglKemarin = date('Y-m-d', strtotime("-1 days"));

        $data["pasienRajalHariIni"] = $this->regPeriksaModel->where('tgl_registrasi', $tglHariIni)->where('status_lanjut', 'Ralan')->countAllResults();
        $data["pasienRajalKemarin"] = $this->regPeriksaModel->where('tgl_registrasi', $tglKemarin)->where('status_lanjut', 'Ralan')->countAllResults();

        $data["pasienRanapHariIni"] = $this->regPeriksaModel->where('tgl_registrasi', $tglHariIni)->where('status_lanjut', 'Ranap')->countAllResults();
        $data["pasienRanapKemarin"] = $this->regPeriksaModel->where('tgl_registrasi', $tglKemarin)->where('status_lanjut', 'Ranap')->countAllResults();


        echo view('dashboard', $data);
    }

    public function pasienPerBulan()
    {
        $jenis = $this->request->getPost("jenis");

        $bulan = [
            "Januari",
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

        $index = date("n") - 1;
        $urutanBulan = array_merge(array_slice($bulan, $index + 1), array_slice($bulan, 0, $index + 1));

        $tahunSekarang = date("Y");

        $jumlahPasien = [];

        for ($i = $index + 1; $i < 12; $i++) {
            $jumlahPasien[] = $this->regPeriksaModel->where('tgl_registrasi >=', ($tahunSekarang - 1) . "-" . ($i + 1) . "-01")->where('tgl_registrasi <=', ($tahunSekarang - 1) . "-" . ($i + 1)  . "-31")->where('status_lanjut', $jenis)->countAllResults();
        }

        for ($i = 0; $i < $index + 1; $i++) {
            $jumlahPasien[] = $this->regPeriksaModel->where('tgl_registrasi >=', $tahunSekarang . "-" . ($i + 1) . "-01")->where('tgl_registrasi <=', $tahunSekarang . "-" . ($i + 1) . "-31")->where('status_lanjut', $jenis)->countAllResults();
        }

        $hasil = [
            "bulan" => $urutanBulan,
            "total" => $jumlahPasien
        ];

        echo json_encode($hasil);
    }
}
