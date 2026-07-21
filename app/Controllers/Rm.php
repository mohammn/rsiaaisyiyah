<?php

namespace App\Controllers;

use App\Models\RegPeriksaModel;
use App\Models\SkorModel;
use App\Models\PersetujuanRajalModel;
use App\Models\DpjpModel;
use App\Models\RekonsiliasiObatModel;
use App\Models\RekonsiliasiObatDataModel;
use App\Models\IcGeneralModel;
use App\Models\IcDarahModel;
use App\Models\IcSesarModel;
use App\Models\IcPembiusanModel;
use App\Models\IcPembiusanLokalModel;
use App\Models\LembarEdukasiModel;
use App\Models\PersetujuanRanapModel;
use App\Models\LukaOperasiModel;
use App\Models\Rm27cPlebitisModel;
use App\Models\Rm27bKateterModel;
use App\Models\Rm0SbarModel;
use App\Models\Rm0SbarDataModel;
use App\Models\Rm20bUddsModel;
use App\Models\Rm20bUddsDataModel;
use App\Models\Rm3TataTertibModel;
use App\Models\Rm26ePendapatLainModel;
use App\Models\Rm26nIzinKeluarModel;
use App\Models\Rm26fKerohanianModel;
use App\Models\Rm26hKepercayaanModel;
use App\Models\Rm26iPeyimpananBarangModel;
use App\Models\Rm26iPeyimpananBarangDataModel;
use App\Models\Rm26bRujukKeluarModel;
use App\Models\Rm26bRujukKeluarDataModel;
use App\Models\HivModel;
use App\Models\Rm4PermintaanMasukModel;
use App\Models\TbAnakModel;
use App\Models\TbIbuModel;

use function PHPSTORM_META\type;

