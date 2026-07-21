<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\HivModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;

class Hiv extends BaseController
{
    protected $regPeriksaModel;
    protected $hivModel;
    protected $sysLog;
    protected $pengaturan;
    protected $pjPasienModel;
    protected $dokterModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->hivModel = new HivModel();
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->sysLog = new SysLogModel();
        $this->pengaturan = new PengaturanModel();
        $this->pjPasienModel = new PjPasienModel();
        $this->dokterModel = new DokterModel();
    }

    public function index($noRawat)
    {
        $dokter =  $this->dokterModel->where('kd_dokter !=', '-')->findAll();

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
                pasien.tmp_lahir, 
                pasien.tgl_lahir,
                pasien.nm_ibu
            ')
            ->join('pasien', 'pasien.no_rkm_medis = reg_periksa.no_rkm_medis', 'left')
            ->where('reg_periksa.no_rawat', $noRawat)
            ->first();

        $hiv = $this->hivModel->where('noRawat', $noRawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'hiv' => $hiv,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/hiv', ['data' => $data]);
    }

    public function simpan()
    {
        $data = [
            // Data Utama Pasien
            "noRawat"               => $this->request->getPost("noRawat"),

            // ==========================================
            // KOLOM KIRI (DATA KLIEN & KONSELING)
            // ==========================================
            "statusHamil"           => $this->request->getPost("statusHamil"),
            "umurAnakTerakhir"      => $this->request->getPost("umurAnakTerakhir"),
            "jumlahAnak"            => $this->request->getPost("jumlahAnak"),
            "kelompokRisiko"        => $this->request->getPost("kelompokRisiko"),
            "jenisPs"               => $this->request->getPost("jenisPs"),
            "lamanya"               => $this->request->getPost("lamanya"),
            "statusKunjungan"       => $this->request->getPost("statusKunjungan"),
            "statusRujuk"           => $this->request->getPost("statusRujuk"),

            "alasanTes"             => json_encode($this->request->getPost("alasanTes") ?? []),
            "isiAlasanTesLainnya"   => $this->request->getPost("isiAlasanTesLainnya"),

            // Validasi Tanggal (Null jika kosong)
            "tglKonselingPra"        => !empty($this->request->getPost("tglKonselingPra")) ? $this->request->getPost("tglKonselingPra") : null,
            "statusKlien"           => $this->request->getPost("statusKlien"),
            "infoTes"               => $this->request->getPost("infoTes"),
            "tglPemberianInfo"      => !empty($this->request->getPost("tglPemberianInfo")) ? $this->request->getPost("tglPemberianInfo") : null,
            "pernahTes2"            => $this->request->getPost("pernahTes2"),
            "pernahTesDmn2"         => $this->request->getPost("pernahTesDmn2"),
            "pernahTesTgl2"         => !empty($this->request->getPost("pernahTesTgl2")) ? $this->request->getPost("pernahTesTgl2") : null,
            "hasilTesSebelumnya2"   => $this->request->getPost("hasilTesSebelumnya2"),

            "penyakit"              => json_encode($this->request->getPost("penyakit") ?? []),
            "isiImsLainnya"         => $this->request->getPost("isiImsLainnya"),
            "isiPenyakitLainnya"    => $this->request->getPost("isiPenyakitLainnya"),

            "kesediaanTes2"         => $this->request->getPost("kesediaanTes2"),
            "tglKonselingPasca"     => !empty($this->request->getPost("tglKonselingPasca")) ? $this->request->getPost("tglKonselingPasca") : null,
            "jmlKondom"             => $this->request->getPost("jmlKondom"),
            "terimaHasil"           => $this->request->getPost("terimaHasil"),
            "gejalaTb"              => $this->request->getPost("gejalaTb"),

            "tindakLanjutKts"       => json_encode($this->request->getPost("tindakLanjutKts") ?? []),
            "jenisKonselingKts"     => $this->request->getPost("jenisKonselingKts"),
            "jenisPetugasPendukung" => $this->request->getPost("jenisPetugasPendukung"),
            "isiLsm"                => $this->request->getPost("isiLsm"),

            "statusLayanan"         => $this->request->getPost("statusLayanan"),
            "jenisLayanan"          => $this->request->getPost("jenisLayanan"),
            "petugas"               => $this->request->getPost("petugas"),

            // ==========================================
            // KOLOM KANAN (PASANGAN & RISIKO)
            // ==========================================
            "pasanganTetap"         => $this->request->getPost("pasanganTetap"),
            "pasanganPerempuan"     => $this->request->getPost("pasanganPerempuan"),
            "pasanganHamil"         => $this->request->getPost("pasanganHamil"),
            "tglLahirPasangan"      => !empty($this->request->getPost("tglLahirPasangan")) ? $this->request->getPost("tglLahirPasangan") : null,
            "tglTesPasangan"        => !empty($this->request->getPost("tglTesPasangan")) ? $this->request->getPost("tglTesPasangan") : null,
            "hasilTesPasangan"      => $this->request->getPost("hasilTesPasangan"),
            "wbp"                   => $this->request->getPost("wbp"),

            "hubVag"                => $this->request->getPost("hubVag"),
            "hubVagTgl"             => !empty($this->request->getPost("hubVagTgl")) ? $this->request->getPost("hubVagTgl") : null,
            "hubAnal"               => $this->request->getPost("hubAnal"),
            "hubAnalTgl"            => !empty($this->request->getPost("hubAnalTgl")) ? $this->request->getPost("hubAnalTgl") : null,
            "gantianSuntik"         => $this->request->getPost("gantianSuntik"),
            "gantianSuntikTgl"      => !empty($this->request->getPost("gantianSuntikTgl")) ? $this->request->getPost("gantianSuntikTgl") : null,
            "transfusiDarah"        => $this->request->getPost("transfusiDarah"),
            "transfusiDarahTgl"     => !empty($this->request->getPost("transfusiDarahTgl")) ? $this->request->getPost("transfusiDarahTgl") : null,
            "transmisiIbu"          => $this->request->getPost("transmisiIbu"),
            "transmisiIbuTgl"       => !empty($this->request->getPost("transmisiIbuTgl")) ? $this->request->getPost("transmisiIbuTgl") : null,
            "isiLainnya"            => $this->request->getPost("isiLainnya"),
            "isiLainnyaTgl"         => !empty($this->request->getPost("isiLainnyaTgl")) ? $this->request->getPost("isiLainnyaTgl") : null,
            "periodeJendela"        => $this->request->getPost("periodeJendela"),
            "periodeJendelaTgl"     => !empty($this->request->getPost("periodeJendelaTgl")) ? $this->request->getPost("periodeJendelaTgl") : null,
            "kesediaanTes"          => $this->request->getPost("kesediaanTes"),
            "pernahTes"             => $this->request->getPost("pernahTes"),
            "pernahTesDmn"          => $this->request->getPost("pernahTesDmn"),
            "pernahTesTgl"          => !empty($this->request->getPost("pernahTesTgl")) ? $this->request->getPost("pernahTesTgl") : null,
            "hasilTesSebelumnya"    => $this->request->getPost("hasilTesSebelumnya"),

            "tglTesHiv"             => !empty($this->request->getPost("tglTesHiv")) ? $this->request->getPost("tglTesHiv") : null,
            "jenisTes"              => $this->request->getPost("jenisTes"),
            "hasilTesR1"            => $this->request->getPost("hasilTesR1"),
            "reagenR1"              => $this->request->getPost("reagenR1"),
            "hasilTesR2"            => $this->request->getPost("hasilTesR2"),
            "reagenR2"              => $this->request->getPost("reagenR2"),
            "hasilTesR3"            => $this->request->getPost("hasilTesR3"),
            "reagenR3"              => $this->request->getPost("reagenR3"),
            "kesimpulanTes"         => $this->request->getPost("kesimpulanTes"),
            "noPdp"                 => $this->request->getPost("noPdp"),
            "tglPdp"                => !empty($this->request->getPost("tglPdp")) ? $this->request->getPost("tglPdp") : null,

            "tindakLanjut"          => json_encode($this->request->getPost("tindakLanjut") ?? []),
            "isiRujukKonseling"     => $this->request->getPost("isiRujukKonseling"),
            "isiRujukKe"            => $this->request->getPost("isiRujukKe"),
            "isitindakLanjutLainnya"            => $this->request->getPost("isitindakLanjutLainnya"),
            "hivPasangan"           => $this->request->getPost("hivPasangan")
        ];

        $noRawat = $this->request->getPost("noRawat");

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->hivModel->save($data);
            $this->catatLog('tambah', 'hiv', $noRawat, $this->hivModel->where('noRawat', $noRawat)->first());
        } else {
            unset($data['noRawat']);

            $this->catatLog('ubah', 'hiv', $noRawat, $this->hivModel->where('noRawat', $noRawat)->first(), $data);

            $this->hivModel->where('noRawat', $noRawat)->set($data)->update();
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function ubahWaktu()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $waktu   = $this->request->getPost("waktu");

        $data = [
            "tglinput" => str_replace('T', ' ', $waktu) . ':00'
        ];

        $this->hivModel->where('noRawat', $noRawat)->set($data)->update();
        echo json_encode('');
    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $this->catatLog('hapus', 'ic_darah', $noRawat, $this->hivModel->where('noRawat', $noRawat)->first());

        $this->hivModel->where("noRawat", $noRawat)->delete();
        echo json_encode("");
    }


    public function cetak($noRawat)
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
                pasien.agama, 
                pasien.tmp_lahir, 
                pasien.tgl_lahir,
                bangsal.nm_bangsal,
                kabupaten.nm_kab,
                propinsi.nm_prop,
                pasien.nm_ibu
            ')
            ->join('pasien', 'pasien.no_rkm_medis = reg_periksa.no_rkm_medis', 'left')
            ->join('kabupaten', 'pasien.kd_kab = kabupaten.kd_kab', 'left')
            ->join('propinsi', 'pasien.kd_prop = propinsi.kd_prop', 'left')
            ->join('kamar_inap', 'reg_periksa.no_rawat = kamar_inap.no_rawat', 'left')
            ->join('kamar', 'kamar_inap.kd_kamar = kamar.kd_kamar', 'left')
            ->join('bangsal', 'kamar.kd_bangsal = bangsal.kd_bangsal', 'left')
            ->where('reg_periksa.no_rawat', $noRawat)
            ->first();

        $hiv = $this->hivModel->where('noRawat', $noRawat)->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'hiv' => $hiv
        ];
        echo view("cetak/hiv", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function simpanTtd()
    {
        // Ambil input noRawat dan data canvas dari form
        $noRawat    = $this->request->getPost("noRawat");
        $noRawat = str_replace('/', '-', $noRawat);
        $ttdWali    = $this->request->getPost("ttdWali");
        $ttdSaksi    = $this->request->getPost("ttdSaksi");

        $lokasiFolder = 'hiv';

        $data = [
            "ttdWali" => $this->uploadTtd($ttdWali, $noRawat . '_wali', $lokasiFolder),
            "ttdSaksi" => $this->uploadTtd($ttdSaksi, $noRawat . '_saksi', $lokasiFolder)
        ];

        $noRawat = str_replace('-', '/', $noRawat);
        $this->hivModel->where('noRawat', $noRawat)->set($data)->update();

        return $this->response->setJSON([
            'status'  => 'success'
        ]);
    }
}
