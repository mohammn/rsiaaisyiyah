<?php

namespace App\Controllers;

use App\Models\RegPeriksaModel;
use App\Models\KamarInapModel;

class Dashboard extends BaseController
{
    protected $regPeriksaModel;
    protected $kamarInapModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }

        $this->regPeriksaModel = new RegPeriksaModel();
        $this->kamarInapModel = new KamarInapModel();
    }

    public function index()
    {
        $data = [];

        $tglHariIni = date('Y-m-d');
        $tglKemarin = date('Y-m-d', strtotime("-1 days"));

        $data["pasienRajalHariIni"] = $this->regPeriksaModel->where('tgl_registrasi', $tglHariIni)->where('status_lanjut', 'Ralan')->countAllResults();
        $data["pasienRajalKemarin"] = $this->regPeriksaModel->where('tgl_registrasi', $tglKemarin)->where('status_lanjut', 'Ralan')->countAllResults();

        $data["pasienRanapHariIni"] = $this->kamarInapModel->where('tgl_masuk <=', $tglHariIni)->where('tgl_keluar >=', $tglHariIni)->countAllResults();
        $data["pasienRanapKemarin"] = $this->kamarInapModel->where('tgl_masuk <=', $tglKemarin)->where('tgl_keluar >=', $tglKemarin)->countAllResults();


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

        if ($jenis = "Ralan") {
            for ($i = $index + 1; $i < 12; $i++) {
                $jumlahPasien[] = $this->regPeriksaModel->where('tgl_registrasi >=', ($tahunSekarang - 1) . "-" . ($i + 1) . "-01")->where('tgl_registrasi <=', ($tahunSekarang - 1) . "-" . ($i + 1)  . "-31")->where('status_lanjut', $jenis)->countAllResults();
            }
            for ($i = 0; $i < $index + 1; $i++) {
                $jumlahPasien[] = $this->regPeriksaModel->where('tgl_registrasi >=', $tahunSekarang . "-" . ($i + 1) . "-01")->where('tgl_registrasi <=', $tahunSekarang . "-" . ($i + 1) . "-31")->where('status_lanjut', $jenis)->countAllResults();
            }
        } else {
            for ($i = $index + 1; $i < 12; $i++) {
                $jumlahPasien[] = $this->kamarInapModel->where('tgl_masuk >=', ($tahunSekarang - 1) . "-" . ($i + 1) . "-01")->where('tgl_registrasi <=', ($tahunSekarang - 1) . "-" . ($i + 1)  . "-31")->countAllResults();
            }
            for ($i = 0; $i < $index + 1; $i++) {
                $jumlahPasien[] = $this->kamarInapModel->where('tgl_masuk >=', $tahunSekarang . "-" . ($i + 1) . "-01")->where('tgl_registrasi <=', $tahunSekarang . "-" . ($i + 1) . "-31")->countAllResults();
            }
        }


        $hasil = [
            "bulan" => $urutanBulan,
            "total" => $jumlahPasien
        ];

        echo json_encode($hasil);
    }
}
