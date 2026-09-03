<?php

namespace App\Controllers\Jenis;

use App\Controllers\BaseController;
use App\Models\RegPeriksaModel;

use App\Models\PersetujuanRajalModel;
use App\Models\PersetujuanRanapModel;
use App\Models\IcGeneralModel;
use App\Models\IcDarahModel;
use App\Models\IcSesarModel;
use App\Models\IcPembiusanModel;
use App\Models\IcPembiusanLokalModel;
use App\Models\LembarEdukasiModel;
use App\Models\Rm3TataTertibModel;
use App\Models\Rm4PermintaanMasukModel;


use function PHPSTORM_META\type;

class General extends BaseController
{
    protected $regPeriksaModel;

    protected $persRajalModel;
    protected $persetujuanRanapModel;
    protected $icGeneralModel;
    protected $icDarahModel;
    protected $icSesarModel;
    protected $icPembiusanModel;
    protected $icPembiusanLokalModel;
    protected $lembarEdukasiModel;
    protected $rm3TataTertibModel;
    protected $rm4PermintaanMasukModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->regPeriksaModel = new RegPeriksaModel();

        $this->persRajalModel = new PersetujuanRajalModel();
        $this->persetujuanRanapModel = new PersetujuanRanapModel();
        $this->icGeneralModel = new IcGeneralModel();
        $this->icDarahModel = new IcDarahModel();
        $this->icSesarModel = new IcSesarModel();
        $this->icPembiusanModel = new IcPembiusanModel();
        $this->icPembiusanLokalModel = new IcPembiusanLokalModel();
        $this->lembarEdukasiModel = new LembarEdukasiModel();
        $this->rm3TataTertibModel = new Rm3TataTertibModel();
        $this->rm4PermintaanMasukModel = new Rm4PermintaanMasukModel();
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

        $persRajal = $this->persRajalModel->where('noRm', $pasien['no_rkm_medis'])->first();
        $persetujuanRanap = $this->persetujuanRanapModel->where('noRawat', $noRawat)->first();
        $icGeneral = $this->icGeneralModel->where('noRawat', $noRawat)->findAll();
        $icDarah = $this->icDarahModel->where('noRawat', $noRawat)->first();
        $icSesar = $this->icSesarModel->where('noRawat', $noRawat)->first();
        $icPembiusan = $this->icPembiusanModel->where('noRawat', $noRawat)->first();
        $icPembiusanLokal = $this->icPembiusanLokalModel->where('noRawat', $noRawat)->first();
        $lembarEdukasi = $this->lembarEdukasiModel->where('noRawat', $noRawat)->first();
        $rm3TataTertib = $this->rm3TataTertibModel->where('noRawat', $noRawat)->first();
        $rm4PermintaanMasuk = $this->rm4PermintaanMasukModel->where('noRawat', $noRawat)->first();

        $statusIcGeneral = [];
        for ($i = 0; $i < count($icGeneral); $i++) {
            $statusIcGeneral[$i] = $this->cekSemuaKolom($icGeneral[$i], ['ttdWali', 'ttdSaksi']);
        }
        $pengecualianLembarEdukasi = ['ttd_1', 'ttd_2', 'ttd_3', 'ttd_4', 'ttd_5', 'ttd_6', 'ttd_7', 'ttd_8', 'ttdWali', 'lainnya_1', 'lainnya_2', 'lainnya_3', 'lainnya_4', 'lainnya_5', 'lainnya_6', 'lainnya_7', 'lainnya_8', 'tgl_8', 'metode_8', 'evaluasi_8', 'media_8', 'petugas_8', 'wali_8'];
        $pengecualianIcPembiusan = ['isiKombinasi', 'tataCara', 'tujuan', 'komplikasi', 'risiko', 'alternatif', 'ttdWali', 'ttdSaksi'];
        if ($icPembiusan) {
            if ($icPembiusan['jenisAnestesi'] === "Blok Syaraf Perifer" or $icPembiusan['jenisAnestesi'] === "Anestesi Umum") {
                unset($pengecualianIcPembiusan['alternatif']);
            } elseif ($icPembiusan['jenisAnestesi'] === "kombinasi") {
                $pengecualianIcPembiusan = ['ttdWali', 'ttdSaksi'];
            }
        }


        $status = [
            "persRajal" => $this->cekSemuaKolom($persRajal, ['selesai', 'ttdWali', 'ttdSaksi']),
            "persetujuanRanap" => $this->cekSemuaKolom($persetujuanRanap, ['ttdWali', 'ttdSaksi', 'isi_kecuali', 'status_asuransi_umum', 'kelas_umum', 'kelas_umum_lain_text', 'biaya_min', 'biaya_max', 'no_bpjs', 'bpjs_status_kelas', 'bpjs_naik_tingkat', 'nama_asuransi_lain']),
            "icGeneral" => $statusIcGeneral,
            "icDarah" => $this->cekSemuaKolom($icDarah, ['ttdWali', 'ttdSaksi', 'lainLain']),
            "icSesar" => $this->cekSemuaKolom($icSesar, ['ttdWali', 'ttdSaksi', 'indikasiIbu', 'indikasiJanin', 'indikasiJaninLainnya', 'indikasiIbuLainnya']),
            "icPembiusan" => $this->cekSemuaKolom($icPembiusan, $pengecualianIcPembiusan),
            "icPembiusanLokal" => $this->cekSemuaKolom($icPembiusanLokal, ['ttdWali', 'ttdSaksi']),
            "lembarEdukasi" => $this->cekSemuaKolom($lembarEdukasi, $pengecualianLembarEdukasi),
            "rm3TataTertib" => $this->cekSemuaKolom($rm3TataTertib, ['ttdWali']),
            "rm4PermintaanMasuk" => $this->cekSemuaKolom($rm4PermintaanMasuk, ['ttdWali', 'ttdDokter', 'ttdPetugas', 'nama', 'isiBiayaLain']),
        ];

        $data = (object) [
            'pasien'     => $pasien,
            'persRajal'  => $persRajal,    // Biarkan null jika data tidak ada
            'persetujuanRanap'  => $persetujuanRanap,    // Biarkan null jika data tidak ada
            'icGeneral'  => $icGeneral,    // Biarkan null jika data tidak ada
            'icDarah'  => $icDarah,    // Biarkan null jika data tidak ada
            'icSesar'  => $icSesar,    // Biarkan null jika data tidak ada
            'icPembiusan'  => $icPembiusan,    // Biarkan null jika data tidak ada
            'icPembiusanLokal'  => $icPembiusanLokal,    // Biarkan null jika data tidak ada
            'lembarEdukasi'  => $lembarEdukasi,    // Biarkan null jika data tidak ada
            'rm3TataTertib'  => $rm3TataTertib,    // Biarkan null jika data tidak ada
            'rm4PermintaanMasuk'  => $rm4PermintaanMasuk,    // Biarkan null jika data tidak ada
            'status'  => $status    // Biarkan null jika data tidak ada
        ];

        return view('jenis/general', ['data' => $data]);
    }
}
