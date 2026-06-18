<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\PersetujuanRanapModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;

class PersetujuanRanap extends BaseController
{
    protected $regPeriksaModel;
    protected $persetujuanRanapModel;
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
        $this->persetujuanRanapModel = new PersetujuanRanapModel();
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
                pasien.tgl_lahir
            ')
            ->join('pasien', 'pasien.no_rkm_medis = reg_periksa.no_rkm_medis', 'left')
            ->where('reg_periksa.no_rawat', $noRawat)
            ->first();

        $persetujuanRanap = $this->persetujuanRanapModel->where('noRawat', $pasien["no_rawat"])->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'persetujuanRanap' => $persetujuanRanap,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/persetujuanRanap', ['data' => $data]);
    }

    public function simpan()
    {
        // Satukan semua struktur data form baru ke dalam array simpan database
        $data = [
            // 1. DATA PASIEN & UTAMA
            "noRawat"              => $this->request->getPost("noRawat"),
            "namaWali"             => $this->request->getPost("namaWali"),
            "noTelp"               => $this->request->getPost("noTelp"),
            "alamat"               => $this->request->getPost("alamat"),
            "sebagai"              => $this->request->getPost("sebagai"),
            "petugas"              => $this->request->getPost("petugas"),
            "saksi"                => $this->request->getPost("saksi"),

            // 2. DATA PRIVASI & PELEPASAN INFORMASI
            "dokter"               => $this->request->getPost("dokter"),
            "namaKeluarga"         => $this->request->getPost("namaKeluarga"),
            "izin_jenguk"          => $this->request->getPost("izin_jenguk"),
            "isi_kecuali"          => $this->request->getPost("isi_kecuali"),

            // 3. JALUR KEWAJIBAN PEMBAYARAN
            "jenis_pasien"         => $this->request->getPost("jenis_pasien"),

            // Sub-opsi Jalur UMUM
            "status_asuransi_umum" => $this->request->getPost("status_asuransi_umum"),
            "kelas_umum"           => $this->request->getPost("kelas_umum"),
            "kelas_umum_lain_text" => $this->request->getPost("kelas_umum_lain_text"),
            "biaya_min"            => $this->request->getPost("biaya_min"),
            "biaya_max"            => $this->request->getPost("biaya_max"),

            // Sub-opsi Jalur BPJS
            "no_bpjs"              => $this->request->getPost("no_bpjs"),
            "bpjs_status_kelas"    => $this->request->getPost("bpjs_status_kelas"),
            "bpjs_naik_tingkat"    => $this->request->getPost("bpjs_naik_tingkat"),

            // Sub-opsi Jalur ASURANSI LAIN
            "nama_asuransi_lain"   => $this->request->getPost("nama_asuransi_lain"),
        ];

        // Cek aksi berdasarkan variabel tujuanSimpan
        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            // Gunakan model persetujuanRanapModel
            $this->persetujuanRanapModel->save($data);
        } else {
            $noRawat = $this->request->getPost("noRawat");
            unset($data['noRawat']); // Hapus primary key dari array update data

            // Catat ke log dengan nama tabel database 'persetujuan_ranap'
            $this->catatLog('ubah', 'persetujuan_ranap', $noRawat, $this->persetujuanRanapModel->where('noRawat', $noRawat)->first(), $data);

            $this->persetujuanRanapModel->where('noRawat', $noRawat)->set($data)->update();
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }


    public function ubahWaktu()
    {
        $noRawat = $this->request->getPost("noRawat");
        $waktu   = $this->request->getPost("waktu");

        $data = [
            "tglinput" => str_replace('T', ' ', $waktu) . ':00'
        ];

        $this->persetujuanRanapModel->where('noRawat', $noRawat)->set($data)->update();
        echo json_encode('');
    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $this->catatLog('hapus', 'persetujuan_rajal', $noRawat, $this->persetujuanRanapModel->where('noRawat', $noRawat)->first());

        $this->persetujuanRanapModel->where("noRawat", $noRawat)->delete();
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
                pasien.tgl_lahir
            ')
            ->join('pasien', 'pasien.no_rkm_medis = reg_periksa.no_rkm_medis', 'left')
            ->where('reg_periksa.no_rawat', $noRawat)
            ->first();

        $persetujuanRanap = $this->persetujuanRanapModel->where('noRawat', $pasien["no_rawat"])->first();
        if ($persetujuanRanap) {
            $persetujuanRanap["tglTtd"] = $this->tanggalCetak($persetujuanRanap["tglinput"]);
        }

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'persetujuanRanap' => $persetujuanRanap
        ];
        echo view("cetak/persetujuanRanap", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function simpanTtd()
    {
        // Ambil input noRawat dan data canvas dari form
        $noRawat    = $this->request->getPost("noRawat");
        $ttdSaksi   = $this->request->getPost("ttdSaksi");
        $ttdWali    = $this->request->getPost("ttdWali");

        $lokasiFolder = 'persetujuanRanap';

        $noRawat = str_replace('/', '-', $noRawat);

        $data = [
            "ttdWali" => $this->uploadTtd($ttdWali, $noRawat . '_wali', $lokasiFolder),
            "ttdSaksi" => $this->uploadTtd($ttdSaksi, $noRawat . '_saksi', $lokasiFolder)
        ];


        $noRawat = str_replace('-', '/', $noRawat);

        $this->persetujuanRanapModel->where('noRawat', $noRawat)->set($data)->update();

        return $this->response->setJSON([
            'status'  => 'success'
        ]);
    }
}
