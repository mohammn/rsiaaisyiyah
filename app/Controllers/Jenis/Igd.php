<?php

namespace App\Controllers\Jenis;

use App\Controllers\BaseController;
use App\Models\RegPeriksaModel;
use App\Models\DpjpModel;
use App\Models\HivModel;
use App\Models\TbAnakModel;
use App\Models\TbIbuModel;
use App\Models\Rm26jRujukanLuarModel;
use App\Models\Rm7bPengkajianModel;


use function PHPSTORM_META\type;

class Igd extends BaseController
{
    protected $regPeriksaModel;
    protected $dpjpModel;
    protected $hivModel;
    protected $tbAnakModel;
    protected $tbIbuModel;
    protected $rm26jRujukanLuarModel;
    protected $rm7bPengkajianModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->dpjpModel = new DpjpModel();
        $this->hivModel = new HivModel();
        $this->tbAnakModel = new TbAnakModel();
        $this->tbIbuModel = new TbIbuModel();
        $this->rm26jRujukanLuarModel = new Rm26jRujukanLuarModel();
        $this->rm7bPengkajianModel = new Rm7bPengkajianModel();
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


        $dpjp = $this->dpjpModel->where('noRawat', $noRawat)->first();
        $hiv = $this->hivModel->where('noRawat', $noRawat)->first();
        $tbAnak = $this->tbAnakModel->where('noRawat', $noRawat)->first();
        $tbIbu = $this->tbIbuModel->where('noRawat', $noRawat)->first();
        $rm26jRujukanLuar = $this->rm26jRujukanLuarModel->where('noRawat', $noRawat)->first();
        $rm7bPengkajian = $this->rm7bPengkajianModel->where('noRawat', $noRawat)->first();

        $status = [
            "dpjp" => $this->cekSemuaKolom($dpjp, ['ttdWali']),
            "hiv" => $this->cekSemuaKolom($hiv, ['periodeJendelaTgl', 'tglTesHiv', 'jenisTes', 'hasilTesR1', 'reagenR1', 'hasilTesR2', 'reagenR2', 'hasilTesR3', 'reagenR3', 'kesimpulanTes', 'noPdp', 'tglPdp', 'tindakLanjut', 'isiLsm', 'reagenR1', 'reagenR2', 'reagenR3', 'jenisKonselingKts', 'jenisPetugasPendukung', 'jumlahAnak', 'umurAnakTerakhir', 'jenisPs', 'lamanya', 'pasanganTetap', 'pasanganPerempuan', 'pasanganHamil', 'tglLahirPasangan', 'tglTesPasangan', 'hasilTesPasangan', 'isiAlasanTesLainnya', 'hubVagTgl', 'hubAnalTgl', 'gantianSuntikTgl', 'transfusiDarahTgl', 'transmisiIbuTgl', 'isiLainnya', 'isiLainnyaTgl', 'pernahTesDmn', 'pernahTesTgl', 'hasilTesSebelumnya', 'pernahTesDmn2', 'pernahTesTgl2', 'hasilTesSebelumnya2', 'isiImsLainnya', 'isiPenyakitLainnya', 'isiRujukKe', 'isiRujukKonseling']),
            "tbAnak" => $this->cekSemuaKolom($tbAnak, ['ttdWali', 'jenisKontak', 'isiJenisKontakLainnya', 'indeksTbc', 'jenisTbc', 'tglBerobatTbc', 'tglWbp', 'statusWbp', 'durasiBatuk', 'fasyankes']),
            "tbIbu" => $this->cekSemuaKolom($tbIbu, ['ttdWali', 'imt', 'jenisKontak', 'isiJenisKontakLainnya', 'indeksTbc', 'jenisTbc', 'tglBerobatTbc', 'tglWbp', 'statusWbp', 'durasiBatuk', 'fasyankes']),
            "rm26jRujukanLuar" => $this->cekSemuaKolom($rm26jRujukanLuar, ['ttdWali', 'isiHandOverLainLain', 'alasanKeterangan']),
            "rm7bPengkajian" => $this->cekSemuaKolom($rm7bPengkajian, ['ttdPetugas']),
        ];

        $data = (object) [
            'pasien'     => $pasien,
            'dpjp'  => $dpjp,    // Biarkan null jika data tidak ada
            'hiv'  => $hiv,    // Biarkan null jika data tidak ada
            'tbAnak'  => $tbAnak,    // Biarkan null jika data tidak ada
            'tbIbu'  => $tbIbu,    // Biarkan null jika data tidak ada
            'rm26jRujukanLuar'  => $rm26jRujukanLuar,    // Biarkan null jika data tidak ada
            'rm7bPengkajian'  => $rm7bPengkajian,    // Biarkan null jika data tidak ada
            'status'  => $status    // Biarkan null jika data tidak ada
        ];

        return view('jenis/igd', ['data' => $data]);
    }
}
