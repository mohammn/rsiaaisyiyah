<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\Rm11a1BedahModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;

class Rm11a1Bedah extends BaseController
{
    protected $regPeriksaModel;
    protected $rm11a1BedahModel;
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
        $this->rm11a1BedahModel = new Rm11a1BedahModel();
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
                pasien.tgl_lahir
            ')
            ->join('pasien', 'pasien.no_rkm_medis = reg_periksa.no_rkm_medis', 'left')
            ->where('reg_periksa.no_rawat', $noRawat)
            ->first();

        $rm11a1Bedah = $this->rm11a1BedahModel->where('noRawat', $noRawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'rm11a1Bedah' => $rm11a1Bedah,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/rm11a1Bedah', ['data' => $data]);
    }

    public function simpan()
    {
        $data = [
            "noRawat"             => $this->request->getPost("noRawat"),

            // 1. Anamnesa
            "nama"                => $this->request->getPost("nama"),
            "tempatPengkajian"    => $this->request->getPost("tempatPengkajian"),
            "keluhan"             => $this->request->getPost("keluhan"),
            "riwayatPenyakit"     => json_encode($this->request->getPost("riwayatPenyakit") ?? []),
            "isiRiwayatLainnya"   => $this->request->getPost("isiRiwayatLainnya"),
            "jenisOperasi"        => $this->request->getPost("jenisOperasi"),
            "lokasiOperasi"       => $this->request->getPost("lokasiOperasi"),
            "tglOperasi"          => $this->request->getPost("tglOperasi") ?: null,
            "riwayatAlergi"       => $this->request->getPost("riwayatAlergi"),
            "isiAlergi"           => $this->request->getPost("isiAlergi"),

            // 2. Pemeriksaan Fisik
            "td"                  => $this->request->getPost("td"),
            "beratBadan"          => $this->request->getPost("beratBadan"),
            "nadi"                => $this->request->getPost("nadi"),
            "tinggiBadan"         => $this->request->getPost("tinggiBadan"),
            "suhu"                => $this->request->getPost("suhu"),
            "pernafasan"          => $this->request->getPost("pernafasan"),

            // 3. Hasil Pemeriksaan Penunjang
            "laboratorium"        => $this->request->getPost("laboratorium"),
            "radiologi"           => $this->request->getPost("radiologi"),
            "penunjangLainnya"    => $this->request->getPost("penunjangLainnya"),
            "rekonsiliasi"        => $this->request->getPost("rekonsiliasi"),

            // 4. Diagnosa / Asesmen
            "diagnosaPreoperatif" => $this->request->getPost("diagnosaPreoperatif"),
            "diagnosaLain"        => $this->request->getPost("diagnosaLain"),
            "isidiagnosaLain"     => $this->request->getPost("isidiagnosaLain"),

            // 5. Rencana Tatalaksana
            "rencanaOperasi"      => $this->request->getPost("rencanaOperasi"),
            "sifatProsedur"       => $this->request->getPost("sifatProsedur"),
            "isiElektif"          => $this->request->getPost("isiElektif") ?: null,
            "lamaTindakan"        => $this->request->getPost("lamaTindakan"),
            "anestesia"           => $this->request->getPost("anestesia"),
            "puasa"               => $this->request->getPost("puasa"),
            "isiMulaiJam"         => $this->request->getPost("isiMulaiJam") ?: null,
            "konsultasiBagian"    => $this->request->getPost("konsultasiBagian"),
            "isiKonsultasi"       => $this->request->getPost("isiKonsultasi"),
            "peralatan"           => $this->request->getPost("peralatan"),
            "isiPeralatanLain"    => $this->request->getPost("isiPeralatanLain"),
            "pengosonganKemih"    => $this->request->getPost("pengosonganKemih"),
            "infus"               => $this->request->getPost("infus"),
            "persiapanDarah"      => $this->request->getPost("persiapanDarah"),
            "isiWholeBlood"       => $this->request->getPost("isiWholeBlood"),
            "isiPackedRed"        => $this->request->getPost("isiPackedRed"),
            "isiKomponenLain"     => $this->request->getPost("isiKomponenLain"),

            // Post Op, Catatan, Dokter, & Petugas
            "rencanaPostOp"       => $this->request->getPost("rencanaPostOp"),
            "catatan"             => $this->request->getPost("catatan"),
            "dokter"              => $this->request->getPost("dokter"),
            "petugas"             => session()->get('nama')
        ];


        $noRawat = $this->request->getPost("noRawat");

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->rm11a1BedahModel->save($data);

            $this->catatLog('tambah', 'rm11a1_bedah', $noRawat, $data);
        } else {
            unset($data['noRawat']);

            $this->catatLog('ubah', 'rm11a1_bedah', $noRawat, $this->rm11a1BedahModel->where('noRawat', $noRawat)->first(), $data);

            $this->rm11a1BedahModel->where('noRawat', $noRawat)->set($data)->update();
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

        $this->rm11a1BedahModel->where('noRawat', $noRawat)->set($data)->update();
        echo json_encode('');
    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $this->catatLog('hapus', 'rm11a1_bedah', $noRawat, $this->rm11a1BedahModel->where('noRawat', $noRawat)->first());

        $this->rm11a1BedahModel->where("noRawat", $noRawat)->delete();
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
                pasien.tmp_lahir, 
                pasien.tgl_lahir,
                bangsal.nm_bangsal
            ')
            ->join('pasien', 'pasien.no_rkm_medis = reg_periksa.no_rkm_medis', 'left')
            ->join('kamar_inap', 'reg_periksa.no_rawat = kamar_inap.no_rawat', 'left')
            ->join('kamar', 'kamar_inap.kd_kamar = kamar.kd_kamar', 'left')
            ->join('bangsal', 'kamar.kd_bangsal = bangsal.kd_bangsal', 'left')
            ->where('reg_periksa.no_rawat', $noRawat)
            ->first();

        $rm11a1Bedah = $this->rm11a1BedahModel->where('noRawat', $noRawat)->first();
        if ($rm11a1Bedah) {
            $rm11a1Bedah["tglTtd"] = $this->tanggalCetak($rm11a1Bedah["tglinput"]);
        }

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'rm11a1Bedah' => $rm11a1Bedah
        ];
        echo view("cetak/rm11a1Bedah", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function penandaan($noRawat)
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
                pasien.tmp_lahir, 
                pasien.tgl_lahir,
                bangsal.nm_bangsal
            ')
            ->join('pasien', 'pasien.no_rkm_medis = reg_periksa.no_rkm_medis', 'left')
            ->join('kamar_inap', 'reg_periksa.no_rawat = kamar_inap.no_rawat', 'left')
            ->join('kamar', 'kamar_inap.kd_kamar = kamar.kd_kamar', 'left')
            ->join('bangsal', 'kamar.kd_bangsal = bangsal.kd_bangsal', 'left')
            ->where('reg_periksa.no_rawat', $noRawat)
            ->first();

        $rm11a1Bedah = $this->rm11a1BedahModel->where('noRawat', $noRawat)->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'rm11a1Bedah' => $rm11a1Bedah
        ];
        echo view("rm/partials/penandaanRm11a1Bedah", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function simpanPenandaan()
    {
        // 1. Ambil input noRawat
        $noRawat = $this->request->getPost("noRawat");
        $noRawatFormatted = str_replace('/', '-', $noRawat);

        $lokasiFolder = 'rm11a1Bedah_penandaaan';

        // 2. Daftar key canvas lokasi penandaan
        $listCanvas = [
            'badan',
            'kepalaSamping',
            'kepala',
            'telapakTangan',
            'kaki',
            'punggungTangan'
        ];

        $data = [];

        // 3. Loop untuk memproses setiap canvas
        foreach ($listCanvas as $canvasName) {
            $base64Image = $this->request->getPost($canvasName);

            if (!empty($base64Image)) {
                // Jika ada coretan baru, upload dan simpan path-nya
                $fileName = $noRawatFormatted . '_' . $canvasName;
                $data[$canvasName] = $this->uploadTtd($base64Image, $fileName, $lokasiFolder);
            } else {
                // Jika tidak dicoret pada pengiriman ini, kosongkan path-nya di database
                $data[$canvasName] = null;
            }
        }

        // 4. Lakukan update ke database untuk semua kolom canvas sekaligus
        $noRawatOriginal = str_replace('-', '/', $noRawatFormatted);
        $this->rm11a1BedahModel->where('noRawat', $noRawatOriginal)->set($data)->update();

        return $this->response->setJSON([
            'status' => 'success'
        ]);
    }

    public function simpanTtd()
    {
        // Ambil input noRawat dan data canvas dari form
        $noRawat    = $this->request->getPost("noRawat");
        $noRawat = str_replace('/', '-', $noRawat);
        $ttdWali    = $this->request->getPost("ttdWali");

        $lokasiFolder = 'rm11a1Bedah';

        $data = [
            "ttdWali" => $this->uploadTtd($ttdWali, $noRawat . '_wali', $lokasiFolder)
        ];

        $noRawat = str_replace('-', '/', $noRawat);
        $this->rm11a1BedahModel->where('noRawat', $noRawat)->set($data)->update();

        return $this->response->setJSON([
            'status'  => 'success'
        ]);
    }
}
