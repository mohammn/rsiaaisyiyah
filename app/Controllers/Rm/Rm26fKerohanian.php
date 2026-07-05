<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\Rm26fKerohanianModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;

class Rm26fKerohanian extends BaseController
{
    protected $regPeriksaModel;
    protected $rm26fKerohanianModel;
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
        $this->rm26fKerohanianModel = new Rm26fKerohanianModel();
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

        $rm26fKerohanian = $this->rm26fKerohanianModel->where('noRawat', $noRawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'rm26fKerohanian' => $rm26fKerohanian,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/rm26fKerohanian', ['data' => $data]);
    }

    public function simpan()
    {
        $data = [
            // Data Pasien & Petugas
            "noRawat"           => $this->request->getPost("noRawat"),
            "nama"              => $this->request->getPost("nama"),
            "jk"                => $this->request->getPost("jk"),
            "tempatLahir"       => $this->request->getPost("tempatLahir"),
            "tanggalLahir"      => $this->request->getPost("tglLahir"), // Menangkap dari JS 'tglLahir'
            "nik"               => $this->request->getPost("nik"),
            "alamat"            => $this->request->getPost("alamat"),
            "sebagai"           => $this->request->getPost("sebagai"),

            // Pemberian Informasi & Detail Izin
            "petugas"           => $this->request->getPost("petugas"),
            "petugasKerohanian" => $this->request->getPost("petugasKerohanian"), // TAMBAHAN: Menangkap input petugas kerohanian
            "waktu"      => $this->request->getPost("waktu"),
            "noHp"              => $this->request->getPost("noHp"), // Menangkap dari JS 'noHp'
        ];

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->rm26fKerohanianModel->save($data);
        } else {
            $noRawat = $this->request->getPost("noRawat");
            unset($data['noRawat']);

            $this->catatLog('ubah', 'ic_sesar', $noRawat, $this->rm26fKerohanianModel->where('noRawat', $noRawat)->first(), $data);

            $this->rm26fKerohanianModel->where('noRawat', $noRawat)->set($data)->update();
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

        $this->rm26fKerohanianModel->where('noRawat', $noRawat)->set($data)->update();
        echo json_encode('');
    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $this->catatLog('hapus', 'ic_darah', $noRawat, $this->rm26fKerohanianModel->where('noRawat', $noRawat)->first());

        $this->rm26fKerohanianModel->where("noRawat", $noRawat)->delete();
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

        $rm26fKerohanian = $this->rm26fKerohanianModel->where('noRawat', $noRawat)->first();
        if ($rm26fKerohanian) {
            $rm26fKerohanian["tglTtd"] = $this->tanggalCetak($rm26fKerohanian["tglinput"]);
        }

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'rm26fKerohanian' => $rm26fKerohanian
        ];
        echo view("cetak/rm26fKerohanian", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function simpanTtd()
    {
        // Ambil input noRawat dan data canvas dari form
        $noRawat    = $this->request->getPost("noRawat");
        $noRawat = str_replace('/', '-', $noRawat);
        $ttdWali    = $this->request->getPost("ttdWali");
        $ttdSaksi    = $this->request->getPost("ttdSaksi");

        $lokasiFolder = 'rm26fKerohanian';

        $data = [
            "ttdWali" => $this->uploadTtd($ttdWali, $noRawat . '_wali', $lokasiFolder),
            "ttdSaksi" => $this->uploadTtd($ttdSaksi, $noRawat . '_saksi', $lokasiFolder)
        ];

        $noRawat = str_replace('-', '/', $noRawat);
        $this->rm26fKerohanianModel->where('noRawat', $noRawat)->set($data)->update();

        return $this->response->setJSON([
            'status'  => 'success'
        ]);
    }
}
