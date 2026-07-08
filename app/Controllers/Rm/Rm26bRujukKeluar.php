<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\Rm26bRujukKeluarModel;
use App\Models\Rm26bRujukKeluarDataModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\PetugasModel;
use App\Models\DokterModel;

class Rm26bRujukKeluar extends BaseController
{
    protected $regPeriksaModel;
    protected $rm26bRujukKeluarModel;
    protected $rm26bRujukKeluarDataModel;
    protected $sysLog;
    protected $pengaturan;
    protected $pjPasienModel;
    protected $petugasModel;
    protected $dokterModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->rm26bRujukKeluarModel = new Rm26bRujukKeluarModel();
        $this->rm26bRujukKeluarDataModel = new Rm26bRujukKeluarDataModel();
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->sysLog = new SysLogModel();
        $this->pengaturan = new PengaturanModel();
        $this->pjPasienModel = new PjPasienModel();
        $this->petugasModel = new PetugasModel();
        $this->dokterModel = new DokterModel();
    }

    public function index($noRawat)
    {
        $petugas = $this->petugasModel->where('nip !=', '-')->findAll();
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

        $rm26bRujukKeluar = $this->rm26bRujukKeluarModel->where('noRawat', $noRawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'petugas'     => $petugas,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'rm26bRujukKeluar' => $rm26bRujukKeluar,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/rm26bRujukKeluar', ['data' => $data]);
    }

    public function simpan()
    {
        $alatPost = $this->request->getPost("alat");
        $alatJson = !empty($alatPost) ? json_encode($alatPost) : null;

        $data = [
            // --- Data Pasien & Petugas ---
            "noRawat"              => $this->request->getPost("noRawat"),
            "unit"                 => $this->request->getPost("unit"),
            "rs"                   => $this->request->getPost("rs"),
            "petugas"              => $this->request->getPost("petugas"),

            // Proteksi Tanggal & Jam agar NULL jika kosong
            "waktuMenghubungi"     => !empty($this->request->getPost("waktuMenghubungi")) ? $this->request->getPost("waktuMenghubungi") : null,
            "jamBerangkat"         => !empty($this->request->getPost("jamBerangkat")) ? $this->request->getPost("jamBerangkat") : null,
            "jamTiba"              => !empty($this->request->getPost("jamTiba")) ? $this->request->getPost("jamTiba") : null,
            "waktuIntake"          => !empty($this->request->getPost("waktuIntake")) ? $this->request->getPost("waktuIntake") : null,

            "petugasDihubungi"     => $this->request->getPost("petugasDihubungi"),
            "noPetugasDihubungi"   => $this->request->getPost("noPetugasDihubungi"),

            // --- Alasan Merujuk & Klinis ---
            "alasanRujuk"          => $this->request->getPost("alasanRujuk"),
            "isiKlinikal"          => $this->request->getPost("isiKlinikal"),
            "isiNonKlinikal"       => $this->request->getPost("isiNonKlinikal"),
            "diagnosa"             => $this->request->getPost("diagnosa"),
            "dokter"               => $this->request->getPost("dokter"),

            // --- Alergi & Riwayat ---
            "alergi"               => $this->request->getPost("alergi"),
            "isiAlergi"            => $this->request->getPost("isiAlergi"),
            "riwayatPenyakit"      => $this->request->getPost("riwayatPenyakit"),
            "riwayatObat"          => $this->request->getPost("riwayatObat"),
            "penyakit"             => $this->request->getPost("penyakit"),
            "isiPenyakit"          => $this->request->getPost("isiPenyakit"),

            // --- Catatan Tanda Vital ---
            "kesadaran"            => $this->request->getPost("kesadaran"),
            "gcs_e"                => $this->request->getPost("gcs_e"),
            "gcs_v"                => $this->request->getPost("gcs_v"),
            "gcs_m"                => $this->request->getPost("gcs_m"),
            "pupil_kanan"          => $this->request->getPost("pupil_kanan"),
            "pupil_kiri"           => $this->request->getPost("pupil_kiri"),
            "reflek_cahaya_kanan"  => $this->request->getPost("reflek_cahaya_kanan"),
            "reflek_cahaya_kiri"   => $this->request->getPost("reflek_cahaya_kiri"),

            "td_sistole"           => $this->request->getPost("td_sistole"),
            "td_diastole"          => $this->request->getPost("td_diastole"),
            "nadi"                 => $this->request->getPost("nadi"),
            "spo2"                 => $this->request->getPost("spo2"),
            "rr"                   => $this->request->getPost("rr"),
            "suhu"                 => $this->request->getPost("suhu"),
            "bb"                   => $this->request->getPost("bb"),
            "tb"                   => $this->request->getPost("tb"),

            "pemeriksaanPenunjang" => $this->request->getPost("pemeriksaanPenunjang"),
            "peralatan"            => $this->request->getPost("peralatan"),
            "alat"                 => $alatJson,
            "isiAlatLainnya"       => $this->request->getPost("isiAlatLainnya"),
            "perawatanLanjutan"    => $this->request->getPost("perawatanLanjutan"),
        ];

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->rm26bRujukKeluarModel->save($data);
            $this->catatLog('tambah', 'rm26b_rujuk_keluar', $this->request->getPost("noRawat"), $this->rm26bRujukKeluarModel->where('noRawat', $this->request->getPost("noRawat"))->first());
        } else {
            $noRawat = $this->request->getPost("noRawat");
            unset($data['noRawat']);

            $this->catatLog('ubah', 'ic_sesar', $noRawat, $this->rm26bRujukKeluarModel->where('noRawat', $noRawat)->first(), $data);

            $this->rm26bRujukKeluarModel->where('noRawat', $noRawat)->set($data)->update();
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function simpanData()
    {
        $data = [
            // Data Pasien & Petugas
            "idRujuk"           => $this->request->getPost("id"),
            "noRawat"              => $this->request->getPost("noRawat"),
            "namaTindakan"              => $this->request->getPost("namaTindakan"),
            "waktuTindakan"          => !empty($this->request->getPost("waktuTindakan")) ? $this->request->getPost("waktuTindakan") : null,
        ];

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->rm26bRujukKeluarDataModel->save($data);
            $this->catatLog('tambah', 'rm26b_rujuk_keluar_data', $this->rm26bRujukKeluarDataModel->getInsertID(), $this->rm26bRujukKeluarDataModel->where('id', $this->rm26bRujukKeluarDataModel->getInsertID())->first());
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function muatData()
    {
        echo json_encode($this->rm26bRujukKeluarDataModel->where('idRujuk', $this->request->getPost("id"))->findAll());
    }

    public function hapusData()
    {
        $id = $this->request->getPost("id");
        $this->catatLog('hapus', 'rm26b_rujuk_keluar_data', $id, $this->rm26bRujukKeluarDataModel->where('id', $id)->first());

        $this->rm26bRujukKeluarDataModel->where("id", $id)->delete();
        echo json_encode("");
    }

    public function ubahWaktu()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $waktu   = $this->request->getPost("waktu");

        $data = [
            "tglinput" => str_replace('T', ' ', $waktu) . ':00'
        ];

        $this->rm26bRujukKeluarModel->where('noRawat', $noRawat)->set($data)->update();
        echo json_encode('');
    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $this->catatLog('hapus', 'rm26i_penyimpanan_barang', $noRawat, $this->rm26bRujukKeluarModel->where('noRawat', $noRawat)->first());

        $this->rm26bRujukKeluarModel->where("noRawat", $noRawat)->delete();
        echo json_encode("");
    }


    public function cetak($noRawat)
    {
        $petugas = $this->petugasModel->where('nip !=', '-')->findAll();

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
                bangsal.nm_bangsal
            ')
            ->join('pasien', 'pasien.no_rkm_medis = reg_periksa.no_rkm_medis', 'left')
            ->join('kamar_inap', 'reg_periksa.no_rawat = kamar_inap.no_rawat', 'left')
            ->join('kamar', 'kamar_inap.kd_kamar = kamar.kd_kamar', 'left')
            ->join('bangsal', 'kamar.kd_bangsal = bangsal.kd_bangsal', 'left')
            ->where('reg_periksa.no_rawat', $noRawat)
            ->first();

        $rm26bRujukKeluar = $this->rm26bRujukKeluarModel->where('noRawat', $noRawat)->first();
        $rm26bRujukKeluarData = $this->rm26bRujukKeluarDataModel->where('idRujuk', $rm26bRujukKeluar['id'])->findAll();
        if ($rm26bRujukKeluar) {
            $rm26bRujukKeluar["tglTtd"] = $this->tanggalCetak($rm26bRujukKeluar["tglinput"]);
        }

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'petugas'     => $petugas,      // Jangan pakai (object) di sini
            'rm26bRujukKeluar' => $rm26bRujukKeluar,
            'rm26bRujukKeluarData' => $rm26bRujukKeluarData
        ];
        echo view("cetak/rm26bRujukKeluar", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function simpanTtd()
    {
        // Ambil input noRawat dan data canvas dari form
        $noRawat    = $this->request->getPost("noRawat");
        $noRawat = str_replace('/', '-', $noRawat);
        $ttdWali    = $this->request->getPost("ttdWali");
        $ttdSaksi    = $this->request->getPost("ttdSaksi");

        $lokasiFolder = 'rm26bRujukKeluar';

        $data = [
            "ttdWali" => $this->uploadTtd($ttdWali, $noRawat . '_wali', $lokasiFolder),
            "ttdSaksi" => $this->uploadTtd($ttdSaksi, $noRawat . '_saksi', $lokasiFolder)
        ];

        $noRawat = str_replace('-', '/', $noRawat);
        $this->rm26bRujukKeluarModel->where('noRawat', $noRawat)->set($data)->update();

        return $this->response->setJSON([
            'status'  => 'success'
        ]);
    }
}
