<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\PenerjemahModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;

class Penerjemah extends BaseController
{
    protected $regPeriksaModel;
    protected $penerjemahModel;
    protected $sysLog;
    protected $pengaturan;
    protected $pjPasienModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->penerjemahModel = new PenerjemahModel();
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->sysLog = new SysLogModel();
        $this->pengaturan = new PengaturanModel();
        $this->pjPasienModel = new PjPasienModel();
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
                pasien.tmp_lahir, 
                pasien.tgl_lahir
            ')
            ->join('pasien', 'pasien.no_rkm_medis = reg_periksa.no_rkm_medis', 'left')
            ->where('reg_periksa.no_rawat', $noRawat)
            ->first();

        $penerjemah = $this->penerjemahModel->where('noRawat', $noRawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,
            'penerjemah' => $penerjemah,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/penerjemah', ['data' => $data]);
    }

    public function simpan()
    {
        $data = [
            // Data Pasien & Petugas
            "noRawat"      => $this->request->getPost("noRawat"),
            "nama"         => $this->request->getPost("nama"),
            "jk"           => $this->request->getPost("jk"),
            "alamat"       => $this->request->getPost("alamat"),
            "sebagai"      => $this->request->getPost("sebagai"),
            "petugas"      => $this->request->getPost("petugas"),
            "tempatLahir"  => $this->request->getPost("tempatLahir"),
            // Validasi agar jika string kosong ('') diubah menjadi NULL
            "tanggalLahir" => !empty($this->request->getPost("tglLahir")) ? $this->request->getPost("tglLahir") : null,
            "nik"          => $this->request->getPost("nik"),
            "bahasa"       => $this->request->getPost("bahasa"),
            "noHp"         => $this->request->getPost("noHp"),
        ];

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->penerjemahModel->save($data);
            $this->catatLog('simpan', 'penerjemah', $this->request->getPost("noRawat"), $this->penerjemahModel->where('noRawat', $this->request->getPost("noRawat"))->first());
        } else {
            $noRawat = $this->request->getPost("noRawat");
            unset($data['noRawat']);

            $this->catatLog('ubah', 'penerjemah', $noRawat, $this->penerjemahModel->where('noRawat', $noRawat)->first(), $data);

            $this->penerjemahModel->where('noRawat', $noRawat)->set($data)->update();
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

        $this->penerjemahModel->where('noRawat', $noRawat)->set($data)->update();
        echo json_encode('');
    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $this->catatLog('hapus', 'ic_darah', $noRawat, $this->penerjemahModel->where('noRawat', $noRawat)->first());

        $this->penerjemahModel->where("noRawat", $noRawat)->delete();
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

        $penerjemah = $this->penerjemahModel->where('noRawat', $noRawat)->first();
        if ($penerjemah) {
            $penerjemah["tglTtd"] = $this->tanggalCetak($penerjemah["tglinput"]);
        }

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'penerjemah' => $penerjemah
        ];
        echo view("cetak/penerjemah", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function simpanTtd()
    {
        // Ambil input noRawat dan data canvas dari form
        $noRawat    = $this->request->getPost("noRawat");
        $noRawat = str_replace('/', '-', $noRawat);
        $ttdWali    = $this->request->getPost("ttdWali");

        $lokasiFolder = 'penerjemah';

        $data = [
            "ttdWali" => $this->uploadTtd($ttdWali, $noRawat . '_wali', $lokasiFolder)
        ];

        $noRawat = str_replace('-', '/', $noRawat);
        $this->penerjemahModel->where('noRawat', $noRawat)->set($data)->update();

        return $this->response->setJSON([
            'status'  => 'success'
        ]);
    }
}
