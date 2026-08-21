<?php

namespace App\Controllers\Jenis;

use App\Controllers\BaseController;
use App\Models\RegPeriksaModel;

use App\Models\Rm11b1ChecklistModel;
use App\Models\Rm11a1BedahModel;
use App\Models\Rm11a2TimbangModel;

use function PHPSTORM_META\type;

class Operasi extends BaseController
{
    protected $regPeriksaModel;
    protected $rm11B1ChecklistModel;
    protected $rm11a1BedahModel;
    protected $rm11a2TimbangModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->rm11B1ChecklistModel = new Rm11b1ChecklistModel();
        $this->rm11a1BedahModel = new Rm11a1BedahModel();
        $this->rm11a2TimbangModel = new Rm11a2TimbangModel();
    }

    public function index($noRawat)
    {
        $noRawat = str_replace('-', '/', $noRawat);

        $rm11B1Checklist = $this->rm11B1ChecklistModel->where('noRawat', $noRawat)->first();
        $rm11a1Bedah = $this->rm11a1BedahModel->where('noRawat', $noRawat)->first();
        $rm11a2Timbang = $this->rm11a2TimbangModel->where('noRawat', $noRawat)->first();

        $status = [
            "rm11b1Checklist" => $this->cekSemuaKolom($rm11B1Checklist, ['isiAlergi', 'isiKelengkapanLainnya', 'isijenisLainnya', 'profilaksisObat', 'profilaksisJam', 'profilaksisDosis', 'ttdPerawatAnestesi', 'ttdDokterAnestesi1', 'ttdSirkuler', 'ttdInstrumen', 'ttdAsisten', 'ttdOperator', 'ttdDokterAnestesi2']),
            "rm11a1Bedah" => $this->cekSemuaKolom($rm11a1Bedah, ['isiRiwayatLainnya', 'jenisOperasi', 'lokasiOperasi', 'tglOperasi', 'isiAlergi', 'isidiagnosaLain', 'isiElektif', 'isiMulaiJam', 'isiKonsultasi', 'isiPeralatanLain', 'isiWholeBlood', 'isiPackedRed', 'isiKomponenLain', 'catatan', 'ttdWali', 'badan', 'kepalaSamping', 'kepala', 'telapakTangan', 'kaki', 'punggungTangan']),
            "rm11a2Timbang" => $this->cekSemuaKolom($rm11a2Timbang, ['ttdPengantar', 'ttdPenerima', 'ttdPengantar2', 'ttdPenerima2', 'rpd', 'isiRpdLainnya', 'rpd2', 'isiRpdLainnya2', 'isiAlergi', 'isiAlergi2', 'jumlahDarah', 'jumlahDarah2', 'tglTranfusi', 'jenisTranfusi', 'golTranfusi', 'jumlahTranfusi', 'tglTranfusi2', 'jenisTranfusi2', 'golTranfusi2', 'jumlahTranfusi2', 'isiLabJml', 'isiLabJml2', 'isiFotoJml', 'isiFotoJml2', 'isiFotoLainnya', 'isiFotoLainnya2', 'isiPuasaJam', 'isiLavementKet', 'isiPuasaJam2', 'isiLavementKet2', 'isiGigiDibawaOleh', 'isiGigiDibawaOleh2', 'isiKesadaranLain', 'isiKesadaranLain2',]),
        ];

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
            'rm11b1Checklist'  => $rm11B1Checklist,    // Biarkan null jika data tidak ada
            'rm11a1Bedah'  => $rm11a1Bedah,    // Biarkan null jika data tidak ada
            'rm11a2Timbang'  => $rm11a2Timbang,    // Biarkan null jika data tidak ada
            'status'  => $status    // Biarkan null jika data tidak ada
        ];

        return view('jenis/operasi', ['data' => $data]);
    }
}