class Rm extends BaseController
{
    protected $regPeriksaModel;
    protected $skorModel;
    protected $persRajalModel;
    protected $dpjpModel;
    protected $rekonsiliasiObatModel;
    protected $rekonsiliasiObatDataModel;
    protected $icGeneralModel;
    protected $icDarahModel;
    protected $icSesarModel;
    protected $icPembiusanModel;
    protected $icPembiusanLokalModel;
    protected $lembarEdukasiModel;
    protected $persetujuanRanapModel;
    protected $lukaOperasiModel;
    protected $rm27cPlebitisModel;
    protected $rm27bKateterModel;
    protected $rm0SbarModel;
    protected $rm0SbarDataModel;
    protected $rm20bUddsModel;
    protected $rm20bUddsDataModel;
    protected $rm3TataTertibModel;
    protected $rm26ePendapatLainModel;
    protected $rm26nIzinKeluarModel;
    protected $rm26fKerohanianModel;
    protected $rm26hKepercayaanModel;
    protected $rm26iPenyimpananBarangModel;
    protected $rm26iPenyimpananBarangDataModel;
    protected $rm26bRujukKeluarModel;
    protected $rm26bRujukKeluarDataModel;
    protected $hivModel;
    protected $rm4PermintaanMasukModel;
    protected $tbAnakModel;
    protected $tbIbuModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->skorModel = new SkorModel();
        $this->persRajalModel = new PersetujuanRajalModel();
        $this->dpjpModel = new DpjpModel();
        $this->rekonsiliasiObatModel = new RekonsiliasiObatModel();
        $this->rekonsiliasiObatDataModel = new RekonsiliasiObatDataModel();
        $this->icGeneralModel = new IcGeneralModel();
        $this->icDarahModel = new IcDarahModel();
        $this->icSesarModel = new IcSesarModel();
        $this->icPembiusanModel = new IcPembiusanModel();
        $this->icPembiusanLokalModel = new IcPembiusanLokalModel();
        $this->lembarEdukasiModel = new LembarEdukasiModel();
        $this->persetujuanRanapModel = new PersetujuanRanapModel();
        $this->lukaOperasiModel = new LukaOperasiModel();
        $this->rm27cPlebitisModel = new Rm27cPlebitisModel();
        $this->rm27bKateterModel = new Rm27bKateterModel();
        $this->rm0SbarModel = new Rm0SbarModel();
        $this->rm0SbarDataModel = new Rm0SbarDataModel();
        $this->rm20bUddsModel = new Rm20bUddsModel();
        $this->rm20bUddsDataModel = new Rm20bUddsDataModel();
        $this->rm3TataTertibModel = new Rm3TataTertibModel();
        $this->rm26ePendapatLainModel = new Rm26ePendapatLainModel();
        $this->rm26nIzinKeluarModel = new Rm26nIzinKeluarModel();
        $this->rm26fKerohanianModel = new Rm26fKerohanianModel();
        $this->rm26hKepercayaanModel = new Rm26hKepercayaanModel();
        $this->rm26iPenyimpananBarangModel = new Rm26iPeyimpananBarangModel();
        $this->rm26iPenyimpananBarangDataModel = new Rm26iPeyimpananBarangDataModel();
        $this->rm26bRujukKeluarModel = new Rm26bRujukKeluarModel();
        $this->rm26bRujukKeluarDataModel = new Rm26bRujukKeluarDataModel();
        $this->hivModel = new HivModel();
        $this->rm4PermintaanMasukModel = new Rm4PermintaanMasukModel();
        $this->tbAnakModel = new TbAnakModel();
        $this->tbIbuModel = new TbIbuModel();
    }
    public function index($no_rawat)
    {
        $no_rawat = str_replace('-', '/', $no_rawat);
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
            ->where('reg_periksa.no_rawat', $no_rawat)
            ->first();

        // pengiriman dataa===============
        $skorPoudji = $this->skorModel->where('noRm', $pasien['no_rkm_medis'])->findAll();
        $persRajal = $this->persRajalModel->where('noRm', $pasien['no_rkm_medis'])->first();
        $dpjp = $this->dpjpModel->where('noRawat', $no_rawat)->first();
        $rekonsiliasiObat = $this->rekonsiliasiObatModel->where('noRawat', $no_rawat)->first();
        $rekonsiliasiObatData = $this->rekonsiliasiObatDataModel->where('noRawat', $no_rawat)->first();
        $icGeneral = $this->icGeneralModel->where('noRawat', $no_rawat)->findAll();
        $icDarah = $this->icDarahModel->where('noRawat', $no_rawat)->first();
        $icSesar = $this->icSesarModel->where('noRawat', $no_rawat)->first();
        $icPembiusan = $this->icPembiusanModel->where('noRawat', $no_rawat)->first();
        $icPembiusanLokal = $this->icPembiusanLokalModel->where('noRawat', $no_rawat)->first();
        $lembarEdukasi = $this->lembarEdukasiModel->where('noRawat', $no_rawat)->first();
        $persetujuanRanap = $this->persetujuanRanapModel->where('noRawat', $no_rawat)->first();
        $lukaOperasi = $this->lukaOperasiModel->where('noRm', $pasien['no_rkm_medis'])->findAll();
        $rm27cPlebitis = $this->rm27cPlebitisModel->where('noRawat', $no_rawat)->first();
        $rm27bKateter = $this->rm27bKateterModel->where('noRawat', $no_rawat)->first();
        $rm20bUdds = $this->rm20bUddsModel->where('noRawat', $no_rawat)->first();
        $rm20bUddsData = $this->rm20bUddsDataModel->where('idUdds', ($rm20bUdds['id'] ?? 0))->first();
        $rm3TataTertib = $this->rm3TataTertibModel->where('noRawat', $no_rawat)->first();
        $rm26ePendapatLain = $this->rm26ePendapatLainModel->where('noRawat', $no_rawat)->first();
        $rm26nIzinKeluar = $this->rm26nIzinKeluarModel->where('noRawat', $no_rawat)->first();
        $rm26fKerohanian = $this->rm26fKerohanianModel->where('noRawat', $no_rawat)->first();
        $rm26hKepercayaan = $this->rm26hKepercayaanModel->where('noRawat', $no_rawat)->first();
        $rm26iPenyimpananBarang = $this->rm26iPenyimpananBarangModel->where('noRawat', $no_rawat)->first();
        $rm26iPenyimpananBarangData = $this->rm26iPenyimpananBarangDataModel->where('idPenyimpanan', $rm26iPenyimpananBarang['id'] ?? 0)->first();
        $rm26bRujukKeluar = $this->rm26bRujukKeluarModel->where('noRawat', $no_rawat)->first();
        $rm26bRujukKeluarData = $this->rm26bRujukKeluarDataModel->where('idRujuk', $rm26bRujukKeluar['id'] ?? 0)->first();
        $hiv = $this->hivModel->where('noRawat', $no_rawat)->first();
        $rm4PermintaanMasuk = $this->rm4PermintaanMasukModel->where('noRawat', $no_rawat)->first();
        $tbAnak = $this->tbAnakModel->where('noRawat', $no_rawat)->first();
        $tbIbu = $this->tbIbuModel->where('noRawat', $no_rawat)->first();
        // ================khusus SBAR=========================
        $rm0Sbar = $this->rm0SbarModel->where('noRawat', $no_rawat)->findAll();
        $rm0SbarData = [];
        $rm0Sbar = $this->rm0SbarModel->where('noRawat', $no_rawat)->findAll();
        $rm0SbarData = [];
        for ($i = 0; $i < count($rm0Sbar); $i++) {
            // Mengambil semua data anak yang memiliki idSbar sesuai ID induk saat ini
            $rm0SbarData[] = $this->rm0SbarDataModel->where('idSbar', $rm0Sbar[$i]["id"])->findAll();
        }
        $statusRm0Sbar = [];
        for ($i = 0; $i < count($rm0SbarData); $i++) {
            $statusRm0Sbar[] = [];
            for ($j = 0; $j < count($rm0SbarData[$i]); $j++) {
                $statusRm0Sbar[$i][] = $this->cekSemuaKolom($rm0SbarData[$i][$j], ['tglVerif']);
            }
        }
        for ($i = 0; $i < count($statusRm0Sbar); $i++) {
            if (in_array("Lengkap", $statusRm0Sbar[$i])) {
                $statusRm0Sbar[$i] = 'Lengkap';
            } else {
                $statusRm0Sbar[$i] = 'Tidak Lengkap';
            }
        }

        $statusTtdRm0Sbar = [];
        for ($i = 0; $i < count($rm0SbarData); $i++) {
            $status = 'Belum';
            for ($j = 0; $j < count($rm0SbarData[$i]); $j++) {
                if ($rm0SbarData[$i][$j]["tglVerif"] && $rm0SbarData[$i][$j]["petugas"]) {
                    $status = 'Sudah';
                    break;
                }
            }
            $statusTtdRm0Sbar[] = $status;
        }


        // ================ end khusus SBAR=========================

        //===========status data=====================
        $statusSKorPoudji = [];
        for ($i = 0; $i < count($skorPoudji); $i++) {
            $statusSKorPoudji[$i] = $this->cekSemuaKolom($skorPoudji[$i]);
        }
        $statusIcGeneral = [];
        for ($i = 0; $i < count($icGeneral); $i++) {
            $statusIcGeneral[$i] = $this->cekSemuaKolom($icGeneral[$i], ['ttdWali', 'ttdSaksi']);
        }

        $pengecualianIcPembiusan = ['isiKombinasi', 'tataCara', 'tujuan', 'komplikasi', 'risiko', 'alternatif', 'ttdWali', 'ttdSaksi'];
        if ($icPembiusan) {
            if ($icPembiusan['jenisAnestesi'] === "Blok Syaraf Perifer" or $icPembiusan['jenisAnestesi'] === "Anestesi Umum") {
                unset($pengecualianIcPembiusan['alternatif']);
            } elseif ($icPembiusan['jenisAnestesi'] === "kombinasi") {
                $pengecualianIcPembiusan = ['ttdWali', 'ttdSaksi'];
            }
        }

        $pengecualianLembarEdukasi = ['ttd_1', 'ttd_2', 'ttd_3', 'ttd_4', 'ttd_5', 'ttd_6', 'ttd_7', 'ttd_8', 'ttdWali', 'lainnya_1', 'lainnya_2', 'lainnya_3', 'lainnya_4', 'lainnya_5', 'lainnya_6', 'lainnya_7', 'lainnya_8', 'tgl_8', 'metode_8', 'evaluasi_8', 'media_8', 'petugas_8', 'wali_8'];

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
            "skorPoudji" => $statusSKorPoudji,
            "persRajal" => $this->cekSemuaKolom($persRajal, ['selesai', 'ttdWali', 'ttdSaksi']),
            "dpjp" => $this->cekSemuaKolom($dpjp, ['ttdWali']),
            "rekonsiliasiObat" => $this->statusRekonsiliasiObat($rekonsiliasiObat, $rekonsiliasiObatData),
            "icGeneral" => $statusIcGeneral,
            "icDarah" => $this->cekSemuaKolom($icDarah, ['ttdWali', 'ttdSaksi', 'lainLain']),
            "icSesar" => $this->cekSemuaKolom($icSesar, ['ttdWali', 'ttdSaksi', 'indikasiIbu', 'indikasiJanin', 'indikasiJaninLainnya', 'indikasiIbuLainnya']),
            "icPembiusan" => $this->cekSemuaKolom($icPembiusan, $pengecualianIcPembiusan),
            "icPembiusanLokal" => $this->cekSemuaKolom($icPembiusanLokal, ['ttdWali', 'ttdSaksi']),
            "lembarEdukasi" => $this->cekSemuaKolom($lembarEdukasi, $pengecualianLembarEdukasi),
            "persetujuanRanap" => $this->cekSemuaKolom($persetujuanRanap, ['ttdWali', 'ttdSaksi', 'isi_kecuali', 'status_asuransi_umum', 'kelas_umum', 'kelas_umum_lain_text', 'biaya_min', 'biaya_max', 'no_bpjs', 'bpjs_status_kelas', 'bpjs_naik_tingkat', 'nama_asuransi_lain']),
            "lukaOperasi" => $statusLukaOperasi,
            "rm27cPlebitis" => $this->cekSemuaKolom($rm27cPlebitis, $pengecualianRm27cPlebitis),
            "rm27bKateter" => $this->cekSemuaKolom($rm27bKateter, $pengecualianRm27bKateter),
            "rm20bUdds" => (!empty($rm20bUddsData) && count((array)$rm20bUddsData) > 0) ? $this->cekSemuaKolom($rm20bUdds, []) : 'Tidak Lengkap',
            "rm0Sbar" => [$statusRm0Sbar, $statusTtdRm0Sbar],
            "rm3TataTertib" => $this->cekSemuaKolom($rm3TataTertib, ['ttdWali']),
            "rm26ePendapatLain" => $this->cekSemuaKolom($rm26ePendapatLain, ['ttdWali']),
            "rm26nIzinKeluar" => $this->cekSemuaKolom($rm26nIzinKeluar, ['ttdWali']),
            "rm26fKerohanian" => $this->cekSemuaKolom($rm26fKerohanian, ['ttdWali']),
            "rm26hKepercayaan" => $this->cekSemuaKolom($rm26hKepercayaan, ['ttdWali']),
            "rm26iPenyimpananBarang" => (!empty($rm26iPenyimpananBarangData) && count((array)$rm26iPenyimpananBarangData) > 0) ? $this->cekSemuaKolom($rm26iPenyimpananBarang, ['ttdWali']) : 'Tidak Lengkap',
            "rm26bRujukKeluar" => (!empty($rm26bRujukKeluarData) && count((array)$rm26bRujukKeluarData) > 0) ? $this->cekSemuaKolom($rm26bRujukKeluar, ['isiKlinikal', 'isiNonKlinikal', 'petugasDihubungi', 'noPetugasDihubungi', 'jamTiba', 'isiAlergi', 'isiPenyakit', 'alat', 'isiAlatLainnya']) : 'Tidak Lengkap',
            "hiv" => $this->cekSemuaKolom($hiv, ['tglTesHiv', 'jenisTes', 'hasilTesR1', 'reagenR1', 'hasilTesR2', 'reagenR2', 'hasilTesR3', 'reagenR3', 'kesimpulanTes', 'noPdp', 'tglPdp', 'tindakLanjut', 'isiLsm', 'reagenR1', 'reagenR2', 'reagenR3', 'jenisKonselingKts', 'jenisPetugasPendukung', 'jumlahAnak', 'umurAnakTerakhir', 'jenisPs', 'lamanya', 'pasanganTetap', 'pasanganPerempuan', 'pasanganHamil', 'tglLahirPasangan', 'tglTesPasangan', 'isiAlasanTesLainnya', 'hubVagTgl', 'hubAnalTgl', 'gantianSuntikTgl', 'transfusiDarahTgl', 'transmisiIbuTgl', 'isiLainnya', 'isiLainnyaTgl', 'pernahTesDmn', 'pernahTesTgl', 'hasilTesSebelumnya', 'pernahTesDmn2', 'pernahTesTgl2', 'hasilTesSebelumnya2', 'isiImsLainnya', 'isiPenyakitLainnya', 'isiRujukKe', 'isiRujukKonseling']),
            "rm4PermintaanMasuk" => $this->cekSemuaKolom($rm4PermintaanMasuk, ['ttdWali', 'nama', 'isiBiayaLain']),
            "tbAnak" => $this->cekSemuaKolom($tbAnak, ['ttdWali', 'jenisKontak', 'isiJenisKontakLainnya', 'indeksTbc', 'jenisTbc', 'tglBerobatTbc', 'tglWbp', 'statusWbp', 'durasiBatuk', 'fasyankes']),
            "tbIbu" => $this->cekSemuaKolom($tbAnak, ['ttdWali', 'imt', 'jenisKontak', 'isiJenisKontakLainnya', 'indeksTbc', 'jenisTbc', 'tglBerobatTbc', 'tglWbp', 'statusWbp', 'durasiBatuk', 'fasyankes']),
        ];

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'skorPoudji' => $skorPoudji,  // Biarkan null jika data tidak ada
            'persRajal'  => $persRajal,    // Biarkan null jika data tidak ada
            'dpjp'  => $dpjp,    // Biarkan null jika data tidak ada
            'rekonsiliasiObat'  => $rekonsiliasiObat,    // Biarkan null jika data tidak ada
            'icGeneral'  => $icGeneral,    // Biarkan null jika data tidak ada
            'icDarah'  => $icDarah,    // Biarkan null jika data tidak ada
            'icSesar'  => $icSesar,    // Biarkan null jika data tidak ada
            'icPembiusan'  => $icPembiusan,    // Biarkan null jika data tidak ada
            'icPembiusanLokal'  => $icPembiusanLokal,    // Biarkan null jika data tidak ada
            'lembarEdukasi'  => $lembarEdukasi,    // Biarkan null jika data tidak ada
            'persetujuanRanap'  => $persetujuanRanap,    // Biarkan null jika data tidak ada
            'lukaOperasi'  => $lukaOperasi,    // Biarkan null jika data tidak ada
            'rm27cPlebitis'  => $rm27cPlebitis,    // Biarkan null jika data tidak ada
            'rm27bKateter'  => $rm27bKateter,    // Biarkan null jika data tidak ada
            'rm0Sbar'  => $rm0Sbar,    // Biarkan null jika data tidak ada
            'rm20bUdds'  => $rm20bUdds,    // Biarkan null jika data tidak ada
            'rm3TataTertib'  => $rm3TataTertib,    // Biarkan null jika data tidak ada
            'rm26ePendapatLain'  => $rm26ePendapatLain,    // Biarkan null jika data tidak ada
            'rm26nIzinKeluar'  => $rm26nIzinKeluar,    // Biarkan null jika data tidak ada
            'rm26fKerohanian'  => $rm26fKerohanian,    // Biarkan null jika data tidak ada
            'rm26hKepercayaan'  => $rm26hKepercayaan,    // Biarkan null jika data tidak ada
            'rm26iPenyimpananBarang'  => $rm26iPenyimpananBarang,    // Biarkan null jika data tidak ada
            'rm26bRujukKeluar'  => $rm26bRujukKeluar,    // Biarkan null jika data tidak ada
            'hiv'  => $hiv,    // Biarkan null jika data tidak ada
            'rm4PermintaanMasuk'  => $rm4PermintaanMasuk,    // Biarkan null jika data tidak ada
            'tbAnak'  => $tbAnak,    // Biarkan null jika data tidak ada
            'tbIbu'  => $tbIbu,    // Biarkan null jika data tidak ada
            'status'  => $status    // Biarkan null jika data tidak ada
        ];

        return view('rm/index', ['data' => $data]);
    }

    public function statusRekonsiliasiObat($dataRekonsiliasiObat, $dataObat)
    {
        if ($dataObat) {
            $listRuangan = array_column($dataObat, 'ruangan');
        } else {
            $listRuangan = [];
        }

        $ada["igd"]  = true;
        $ada["ko"]  = in_array('ko', $listRuangan);
        $ada["rr"]  = in_array('rr', $listRuangan);
        $ada["ri"]  = in_array('ri', $listRuangan);

        $ruangan = ['Igd', 'Ko', 'Rr', 'Ri'];
        $data = [];
        $hasilCek = [];

        foreach ($ruangan as $r) {
            $keyLower = strtolower($r);

            $data[$keyLower] = [
                "perawat{$r}"      => $dataRekonsiliasiObat["perawat{$r}"] ?? null,
                "dokter{$r}"       => $dataRekonsiliasiObat["dokter{$r}"] ?? null,
                "farmasi{$r}"      => $dataRekonsiliasiObat["farmasi{$r}"] ?? null,
                "waktuPerawat{$r}" => $dataRekonsiliasiObat["waktuPerawat{$r}"] ?? null,
                "waktuDokter{$r}"  => $dataRekonsiliasiObat["waktuDokter{$r}"] ?? null,
                "waktuFarmasi{$r}" => $dataRekonsiliasiObat["waktuFarmasi{$r}"] ?? null,
            ];

            $hasilCek[$keyLower] = $this->cekSemuaKolom($data[$keyLower]);
        }

        // dd($hasilCek);

        foreach ($ruangan as $r) {
            $keyLower = strtolower($r);

            if ($hasilCek[$keyLower] === 'Tidak Lengkap') {
                return 'Tidak Lengkap';
            }

            if ($keyLower != 'igd' && $ada[$keyLower] && $hasilCek[$keyLower] != 'Lengkap') {
                return 'Tidak Lengkap';
            }
        }
        return "Lengkap";
    }
}
