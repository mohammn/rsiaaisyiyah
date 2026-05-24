<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\DpjpModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;

class Dpjp extends BaseController
{
    protected $regPeriksaModel;
    protected $dpjpModel;
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
        $this->dpjpModel = new DpjpModel();
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->sysLog = new SysLogModel();
        $this->pengaturan = new PengaturanModel();
        $this->pjPasienModel = new PjPasienModel();
        $this->dokterModel = new DokterModel();
    }

    public function index($noRawat)
    {
        $dokter =  $this->dokterModel->where('kd_dokter !=', '-')->findAll();

        $no_rawat = str_replace('-', '/', $noRawat);
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
            ->where('reg_periksa.no_rawat', $no_rawat)
            ->first();

        $dpjp = $this->dpjpModel->where('noRawat', $no_rawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'dpjp' => $dpjp,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/dpjp', ['data' => $data]);
    }

    public function tambah()
    {
        $tglLahir = new \DateTime($this->request->getPost('tglLahir'));
        $today = new \DateTime();

        $data = [
            "noRawat" => $this->request->getPost("noRawat"),
            "nama" => $this->request->getPost("nama"),
            "jk" => $this->request->getPost("jk"),
            "umur" => $today->diff($tglLahir)->y,
            "alamat" => $this->request->getPost("alamat"),
            "sebagai" => $this->request->getPost("sebagai"),
            "petugas" => $this->request->getPost("petugas"),
            "tempatLahir" => $this->request->getPost("tempatLahir"),
            "tanggalLahir" => $this->request->getPost("tglLahir"),
            "dokter" => $this->request->getPost("dokter")
        ];

        $this->dpjpModel->save($data);

        echo json_encode("");
    }

    public function ubahWaktu()
    {
        $noRawat = $this->request->getPost("noRawat");
        $waktu   = $this->request->getPost("waktu");

        $data = [
            "tglinput" => str_replace('T', ' ', $waktu) . ':00'
        ];

        $this->dpjpModel->where('noRawat', $noRawat)->set($data)->update();
        echo json_encode('');
    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $this->catatLog('hapus', 'dpjp', $noRawat, $this->dpjpModel->where('noRawat', $noRawat)->first());

        $this->dpjpModel->where("noRawat", $noRawat)->delete();
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
                pasien.tgl_lahir
            ')
            ->join('pasien', 'pasien.no_rkm_medis = reg_periksa.no_rkm_medis', 'left')
            ->where('reg_periksa.no_rawat', $noRawat)
            ->first();

        $dpjp = $this->dpjpModel->where('noRawat', $noRawat)->first();
        if ($dpjp) {
            $dpjp["tglTtd"] = $this->tanggalCetak($dpjp["tglinput"]);
        }

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dpjp' => $dpjp
        ];
        echo view("cetak/dpjp", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function simpanTtd()
    {
        // Ambil input noRawat dan data canvas dari form
        $noRawat    = $this->request->getPost("noRawat");
        $ttdWali    = $this->request->getPost("ttdWali");

        $noRawatClean = str_replace(['/', ' '], '-', $noRawat);
        $lokasiFolder = 'dpjp';

        $data = [
            "ttdWali" => $this->uploadTtd($ttdWali, $noRawatClean . '_wali', $lokasiFolder)
        ];

        $this->dpjpModel->where('noRawat', $noRawat)->set($data)->update();

        return $this->response->setJSON([
            'status'  => 'success'
        ]);
    }
}
