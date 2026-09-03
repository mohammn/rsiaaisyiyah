<?php

namespace App\Controllers\Jenis;


use App\Controllers\BaseController;

use App\Models\RegPeriksaModel;
use App\Models\ObatPulangModel;
use App\Models\RekonsiliasiObatModel;
use App\Models\RekonsiliasiObatDataModel;
use App\Models\Rm20bUddsModel;
use App\Models\Rm20bUddsDataModel;
use App\Models\LukaOperasiModel;
use App\Models\Rm27cPlebitisModel;
use App\Models\Rm27bKateterModel;


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
        $this->lukaOperasiModel = new LukaOperasiModel();
        $this->rm27cPlebitisModel = new Rm27cPlebitisModel();
        $this->rm27bKateterModel = new Rm27bKateterModel();
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
        $lukaOperasi = $this->lukaOperasiModel->where('noRm', $pasien['no_rkm_medis'])->findAll();
        $rm27cPlebitis = $this->rm27cPlebitisModel->where('noRawat', $noRawat)->first();
        $rm27bKateter = $this->rm27bKateterModel->where('noRawat', $noRawat)->first();

        $pengecualianLukaOperasi = ['tglKrs', 'tglKontrol', 'tglMrsTindakan', 'gulaDarah', 'skintest', 'hasilMrsa', 'isiDisinfeksiKulitLainnya', 'antibiotikDosis', 'antibiotikJam', 'antibiotikObat', 'implantJenis', 'drainJenis', 'isiprosedurOperasiLainnya', 'isiprosedurOperasiLainnya2', 'skintestHasil', 'profilaksisDosis', 'profilaksisJam', 'profilaksisObat', 'isipenyakitInfeksiLainnya', 'isiKualifikasiLainnya', 'isiSteroid', 'isiPenyakitLainnya', 'persiapanUsusDg', 'isiAntibiotik', 'tgl', 'rawatLuka', 'transparan', 'thypafix', 'drainTindakan', 'aff', 'angkat', 'antibiotikTindakan', 'krs', 'kontrol', 'mrs', 'nyeri', 'demam', 'kemerahan', 'drainase', 'bengkak', 'kuman', 'ada', 'diagnosa', 'ketRawatLuka', 'ketTransparan', 'ketThypafix', 'ketDrain', 'ketAff', 'ketAngkat', 'ketAntibiotik', 'ketKrs', 'ketKontrol', 'ketMrs', 'ketNyeri', 'ketDemam', 'ketKemerahan', 'ketDrainase', 'ketBengkak', 'ketKuman', 'ketAda', 'ketDiagnosa', 'buangCairan', 'affDrain', 'jenisLokasi', 'lokasiSpesifik', 'isiLokasiSpesifikLainnya'];
        for ($i = 1; $i <= 31; $i++) {
            $pengecualianLukaOperasi[] = 'petugas' . $i;
        }

        $statusLukaOperasi = [];
        for ($i = 0; $i < count($lukaOperasi); $i++) {
            $statusLukaOperasi[$i] = $this->cekSemuaKolom($lukaOperasi[$i], $pengecualianLukaOperasi);
        }

        $pengecualianRm27cPlebitis = ['isilokasiPemasanganLainnya', 'isigolObatLainnya', 'isiivCath'];
        for ($i = 1; $i <= 10; $i++) {
            $pengecualianRm27cPlebitis[] = 'petugas' . $i;
            $pengecualianRm27cPlebitis[] = 'tgl' . $i;
        }
        for ($i = 1; $i <= 17; $i++) {
            $pengecualianRm27cPlebitis[] = 'ket' . $i;
            $pengecualianRm27cPlebitis[] = 'c' . $i;
        }
        $pengecualianRm27bKateter = ['isiJenisCath', 'isiivCath'];
        for ($i = 1; $i <= 10; $i++) {
            $pengecualianRm27bKateter[] = 'petugas' . $i;
            $pengecualianRm27bKateter[] = 'tgl' . $i;
        }

        // Auto-generate ket1 sampai ket17 dan c1 sampai c17
        for ($i = 1; $i <= 19; $i++) {
            $pengecualianRm27bKateter[] = 'ket' . $i;
            $pengecualianRm27bKateter[] = 'c' . $i; // <-- TAMBAHAN: Menyisipkan field c1 sampai c17
        }

        $status = [
            "obatPulang" => $this->cekSemuaKolom($obatPulang, ['ttdWali']),
            "rekonsiliasiObat" => $this->statusRekonsiliasiObat($rekonsiliasiObat, $rekonsiliasiObatData),
            "rm20bUdds" => (!empty($rm20bUddsData) && count((array)$rm20bUddsData) > 0) ? $this->cekSemuaKolom($rm20bUdds, []) : ['Tidak Lengkap', ['Data belum terisi']],
            "lukaOperasi" => $statusLukaOperasi,
            "rm27cPlebitis" => $this->cekSemuaKolom($rm27cPlebitis, $pengecualianRm27cPlebitis),
            "rm27bKateter" => $this->cekSemuaKolom($rm27bKateter, $pengecualianRm27bKateter),

        ];

        $data = (object) [
            'pasien'     => $pasien,
            'obatPulang'  => $obatPulang,
            'rekonsiliasiObat'  => $rekonsiliasiObat,    // Biarkan null jika data tidak ada
            'rm20bUdds'  => $rm20bUdds,    // Biarkan null jika data tidak ada
            'lukaOperasi'  => $lukaOperasi,    // Biarkan null jika data tidak ada
            'rm27cPlebitis'  => $rm27cPlebitis,    // Biarkan null jika data tidak ada
            'rm27bKateter'  => $rm27bKateter,    // Biarkan null jika data tidak ada
            'status'  => $status    // Biarkan null jika data tidak ada
        ];

        return view('jenis/farmasi', ['data' => $data]);
    }
}
