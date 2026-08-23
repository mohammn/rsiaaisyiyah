<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\Rm26jRujukanLuarModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;
use App\Models\ResepPulangModel;
use App\Models\DpjpModel;

class Rm26jRujukanLuar extends BaseController
{
    protected $regPeriksaModel;
    protected $rm26jRujukanLuarModel;
    protected $sysLog;
    protected $pengaturan;
    protected $pjPasienModel;
    protected $dokterModel;
    protected $resepPulangModel;
    protected $dpjpModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->rm26jRujukanLuarModel = new Rm26jRujukanLuarModel();
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->sysLog = new SysLogModel();
        $this->pengaturan = new PengaturanModel();
        $this->pjPasienModel = new PjPasienModel();
        $this->dokterModel = new DokterModel();
        $this->resepPulangModel = new ResepPulangModel();
        $this->dpjpModel = new DpjpModel();
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
        $dpjp = $this->dpjpModel->where('noRawat', $noRawat)->first();

        $rm26jRujukanLuar = $this->rm26jRujukanLuarModel->where('noRawat', $noRawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $resepPulang = $this->resepPulangModel->getResepByNoRawat($noRawat);
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'rm26jRujukanLuar' => $rm26jRujukanLuar,
            'resepPulang' => $resepPulang,
            'pjPasien' => $pjPasien,
            'dpjp'     => $dpjp,
            'pengaturan' => $pengaturan
        ];

        return view('rm/rm26jRujukanLuar', ['data' => $data]);
    }

    public function simpan()
    {
        $data = [
            // Data Pasien & Petugas
            "noRawat"             => $this->request->getPost("noRawat"),
            "petugas"             => $this->request->getPost("petugas"),
            "nama"                => $this->request->getPost("nama"),
            "umur"                => $this->request->getPost("umur"),

            // Data Umum
            "asal"                => $this->request->getPost("asal"),
            "alasan"              => $this->request->getPost("alasan"),
            "keadaan"             => $this->request->getPost("keadaan"),
            "kesadaran"           => $this->request->getPost("kesadaran"),
            "terapi"              => $this->request->getPost("terapi"),
            "tindakan"            => $this->request->getPost("tindakan"),

            // Handover
            "handOver"            => $this->request->getPost("handOver"),
            "isiHandOverLainLain" => $this->request->getPost("isiHandOverLainLain"),

            // Keterangan Bidan Penerima
            "keteranganBidan"     => $this->request->getPost("keteranganBidan"),
            "alasanKeterangan"    => $this->request->getPost("alasanKeterangan"),

            // Data Vital & Diagnosa
            "diagnosa"            => $this->request->getPost("diagnosa"),
            "td_sistol"           => $this->request->getPost("td_sistol"),
            "td_diastol"          => $this->request->getPost("td_diastol"),
            "nadi"                => $this->request->getPost("nadi"),
            "suhu"                => $this->request->getPost("suhu"),
            "rr"                  => $this->request->getPost("rr"),
            "tfu"                 => $this->request->getPost("tfu"),
            "djj"                 => $this->request->getPost("djj"),
            "his"                 => $this->request->getPost("his"),
            "vt"                  => $this->request->getPost("vt"),
        ];

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->rm26jRujukanLuarModel->save($data);
            $this->catatLog('tambah', 'rm26j_rujukan_luar', $this->request->getPost("noRawat"), $this->rm26jRujukanLuarModel->where('noRawat', $this->request->getPost("noRawat"))->first());
        } else {
            $noRawat = $this->request->getPost("noRawat");
            unset($data['noRawat']);

            $this->catatLog('ubah', 'rm26j_rujukan_luar', $noRawat, $this->rm26jRujukanLuarModel->where('noRawat', $noRawat)->first(), $data);

            $this->rm26jRujukanLuarModel->where('noRawat', $noRawat)->set($data)->update();
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

        $this->rm26jRujukanLuarModel->where('noRawat', $noRawat)->set($data)->update();
        echo json_encode('');
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

        $rm26jRujukanLuar = $this->rm26jRujukanLuarModel->where('noRawat', $noRawat)->first();
        if ($rm26jRujukanLuar) {
            $rm26jRujukanLuar["tglTtd"] = $this->tanggalCetak($rm26jRujukanLuar["tglinput"]);
        }

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $resepPulang = $this->resepPulangModel->getResepByNoRawat($noRawat);
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'rm26jRujukanLuar' => $rm26jRujukanLuar,
            'resepPulang' => $resepPulang,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];
        echo view("cetak/rm26jRujukanLuar", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $this->catatLog('hapus', 'rm26j_rujukan_luar', $noRawat, $this->rm26jRujukanLuarModel->where('noRawat', $noRawat)->first());

        $this->rm26jRujukanLuarModel->where("noRawat", $noRawat)->delete();
        echo json_encode("");
    }

    public function simpanTtd()
    {
        // Ambil input noRawat dan data canvas dari form
        $noRawat    = $this->request->getPost("noRawat");
        $noRawat = str_replace('/', '-', $noRawat);
        $ttdWali    = $this->request->getPost("ttdWali");

        $lokasiFolder = 'rm26jRujukanLuar';

        $data = [
            "ttdWali" => $this->uploadTtd($ttdWali, $noRawat . '_wali', $lokasiFolder),
        ];

        $noRawat = str_replace('-', '/', $noRawat);
        $this->rm26jRujukanLuarModel->where('noRawat', $noRawat)->set($data)->update();

        return $this->response->setJSON([
            'status'  => 'success'
        ]);
    }
}
