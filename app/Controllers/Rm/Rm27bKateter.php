<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\Rm27bKateterModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;
use App\Models\PetugasModel;

class Rm27bKateter extends BaseController
{
    protected $regPeriksaModel;
    protected $rm27bKateterModel;
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
        $this->rm27bKateterModel = new Rm27bKateterModel();
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

        $rm27bKateter = $this->rm27bKateterModel->where('noRawat', $noRawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'petugas'     => $petugas,      // Jangan pakai (object) di sini
            'rm27bKateter' => $rm27bKateter,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/rm27bKateter', ['data' => $data]);
    }

    public function simpan()
    {


        // 1. Definisikan data dasar Anda terlebih dahulu
        $data = [
            // --- Data Pasien & Petugas ---
            "noRawat"                    => $this->request->getPost("noRawat"),
            "jumlahPengunci"                      => $this->request->getPost("jumlahPengunci"),

            "jenisCath"                     => $this->request->getPost("jenisCath") ?? '',
            "isiJenisCath"                  => $this->request->getPost("isiJenisCath") ?? '',

            "ivCath"                     => $this->request->getPost("ivCath") ?? '',
            "isiivCath"                  => $this->request->getPost("isiivCath") ?? '',
        ];

        // =========================================================================
        // 2. Loop otomatis untuk menangkap c1 sampai c17 (Checkbox Hari)
        // =========================================================================
        for ($i = 1; $i <= 19; $i++) {
            $key = "c" . $i;
            $hariTerpilih = $this->request->getPost($key) ?? [];

            // Simpan dalam bentuk string dipisah koma (misal: "1,2,5")
            $data[$key] = !empty($hariTerpilih) ? implode(",", $hariTerpilih) : "";
        }

        // =========================================================================
        // 3. Loop untuk memecah array "keterangan" menjadi 17 kolom (ket1 sampai ket17)
        // =========================================================================
        $listKeterangan = $this->request->getPost("keterangan") ?? [];
        for ($k = 1; $k <= 19; $k++) {
            // Karena indeks array di JS dimulai dari 0, maka kita ambil indeks ($k - 1)
            $data["ket" . $k] = $listKeterangan[$k - 1] ?? '';
        }

        // =========================================================================
        // 4. Loop otomatis untuk menangkap petugas1 sampai petugas31
        // =========================================================================
        for ($j = 1; $j <= 10; $j++) {
            $data["petugas" . $j] = $this->request->getPost("petugas" . $j) ?? '';
            $data["tgl" . $j] = $this->request->getPost("tgl" . $j) ?? '';
        }


        // =====================================================================

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->rm27bKateterModel->save($data);
        } else {
            $noRawat = $this->request->getPost("noRawat");
            unset($data['noRawat']);

            $this->catatLog('ubah', 'rm27c_plebitis', $noRawat, $this->rm27bKateterModel->where('noRawat', $noRawat)->first(), $data);

            $this->rm27bKateterModel->where('noRawat', $noRawat)->set($data)->update();
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
        $this->catatLog('hapus', 'rm27c_plebitis', $noRawat, $this->rm27bKateterModel->where('noRawat', $noRawat)->first());

        $this->rm27bKateterModel->where("noRawat", $noRawat)->delete();
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

        $rm27bKateter = $this->rm27bKateterModel->where('noRawat', $noRawat)->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'rm27bKateter' => $rm27bKateter
        ];
        echo view("cetak/rm27bKateter", ["data" => $data]);

        // Load the view file and get its HTML content

    }
}
