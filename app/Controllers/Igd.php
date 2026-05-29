<?php

namespace App\Controllers;

use App\Models\RegPeriksaModel;

class Igd extends BaseController
{
    protected $regPeriksaModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->regPeriksaModel = new RegPeriksaModel();
    }
    public function index()
    {
        session()->set('kembali', 'igd');
        echo view('igd');
    }

    public function muatData()
    {
        // 1. Ambil input dari request
        $tglMulai = $this->request->getPost("tglMulai");
        $tglAkhir = $this->request->getPost("tglAkhir");

        $builder = $this->regPeriksaModel->builder();

        $builder->select('
            reg_periksa.*, 
            pasien.nm_pasien, 
            poliklinik.nm_poli, 
            dokter.nm_dokter
        ');

        // Menambahkan Join
        $builder->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'left');
        $builder->join('poliklinik', 'reg_periksa.kd_poli = poliklinik.kd_poli', 'left');
        $builder->join('dokter', 'reg_periksa.kd_dokter = dokter.kd_dokter', 'left');

        // Filter Data
        $builder->where('reg_periksa.kd_poli', 'IGDK');
        $builder->where('reg_periksa.tgl_registrasi >=', $tglMulai);
        $builder->where('reg_periksa.tgl_registrasi <=', $tglAkhir);

        $dataPasien = $builder->get()->getResultArray();

        // 6. Return response JSON khas CI4
        return $this->response->setJSON($dataPasien);
    }
}
