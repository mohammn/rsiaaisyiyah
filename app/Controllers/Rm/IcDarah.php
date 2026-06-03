<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\IcDarahModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;

class IcDarah extends BaseController
{
    protected $regPeriksaModel;
    protected $icDarahModel;
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
        $this->icDarahModel = new IcDarahModel();
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

        $icDarah = $this->icDarahModel->where('noRawat', $noRawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'icDarah' => $icDarah,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/icDarah', ['data' => $data]);
    }

    public function simpan()
    {
        // Ambil dulu datanya secara murni ke dalam variabel terpisah
        $postDarah    = $this->request->getPost("darah");
        $postIndikasi = $this->request->getPost("indikasi");

        $data = [
            // Data Pasien & Petugas (Lama)
            "noRawat"       => $this->request->getPost("noRawat"),
            "nama"          => $this->request->getPost("nama"),
            "jk"            => $this->request->getPost("jk"),
            "alamat"        => $this->request->getPost("alamat"),
            "sebagai"       => $this->request->getPost("sebagai"),
            "petugas"       => $this->request->getPost("petugas"),
            "tempatLahir"   => $this->request->getPost("tempatLahir"),
            "tanggalLahir"  => $this->request->getPost("tglLahir"),
            "dokter"        => $this->request->getPost("dokter"),
            "nik"           => $this->request->getPost("nik"),
            "saksi"         => $this->request->getPost("saksi"),
            "tindakanMedis" => $this->request->getPost("tindakanMedis"),

            // Kolom tambahan Baru (Disesuaikan agar membaca array post dengan aman)
            "darah"         => (!empty($postDarah) && is_array($postDarah)) ? implode('|', $postDarah) : null,
            "indikasi"      => (!empty($postIndikasi) && is_array($postIndikasi)) ? implode('|', $postIndikasi) : null,
        ];

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->icDarahModel->save($data);
        } else {
            $noRawat = $this->request->getPost("noRawat");
            unset($data['noRawat']);

            $this->catatLog('ubah', 'ic_darah', $noRawat, $this->icDarahModel->where('noRawat', $noRawat)->first(), $data);

            $this->icDarahModel->where('noRawat', $noRawat)->set($data)->update();
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

        $this->icDarahModel->where('noRawat', $noRawat)->set($data)->update();
        echo json_encode('');
    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $this->catatLog('hapus', 'ic_darah', $noRawat, $this->icDarahModel->where('noRawat', $noRawat)->first());

        $this->icDarahModel->where("noRawat", $noRawat)->delete();
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

        $icDarah = $this->icDarahModel->where('noRawat', $noRawat)->first();
        if ($icDarah) {
            $icDarah["tglTtd"] = $this->tanggalCetak($icDarah["tglinput"]);
        }

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'icDarah' => $icDarah
        ];
        echo view("cetak/icDarah", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function simpanTtd()
    {
        // Ambil input noRawat dan data canvas dari form
        $noRawat    = $this->request->getPost("noRawat");
        $noRawat = str_replace('/', '-', $noRawat);
        $ttdWali    = $this->request->getPost("ttdWali");
        $ttdSaksi    = $this->request->getPost("ttdSaksi");

        $lokasiFolder = 'icDarah';

        $data = [
            "ttdWali" => $this->uploadTtd($ttdWali, $noRawat . '_wali', $lokasiFolder),
            "ttdSaksi" => $this->uploadTtd($ttdSaksi, $noRawat . '_saksi', $lokasiFolder)
        ];

        $noRawat = str_replace('-', '/', $noRawat);
        $this->icDarahModel->where('noRawat', $noRawat)->set($data)->update();

        return $this->response->setJSON([
            'status'  => 'success'
        ]);
    }
}
