<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\Rm11b1ChecklistModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;
use App\Models\PetugasModel;

class Rm11b1Checklist extends BaseController
{
    protected $regPeriksaModel;
    protected $rm11b1ChecklistModel;
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
        $this->rm11b1ChecklistModel = new Rm11b1ChecklistModel();
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->sysLog = new SysLogModel();
        $this->pengaturan = new PengaturanModel();
        $this->pjPasienModel = new PjPasienModel();
        $this->dokterModel = new DokterModel();
        $this->petugasModel = new PetugasModel();
    }

    public function index($noRawat)
    {
        $dokter =  $this->dokterModel->where('kd_dokter !=', '-')->findAll();
        $petugas =  $this->petugasModel->where('nip !=', '-')->findAll();

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

        $rm11b1Checklist = $this->rm11b1ChecklistModel->where('noRawat', $noRawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'petugas'     => $petugas,      // Jangan pakai (object) di sini
            'rm11b1Checklist' => $rm11b1Checklist,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/rm11b1Checklist', ['data' => $data]);
    }

    public function simpan()
    {
        // Ambil tanggal dan validasi agar bernilai NULL jika kosong
        $tgl = $this->request->getPost("tgl");
        $tglValid = !empty($tgl) ? $tgl : null;

        $data = [
            // Data Utama
            "noRawat"                 => $this->request->getPost("noRawat"),

            // --- HEADER / GENERAL ---
            "ruang"                   => $this->request->getPost("ruang"),
            "tgl"                     => $tglValid,
            "jamSignIn"  => !empty($this->request->getPost("jamSignIn")) ? $this->request->getPost("jamSignIn") : null,
            "jamTimeOut" => !empty($this->request->getPost("jamTimeOut")) ? $this->request->getPost("jamTimeOut") : null,
            "jamSignOut" => !empty($this->request->getPost("jamSignOut")) ? $this->request->getPost("jamSignOut") : null,

            // --- TAB 1: SIGN IN ---
            "verifikasi"              => json_encode($this->request->getPost("verifikasi") ?? []),
            "dokterBedah"             => $this->request->getPost("dokterBedah"),
            "dokterAnestesi"          => $this->request->getPost("dokterAnestesi"),
            "namaTindakan"            => $this->request->getPost("namaTindakan"),
            "pemberian_tanda_pilihan" => $this->request->getPost("pemberian_tanda_pilihan"),
            "diagnosa"                => $this->request->getPost("diagnosa"),
            "kelengkapan"             => json_encode($this->request->getPost("kelengkapan") ?? []),
            "perawatAnestesi"         => $this->request->getPost("perawatAnestesi"),

            // Tanda Vital & Risiko
            "kesadaran"               => $this->request->getPost("kesadaran"),
            "tekananDarah"            => $this->request->getPost("tekananDarah"),
            "nadi"                    => $this->request->getPost("nadi"),
            "saturasiOksigen"         => $this->request->getPost("saturasiOksigen"),
            "suhu"                    => $this->request->getPost("suhu"),
            "skalaNyeri"              => $this->request->getPost("skalaNyeri"),
            "alergi"                  => $this->request->getPost("alergi"),
            "isiAlergi"               => $this->request->getPost("isiAlergi"),
            "aspirasi"                => $this->request->getPost("aspirasi"),
            "pendrahan"               => $this->request->getPost("pendrahan"),
            "rencanaAnestesi"         => json_encode($this->request->getPost("rencanaAnestesi") ?? []),

            // --- TAB 2: TIME OUT ---
            "verbal1"                 => json_encode($this->request->getPost("verbal1") ?? []),
            "fasilitasOperasi"        => $this->request->getPost("fasilitasOperasi"),
            "profilaksis"             => $this->request->getPost("profilaksis"),
            "profilaksisObat"         => $this->request->getPost("profilaksisObat"),
            "profilaksisJam"          => $this->request->getPost("profilaksisJam"),
            "profilaksisDosis"         => $this->request->getPost("profilaksisDosis"),
            "sirkuler"                => $this->request->getPost("sirkuler"),
            "instrumen"               => $this->request->getPost("instrumen"),
            "antisipasi1"             => $this->request->getPost("antisipasi1"),
            "antisipasi2"             => $this->request->getPost("antisipasi2"),
            "antisipasi31"            => $this->request->getPost("antisipasi31"),
            "antisipasi32"            => $this->request->getPost("antisipasi32"),
            "antisipasi33"            => $this->request->getPost("antisipasi33"),

            // --- TAB 3: SIGN OUT ---
            "verbal2"                 => $this->request->getPost("verbal2"),
            "kelengkapanOperasi"      => json_encode($this->request->getPost("kelengkapanOperasi") ?? []),
            "isiKelengkapanLainnya"   => $this->request->getPost("isiKelengkapanLainnya"),
            "preparat"                => $this->request->getPost("preparat"),
            "jenis"                   => json_encode($this->request->getPost("jenis") ?? []),
            "isijenisLainnya"         => $this->request->getPost("isijenisLainnya"),
            "formulir"                => $this->request->getPost("formulir"),
            "lengkapiIdentitas"       => $this->request->getPost("lengkapiIdentitas"),
            "asisten"                 => $this->request->getPost("asisten"),
            "perhatianOperator"       => $this->request->getPost("perhatianOperator"),
            "perhatianDokter"         => $this->request->getPost("perhatianDokter"),
            "perhatianPerawat"        => $this->request->getPost("perhatianPerawat"),
            "ruangPemulihan"          => $this->request->getPost("ruangPemulihan"),
            "periksaKembali"          => $this->request->getPost("periksaKembali"),
            "instruksiKhusus"         => $this->request->getPost("instruksiKhusus"),
            "operator"                => $this->request->getPost("operator"),
            "drAnestesi"              => $this->request->getPost("drAnestesi"),
        ];

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->rm11b1ChecklistModel->save($data);
            $this->catatLog('tambah', 'rm4_permintaan_masuk', $this->request->getPost("noRawat"), $this->rm11b1ChecklistModel->where('noRawat', $this->request->getPost("noRawat"))->first());
        } else {
            $noRawat = $this->request->getPost("noRawat");
            unset($data['noRawat']);

            $this->catatLog('ubah', 'rm4_permintaan_masuk', $noRawat, $this->rm11b1ChecklistModel->where('noRawat', $noRawat)->first(), $data);

            $this->rm11b1ChecklistModel->where('noRawat', $noRawat)->set($data)->update();
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

        $this->rm11b1ChecklistModel->where('noRawat', $noRawat)->set($data)->update();
        echo json_encode('');
    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $this->catatLog('hapus', 'ic_darah', $noRawat, $this->rm11b1ChecklistModel->where('noRawat', $noRawat)->first());

        $this->rm11b1ChecklistModel->where("noRawat", $noRawat)->delete();
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
                bangsal.nm_bangsal
            ')
            ->join('pasien', 'pasien.no_rkm_medis = reg_periksa.no_rkm_medis', 'left')
            ->join('kamar_inap', 'reg_periksa.no_rawat = kamar_inap.no_rawat', 'left')
            ->join('kamar', 'kamar_inap.kd_kamar = kamar.kd_kamar', 'left')
            ->join('bangsal', 'kamar.kd_bangsal = bangsal.kd_bangsal', 'left')
            ->where('reg_periksa.no_rawat', $noRawat)
            ->first();

        $rm11b1Checklist = $this->rm11b1ChecklistModel->where('noRawat', $noRawat)->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'rm11b1Checklist' => $rm11b1Checklist
        ];
        echo view("cetak/rm11b1Checklist", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function simpanTtd()
    {
        // Ambil input noRawat dari form
        $noRawatRaw = $this->request->getPost("noRawat");
        $noRawatFile = str_replace('/', '-', $noRawatRaw); // Untuk penamaan file
        $noRawatDb   = str_replace('-', '/', $noRawatRaw); // Untuk query Database

        $lokasiFolder = 'rm11b1Checklist';

        // Daftar 7 field TTD beserta suffix nama filenya
        $listTtd = [
            'ttdPerawatAnestesi' => '_perawat_anestesi',
            'ttdDokterAnestesi1' => '_dokter_anestesi_1',
            'ttdSirkuler'        => '_sirkuler',
            'ttdInstrumen'       => '_instrumen',
            'ttdAsisten'         => '_asisten',
            'ttdOperator'        => '_operator',
            'ttdDokterAnestesi2' => '_dokter_anestesi_2'
        ];

        // Ambil data eksisting dari Database
        $cekTtd = $this->rm11b1ChecklistModel->where('noRawat', $noRawatDb)->first();

        $dataToUpdate = [];

        // Loop penanganan upload & validasi TTD
        foreach ($listTtd as $field => $suffix) {
            $dataPost = $this->request->getPost($field);

            // Jika TTD di DB sudah ada/terkunci, skip (jangan di-overwrite)
            if (!empty($cekTtd[$field])) {
                continue;
            }

            // Jika ada inputan TTD baru dari AJAX, upload filenya
            if (!empty($dataPost)) {
                $namaFile = $noRawatFile . $suffix;
                $dataToUpdate[$field] = $this->uploadTtd($dataPost, $namaFile, $lokasiFolder);
            }
        }

        // Lakukan update ke DB hanya jika ada data TTD baru yang diunggah
        if (!empty($dataToUpdate)) {
            $this->rm11b1ChecklistModel->where('noRawat', $noRawatDb)->set($dataToUpdate)->update();
        }

        return $this->response->setJSON([
            'status' => 'success'
        ]);
    }
}
