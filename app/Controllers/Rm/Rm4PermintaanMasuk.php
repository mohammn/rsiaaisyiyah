<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\Rm4PermintaanMasukModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;

class Rm4PermintaanMasuk extends BaseController
{
    protected $regPeriksaModel;
    protected $rm4PermintaanMasukModel;
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
        $this->rm4PermintaanMasukModel = new Rm4PermintaanMasukModel();
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

        $rm4PermintaanMasuk = $this->rm4PermintaanMasukModel->where('noRawat', $noRawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'rm4PermintaanMasuk' => $rm4PermintaanMasuk,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/rm4PermintaanMasuk', ['data' => $data]);
    }

    public function simpan()
    {
        $data = [
            // Data Pasien & Petugas
            "noRawat"       => $this->request->getPost("noRawat"),

            // --- DATA PENANGGUNG JAWAB (Form Kiri) ---
            "nama"          => $this->request->getPost("nama"),
            "noKartu"       => $this->request->getPost("noKartu"),
            "noSep"         => $this->request->getPost("noSep"),
            "biaya"         => $this->request->getPost("biaya"),
            "isiBiayaLain"  => $this->request->getPost("isiBiayaLain"),

            // --- PEMBERIAN INFORMASI (Form Kanan) ---
            "tglMasuk"      => $this->request->getPost("tglMasuk"),
            "ruang"         => $this->request->getPost("ruang"),
            "petugas"       => $this->request->getPost("petugas"),
            "dokter"        => $this->request->getPost("dokter"),
            "diagnosa"      => $this->request->getPost("diagnosa"),
        ];

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->rm4PermintaanMasukModel->save($data);
            $this->catatLog('tambah', 'rm4_permintaan_masuk', $this->request->getPost("noRawat"), $this->rm4PermintaanMasukModel->where('noRawat', $this->request->getPost("noRawat"))->first());
        } else {
            $noRawat = $this->request->getPost("noRawat");
            unset($data['noRawat']);

            $this->catatLog('ubah', 'rm4_permintaan_masuk', $noRawat, $this->rm4PermintaanMasukModel->where('noRawat', $noRawat)->first(), $data);

            $this->rm4PermintaanMasukModel->where('noRawat', $noRawat)->set($data)->update();
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

        $this->rm4PermintaanMasukModel->where('noRawat', $noRawat)->set($data)->update();
        echo json_encode('');
    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $this->catatLog('hapus', 'ic_darah', $noRawat, $this->rm4PermintaanMasukModel->where('noRawat', $noRawat)->first());

        $this->rm4PermintaanMasukModel->where("noRawat", $noRawat)->delete();
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

        $rm4PermintaanMasuk = $this->rm4PermintaanMasukModel->where('noRawat', $noRawat)->first();
        if ($rm4PermintaanMasuk) {
            $rm4PermintaanMasuk["tglTtd"] = $this->tanggalCetak($rm4PermintaanMasuk["tglinput"]);
        }

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'rm4PermintaanMasuk' => $rm4PermintaanMasuk
        ];
        echo view("cetak/rm4PermintaanMasuk", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function simpanTtd()
    {
        // Ambil input noRawat dan data canvas dari form
        $noRawat    = $this->request->getPost("noRawat");
        $noRawat = str_replace('/', '-', $noRawat);
        $ttdWali    = $this->request->getPost("ttdWali");
        $ttdDokter    = $this->request->getPost("ttdDokter");
        $ttdPetugas    = $this->request->getPost("ttdPetugas");

        $lokasiFolder = 'rm4PermintaanMasuk';

        $data = [
            "ttdWali" => $this->uploadTtd($ttdWali, $noRawat . '_wali', $lokasiFolder),
            "ttdDokter" => $this->uploadTtd($ttdDokter, $noRawat . '_dokter', $lokasiFolder),
            "ttdPetugas" => $this->uploadTtd($ttdPetugas, $noRawat . '_petugas', $lokasiFolder)
        ];

        $noRawat = str_replace('-', '/', $noRawat);
        $cekTtd = $this->rm4PermintaanMasukModel->where('noRawat', $noRawat)->first();
        if ($cekTtd['ttdWali']) {
            unset($data['ttdWali']);
        }
        if ($cekTtd['ttdDokter']) {
            unset($data['ttdDokter']);
        }
        if ($cekTtd['ttdPetugas']) {
            unset($data['ttdPetugas']);
        }
        $this->rm4PermintaanMasukModel->where('noRawat', $noRawat)->set($data)->update();

        return $this->response->setJSON([
            'status'  => 'success'
        ]);
    }
}
