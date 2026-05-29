<?php

namespace App\Controllers;

use App\Models\RegPeriksaModel;

class Rajal extends BaseController
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
        session()->set('kembali', 'rajal');
        echo view('rajal');
    }

    public function muatData()
    {
        // 1. Ambil input dari request
        $tglMulai = $this->request->getPost("tglMulai");
        $tglAkhir = $this->request->getPost("tglAkhir");

        $builder = $this->regPeriksaModel->builder();

        $builder->select('
            reg_periksa.no_rawat, 
            reg_periksa.no_rkm_medis, 
            pasien.nm_pasien, 
            poliklinik.nm_poli, 
            dokter.nm_dokter,
            reg_periksa.tgl_registrasi,
            reg_periksa.status_bayar,
            reg_periksa.jam_reg,
            reg_periksa.status_poli,
            reg_periksa.status_lanjut
        ');

        // Join tabel terkait
        $builder->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'left');
        $builder->join('poliklinik', 'reg_periksa.kd_poli = poliklinik.kd_poli', 'left');
        $builder->join('dokter', 'reg_periksa.kd_dokter = dokter.kd_dokter', 'left');

        // Filter sesuai permintaan Anda
        $builder->where('reg_periksa.status_lanjut', 'Ralan');
        $builder->where('reg_periksa.kd_poli !=', 'IGDK');
        $builder->where('reg_periksa.tgl_registrasi >=', $tglMulai);
        $builder->where('reg_periksa.tgl_registrasi <=', $tglAkhir);

        $dataPasien = $builder->get()->getResultArray();
        // 6. Return response JSON khas CI4
        return $this->response->setJSON($dataPasien);
    }
}
