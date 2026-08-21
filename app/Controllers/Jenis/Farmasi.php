<?php

namespace App\Controllers\Jenis;


use App\Controllers\BaseController;

use App\Models\RegPeriksaModel;
use App\Models\ObatPulangModel;


class Farmasi extends BaseController
{
    protected $regPeriksaModel;
    protected $obatPulangModel;


    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->obatPulangModel = new ObatPulangModel();
    }
    public function index($noRawat)
    {
        $noRawat = str_replace('-', '/', $noRawat);
        $pasien = $this->regPeriksaModel
            ->select('
                reg_periksa.no_rawat, 
                reg_periksa.no_rkm_medis, 
                pasien.nm_pasien, 
                pasien.alamat, 
                pasien.no_tlp, 
                pasien.no_ktp, 
                pasien.jk, 
                pasien.tgl_lahir
            ')
            ->join('pasien', 'pasien.no_rkm_medis = reg_periksa.no_rkm_medis', 'left')
            ->where('reg_periksa.no_rawat', $noRawat)
            ->first();



        $data = (object) [
            'pasien'     => $pasien,
        ];

        $obatPulang = $this->obatPulangModel->where('noRawat', $noRawat)->first();

        $status = [
            "obatPulang" => $this->cekSemuaKolom($obatPulang, ['ttdWali']),
        ];

        $data = (object) [
            'pasien'     => $pasien,
            'obatPulang'  => $obatPulang,
            'status'  => $status    // Biarkan null jika data tidak ada
        ];

        return view('jenis/farmasi', ['data' => $data]);
    }
}
