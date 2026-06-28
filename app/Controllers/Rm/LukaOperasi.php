<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\LukaOperasiModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;
use App\Models\PetugasModel;

class LukaOperasi extends BaseController
{
    protected $regPeriksaModel;
    protected $lukaOperasiModel;
    protected $sysLog;
    protected $pengaturan;
    protected $pjPasienModel;
    protected $dokterModel;
    protected $petugasModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->lukaOperasiModel = new LukaOperasiModel();
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->sysLog = new SysLogModel();
        $this->pengaturan = new PengaturanModel();
        $this->pjPasienModel = new PjPasienModel();
        $this->dokterModel = new DokterModel();
        $this->petugasModel = new PetugasModel();
    }

    public function index($noRawat)
    {
        $petugas =  $this->petugasModel->where('nip !=', '-')->findAll();
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

        $lukaOperasi = $this->lukaOperasiModel->where('noRawat', $noRawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'petugas'     => $petugas,      // Jangan pakai (object) di sini
            'lukaOperasi' => $lukaOperasi,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/lukaOperasi', ['data' => $data]);
    }

    public function simpan()
    {
        $data = [
            // --- Data Pasien & Petugas ---
            "noRawat"                   => $this->request->getPost("noRawat"),
            "unit"                      => $this->request->getPost("unit"),
            "petugasPreOperasi"         => $this->request->getPost("petugasPreOperasi"),
            "tglMrs"                    => $this->request->getPost("tglMrs"),
            "tglOperasi"                => $this->request->getPost("tglOperasi"),
            "beratBadan"                => $this->request->getPost("beratBadan"),
            "albumin"                   => $this->request->getPost("albumin"),
            "isiGulaDarah"              => $this->request->getPost("isiGulaDarah"),
            "waktuPencukuran"           => $this->request->getPost("waktuPencukuran"),
            "persiapanUsusDg"            => $this->request->getPost("persiapanUsusDg"),
            "isiPenyakitLainnya"        => $this->request->getPost("isiPenyakitLainnya"),

            // --- Radio Buttons Bagian 1 ---
            "suhuPasien"                => $this->request->getPost("suhuPasien") ?? '',
            "merokok"                   => $this->request->getPost("merokok") ?? '',
            "mrsa"                      => $this->request->getPost("mrsa") ?? '',
            "hasilMrsa"                 => $this->request->getPost("hasilMrsa") ?? '',
            "jenisOps"                  => $this->request->getPost("jenisOps") ?? '',
            "trauma"                    => $this->request->getPost("trauma") ?? '',
            "gulaDarah"                 => $this->request->getPost("gulaDarah") ?? '',
            "pencukuran"                => $this->request->getPost("pencukuran") ?? '',
            "persiapanUsus"              => $this->request->getPost("persiapanUsus") ?? '',

            // --- Checkbox Multipel Bagian 1 ---
            "penyakit"                  => $this->request->getPost("penyakit") ?? [],

            // --- Input Text, Time, dll Bagian 2 ---
            "diagnosaPre"               => $this->request->getPost("diagnosaPre"),
            "isiSteroid"                => $this->request->getPost("isiSteroid"),
            "isiKualifikasiLainnya"     => $this->request->getPost("isiKualifikasiLainnya"),
            "isipenyakitInfeksiLainnya" => $this->request->getPost("isipenyakitInfeksiLainnya"),
            "profilaksisObat"           => $this->request->getPost("profilaksisObat"),
            "profilaksisJam"            => $this->request->getPost("profilaksisJam"),
            "profilaksisDosis"          => $this->request->getPost("profilaksisDosis"),
            "skintestHasil"             => $this->request->getPost("skintestHasil"),
            "ronde"             => $this->request->getPost("ronde"),
            "isiSuhuPasien"             => $this->request->getPost("isiSuhuPasien"),

            // --- Radio Buttons Bagian 2 ---
            "steroid"                   => $this->request->getPost("steroid") ?? '',
            "mandi"                     => $this->request->getPost("mandi") ?? '',
            "radioterapi"               => $this->request->getPost("radioterapi") ?? '',
            "profilaksis"               => $this->request->getPost("profilaksis") ?? '',
            "skintest"                  => $this->request->getPost("skintest") ?? '',

            // --- Checkbox Multipel Bagian 2 ---
            "kualifikasi"               => $this->request->getPost("kualifikasi") ?? [],
            "penyakitInfeksi"           => $this->request->getPost("penyakitInfeksi") ?? [],

            // --- Input Text Bagian 2.1 ---
            "petugasRuangOperasi"       => $this->request->getPost("petugasRuangOperasi"),
            "sirkulasi"                 => $this->request->getPost("sirkulasi"),
            "suhuRuang"                 => $this->request->getPost("suhuRuang"),
            "kelembapan"                => $this->request->getPost("kelembapan"),
            "angkaKuman"                => $this->request->getPost("angkaKuman"),
            "isiprosedurOperasiLainnya" => $this->request->getPost("isiprosedurOperasiLainnya"),
            "isiprosedurOperasiLainnya2" => $this->request->getPost("isiprosedurOperasiLainnya2"),
            "drainJenis"                => $this->request->getPost("drainJenis"),
            "implantJenis"              => $this->request->getPost("implantJenis"),

            // --- Radio Buttons Bagian 2.1 ---
            "ruangOperasi"              => $this->request->getPost("ruangOperasi") ?? '',
            "tekananUdara"              => $this->request->getPost("tekananUdara") ?? '',
            "multiProsedur"             => $this->request->getPost("multiProsedur") ?? '',
            "jamurAc"                   => $this->request->getPost("jamurAc") ?? '',
            "drain"                     => $this->request->getPost("drain") ?? '',
            "implant"                   => $this->request->getPost("implant") ?? '',

            // --- Checkbox Multipel Bagian 2.1 ---
            "prosedurOperasi"           => $this->request->getPost("prosedurOperasi") ?? [],

            // --- Input Text Bagian 2.2 ---
            "antibiotikObat"            => $this->request->getPost("antibiotikObat"),
            "antibiotikJam"             => $this->request->getPost("antibiotikJam"),
            "antibiotikDosis"           => $this->request->getPost("antibiotikDosis"),
            "jumlahStaff"               => $this->request->getPost("jumlahStaff"),
            "jamMulaiOps"               => $this->request->getPost("jamMulaiOps"),
            "jamSelesaiOps"             => $this->request->getPost("jamSelesaiOps"),
            "isiDisinfeksiKulitLainnya" => $this->request->getPost("isiDisinfeksiKulitLainnya"),
            "diagnosaPost"              => $this->request->getPost("diagnosaPost"),

            // --- Radio Buttons Bagian 2.2 ---
            "sterilisasi"               => $this->request->getPost("sterilisasi") ?? '',
            "asaScore"                  => $this->request->getPost("asaScore") ?? '',
            "antibiotik"                => $this->request->getPost("antibiotik") ?? '',
            "indikator"                 => $this->request->getPost("indikator") ?? '',
            "klasifikasiLuka"           => $this->request->getPost("klasifikasiLuka") ?? '',
            "disinfeksiKulit"           => $this->request->getPost("disinfeksiKulit") ?? '',

            // ==========================================
            // --- POST OPERASI (DATA TABEL 1-10) -------
            // ==========================================
            "isiAntibiotik"             => $this->request->getPost("isiAntibiotik"),
            "tgl"                     => $this->request->getPost("tgl") ?? [],

            // Checkbox Tindakan Per Hari
            "rawatLuka"                 => $this->request->getPost("rawatLuka") ?? [],
            "transparan"                => $this->request->getPost("transparan") ?? [],
            "thypafix"                  => $this->request->getPost("thypafix") ?? [],
            "drainTindakan"             => $this->request->getPost("drainTindakan") ?? [],
            "aff"                       => $this->request->getPost("aff") ?? [],
            "angkat"                    => $this->request->getPost("angkat") ?? [],
            "antibiotikTindakan"        => $this->request->getPost("antibiotikTindakan") ?? [],
            "krs"                       => $this->request->getPost("krs") ?? [],
            "kontrol"                   => $this->request->getPost("kontrol") ?? [],
            "mrs"                       => $this->request->getPost("mrs") ?? [],

            // Checkbox Identifikasi ILO Per Hari
            "nyeri"                     => $this->request->getPost("nyeri") ?? [],
            "demam"                     => $this->request->getPost("demam") ?? [],
            "kemerahan"                 => $this->request->getPost("kemerahan") ?? [],
            "drainase"                  => $this->request->getPost("drainase") ?? [],
            "bengkak"                   => $this->request->getPost("bengkak") ?? [],
            "kuman"                     => $this->request->getPost("kuman") ?? [],
            "ada"                       => $this->request->getPost("ada") ?? [],
            "diagnosa"                  => $this->request->getPost("diagnosa") ?? [],

            // Input Text Keterangan Flat (Kolom Kanan)
            "ketRawatLuka"              => $this->request->getPost("ketRawatLuka"),
            "ketTransparan"             => $this->request->getPost("ketTransparan"),
            "ketThypafix"               => $this->request->getPost("ketThypafix"),
            "ketDrain"                  => $this->request->getPost("ketDrain"),
            "ketAff"                    => $this->request->getPost("ketAff"),
            "ketAngkat"                 => $this->request->getPost("ketAngkat"),
            "ketAntibiotik"             => $this->request->getPost("ketAntibiotik"),
            "ketKrs"                    => $this->request->getPost("ketKrs"),
            "ketKontrol"                => $this->request->getPost("ketKontrol"),
            "ketMrs"                    => $this->request->getPost("ketMrs"),
            "ketNyeri"                  => $this->request->getPost("ketNyeri"),
            "ketDemam"                  => $this->request->getPost("ketDemam"),
            "ketKemerahan"              => $this->request->getPost("ketKemerahan"),
            "ketDrainase"               => $this->request->getPost("ketDrainase"),
            "ketBengkak"                => $this->request->getPost("ketBengkak"),
            "ketKuman"                  => $this->request->getPost("ketKuman"),
            "ketAda"                    => $this->request->getPost("ketAda"),
            "ketDiagnosa"              => $this->request->getPost("ketDiagnosa"),

            // Radio Tambahan di bawah tabel
            "buangCairan"               => $this->request->getPost("buangCairan") ?? '',
            "affDrain"                  => $this->request->getPost("affDrain") ?? '',
            "jenisLokasi"               => $this->request->getPost("jenisLokasi") ?? '',
            "lokasiSpesifik"            => $this->request->getPost("lokasiSpesifik") ?? '',
            "isiLokasiSpesifikLainnya"  => $this->request->getPost("isiLokasiSpesifikLainnya"),
        ];

        // --- GENERATE PETUGAS DINAMIS (petugas1 s/d petugas10) ---
        for ($i = 1; $i <= 10; $i++) {
            $data["petugas" . $i] = $this->request->getPost("petugas" . $i) ?? '';
        }

        // =====================================================================
        // PROSES TAMBAHAN: OTOMATIS UBAH SEMUA FIELD ARRAY MENJADI STRING JSON
        // =====================================================================
        $arrayFields = [
            'penyakit',
            'kualifikasi',
            'penyakitInfeksi',
            'prosedurOperasi',
            'tgl',
            'rawatLuka',
            'transparan',
            'thypafix',
            'drainTindakan',
            'aff',
            'angkat',
            'antibiotikTindakan',
            'krs',
            'kontrol',
            'mrs',
            'nyeri',
            'demam',
            'kemerahan',
            'drainase',
            'bengkak',
            'kuman',
            'ada',
            'diagnosa'
        ];

        foreach ($arrayFields as $field) {
            if (isset($data[$field]) && is_array($data[$field])) {
                // Jika inputan berbentuk array, konversi ke string JSON murni '["1","2"]'
                $data[$field] = json_encode($data[$field]);
            } else {
                // Jika kosong/tidak dicentang, set default JSON array kosong '[]'
                $data[$field] = json_encode([]);
            }
        }
        // =====================================================================

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->lukaOperasiModel->save($data);
        } else {
            $noRawat = $this->request->getPost("noRawat");
            unset($data['noRawat']);

            $this->catatLog('ubah', 'luka_operasi', $noRawat, $this->lukaOperasiModel->where('noRawat', $noRawat)->first(), $data);

            $this->lukaOperasiModel->where('noRawat', $noRawat)->set($data)->update();
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $this->catatLog('hapus', 'luka_operasi', $noRawat, $this->lukaOperasiModel->where('noRawat', $noRawat)->first());

        $this->lukaOperasiModel->where("noRawat", $noRawat)->delete();
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

        $lukaOperasi = $this->lukaOperasiModel->where('noRawat', $noRawat)->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'lukaOperasi' => $lukaOperasi
        ];
        echo view("cetak/lukaOperasi", ["data" => $data]);

        // Load the view file and get its HTML content

    }
}
