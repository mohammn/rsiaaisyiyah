<?php

namespace App\Controllers\Jenis;

use App\Controllers\BaseController;
use App\Models\RegPeriksaModel;

use App\Models\Rm26ePendapatLainModel;
use App\Models\Rm26nIzinKeluarModel;
use App\Models\Rm26fKerohanianModel;
use App\Models\Rm26hKepercayaanModel;
use App\Models\Rm26iPeyimpananBarangModel;
use App\Models\Rm26iPeyimpananBarangDataModel;



use function PHPSTORM_META\type;

class Lain extends BaseController
{
    protected $regPeriksaModel;

    protected $rm26ePendapatLainModel;
    protected $rm26nIzinKeluarModel;
    protected $rm26fKerohanianModel;
    protected $rm26hKepercayaanModel;
    protected $rm26iPenyimpananBarangModel;
    protected $rm26iPenyimpananBarangDataModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->rm26ePendapatLainModel = new Rm26ePendapatLainModel();
        $this->rm26nIzinKeluarModel = new Rm26nIzinKeluarModel();
        $this->rm26fKerohanianModel = new Rm26fKerohanianModel();
        $this->rm26hKepercayaanModel = new Rm26hKepercayaanModel();
        $this->rm26iPenyimpananBarangModel = new Rm26iPeyimpananBarangModel();
        $this->rm26iPenyimpananBarangDataModel = new Rm26iPeyimpananBarangDataModel();
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

        $rm26ePendapatLain = $this->rm26ePendapatLainModel->where('noRawat', $noRawat)->first();
        $rm26nIzinKeluar = $this->rm26nIzinKeluarModel->where('noRawat', $noRawat)->first();
        $rm26fKerohanian = $this->rm26fKerohanianModel->where('noRawat', $noRawat)->first();
        $rm26hKepercayaan = $this->rm26hKepercayaanModel->where('noRawat', $noRawat)->first();
        $rm26iPenyimpananBarang = $this->rm26iPenyimpananBarangModel->where('noRawat', $noRawat)->first();
        $rm26iPenyimpananBarangData = $this->rm26iPenyimpananBarangDataModel->where('idPenyimpanan', $rm26iPenyimpananBarang['id'] ?? 0)->first();

        $status = [
            "rm26ePendapatLain" => $this->cekSemuaKolom($rm26ePendapatLain, ['ttdWali']),
            "rm26nIzinKeluar" => $this->cekSemuaKolom($rm26nIzinKeluar, ['ttdWali']),
            "rm26fKerohanian" => $this->cekSemuaKolom($rm26fKerohanian, ['ttdWali']),
            "rm26hKepercayaan" => $this->cekSemuaKolom($rm26hKepercayaan, ['ttdWali']),
            "rm26iPenyimpananBarang" => (!empty($rm26iPenyimpananBarangData) && count((array)$rm26iPenyimpananBarangData) > 0) ? $this->cekSemuaKolom($rm26iPenyimpananBarang, ['ttdWali']) : ['Tidak Lengkap', ['Data belum diisi']],
        ];

        $data = (object) [
            'pasien'     => $pasien,
            'rm26ePendapatLain'  => $rm26ePendapatLain,    // Biarkan null jika data tidak ada
            'rm26nIzinKeluar'  => $rm26nIzinKeluar,    // Biarkan null jika data tidak ada
            'rm26fKerohanian'  => $rm26fKerohanian,    // Biarkan null jika data tidak ada
            'rm26hKepercayaan'  => $rm26hKepercayaan,    // Biarkan null jika data tidak ada
            'rm26iPenyimpananBarang'  => $rm26iPenyimpananBarang,    // Biarkan null jika data tidak ada

            'status'  => $status    // Biarkan null jika data tidak ada
        ];

        return view('jenis/lain', ['data' => $data]);
    }
}
