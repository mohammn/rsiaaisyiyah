<?php

namespace App\Controllers\Jenis;


use App\Controllers\BaseController;

use App\Models\RegPeriksaModel;
use App\Models\ObatPulangModel;
use App\Models\RekonsiliasiObatModel;
use App\Models\RekonsiliasiObatDataModel;
use App\Models\Rm20bUddsModel;
use App\Models\Rm20bUddsDataModel;

class Farmasi extends BaseController
{
    protected $regPeriksaModel;
    protected $obatPulangModel;
    protected $rekonsiliasiObatModel;
    protected $rekonsiliasiObatDataModel;
    protected $rm20bUddsModel;
    protected $rm20bUddsDataModel;
    protected $lukaOperasiModel;
    protected $rm27cPlebitisModel;
    protected $rm27bKateterModel;


    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->obatPulangModel = new ObatPulangModel();
        $this->rekonsiliasiObatModel = new RekonsiliasiObatModel();
        $this->rekonsiliasiObatDataModel = new RekonsiliasiObatDataModel();
        $this->rm20bUddsModel = new Rm20bUddsModel();
        $this->rm20bUddsDataModel = new Rm20bUddsDataModel();
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

        $obatPulang = $this->obatPulangModel->where('noRawat', $noRawat)->first();
        $rekonsiliasiObat = $this->rekonsiliasiObatModel->where('noRawat', $noRawat)->first();
        $rekonsiliasiObatData = $this->rekonsiliasiObatDataModel->where('noRawat', $noRawat)->first();
        $rm20bUdds = $this->rm20bUddsModel->where('noRawat', $noRawat)->first();
        $rm20bUddsData = $this->rm20bUddsDataModel->where('idUdds', ($rm20bUdds['id'] ?? 0))->first();

        $status = [
            "obatPulang" => $this->cekSemuaKolom($obatPulang, ['ttdWali']),
            "rekonsiliasiObat" => $this->statusRekonsiliasiObat($rekonsiliasiObat, $rekonsiliasiObatData),
            "rm20bUdds" => (!empty($rm20bUddsData) && count((array)$rm20bUddsData) > 0) ? $this->cekSemuaKolom($rm20bUdds, []) : ['Tidak Lengkap', ['Data belum terisi']],
        ];

        $data = (object) [
            'pasien'     => $pasien,
            'obatPulang'  => $obatPulang,
            'rekonsiliasiObat'  => $rekonsiliasiObat,    // Biarkan null jika data tidak ada
            'rm20bUdds'  => $rm20bUdds,    // Biarkan null jika data tidak ada
            'status'  => $status    // Biarkan null jika data tidak ada
        ];

        return view('jenis/farmasi', ['data' => $data]);
    }
}
