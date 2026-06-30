<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\Rm0SbarModel;
use App\Models\Rm0SbarDataModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;
use App\Models\PetugasModel;

class Rm0Sbar extends BaseController
{
    protected $regPeriksaModel;
    protected $rm0SbarModel;
    protected $rm0SbarDataModel;
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
        $this->rm0SbarModel = new Rm0SbarModel();
        $this->rm0SbarDataModel = new Rm0SbarDataModel();
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->sysLog = new SysLogModel();
        $this->pengaturan = new PengaturanModel();
        $this->pjPasienModel = new PjPasienModel();
        $this->dokterModel = new DokterModel();
        $this->petugasModel = new PetugasModel();
    }

    public function index($noRawat, $id = 0)
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

        $rm0Sbar = $this->rm0SbarModel->where('id', $id)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'petugas'     => $petugas,      // Jangan pakai (object) di sini
            'rm0Sbar' => $rm0Sbar,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/rm0Sbar', ['data' => $data]);
    }

    public function simpanJudul()
    {
        $data = [
            // --- Data Pasien & Petugas ---
            "noRawat"                    => $this->request->getPost("noRawat"),
            "judul"                  => $this->request->getPost("judul") ?? '',
        ];

        // =====================================================================

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->rm0SbarModel->save($data);

            $nilaiBalik = $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Data berhasil disimpan',
                'id'      => $this->rm0SbarModel->getInsertID()
            ]);
        } else {
            $id = $this->request->getPost("id");
            unset($data['noRawat']);

            $this->catatLog('ubah', 'rm0_sbar', $id, $this->rm0SbarModel->where('id', $id)->first(), $data);

            $this->rm0SbarModel->where('id', $id)->set($data)->update();

            $nilaiBalik = $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Data berhasil disimpan',
                'id'      => $id
            ]);
        }

        return $nilaiBalik;
    }

    public function simpan()
    {
        $data = [
            // --- Data Pasien & Petugas ---
            "idSbar"                    => $this->request->getPost("idSbar"),
            "petugas"                      => $this->request->getPost("petugas"),
            "dokter"                      => $this->request->getPost("dokter"),
            "waktu" => date('Y-m-d H:i:s', strtotime($this->request->getPost("waktu"))),

            "s"                     => $this->request->getPost("s") ?? '',
            "b"                  => $this->request->getPost("b") ?? '',
            "a"                  => $this->request->getPost("a") ?? '',
            "r"                  => $this->request->getPost("r") ?? '',
        ];

        // =====================================================================

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->rm0SbarDataModel->save($data);

            $nilaiBalik = $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Data berhasil disimpan',
                'id'      => $this->rm0SbarModel->getInsertID()
            ]);
        } else {
            $id = $this->request->getPost("id");

            $this->catatLog('ubah', 'rm0_sbar_data', $id, $this->rm0SbarDataModel->where('id', $id)->first(), $data);

            $this->rm0SbarDataModel->where('id', $id)->set($data)->update();

            $nilaiBalik = $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Data berhasil disimpan',
                'id'      => $id
            ]);
        }

        return $nilaiBalik;
    }

    public function muatData()
    {
        echo json_encode($this->rm0SbarDataModel->where('idSbar', $this->request->getPost("idSbar"))->findAll());
    }

    public function lihat()
    {
        echo json_encode($this->rm0SbarDataModel->where('id', $this->request->getPost("id"))->first());
    }

    public function verif()
    {
        $this->rm0SbarDataModel->where('id', $this->request->getPost("id"))->set(["tglVerif" => date('Y-m-d H:i:s')])->update();
        echo json_encode(["status" => "success"]);
    }

    public function hapus()
    {
        $id = $this->request->getPost("id");
        $this->catatLog('hapus', 'rm0_sbar_data', $id, $this->rm0SbarDataModel->where('id', $id)->first());

        $this->rm0SbarDataModel->where("id", $id)->delete();
        echo json_encode("");
    }

    public function hapusJudul()
    {
        $id = $this->request->getPost("id");
        $this->catatLog('hapus', 'rm0_sbar', $id, $this->rm0SbarModel->where('id', $id)->first());

        $this->rm0SbarModel->where("id", $id)->delete();
        echo json_encode("");
    }


    public function cetak($noRawat, $id)
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

        $rm0Sbar = $this->rm0SbarModel->where('id', $id)->first();
        $rm0SbarData = $this->rm0SbarDataModel->where('idSbar', $id)->findAll();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'rm0Sbar' => $rm0Sbar,
            'rm0SbarData' => $rm0SbarData
        ];
        echo view("cetak/rm0Sbar", ["data" => $data]);

        // Load the view file and get its HTML content

    }
}
