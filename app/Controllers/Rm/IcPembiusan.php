<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\IcPembiusanModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;

class IcPembiusan extends BaseController
{
    protected $regPeriksaModel;
    protected $icPembiusan;
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
        $this->icPembiusan = new IcPembiusanModel();
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

        $icPembiusan = $this->icPembiusan->where('noRawat', $noRawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'icPembiusan' => $icPembiusan,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/icPembiusan', ['data' => $data]);
    }

    public function simpan()
    {
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
            "saksi"      => $this->request->getPost("saksi"),
            "tindakanMedis"      => $this->request->getPost("tindakanMedis"),
            "jenis"      => $this->request->getPost("jenis"),

            "jenisAnestesi"      => $this->request->getPost("jenisAnestesi"),
            "isiKombinasi"      => $this->request->getPost("isiKombinasi"),
            "diagnosa"     => $this->request->getPost("diagnosa"),
            "indikasi"      => $this->request->getPost("indikasi"),
            "tataCara"      => $this->request->getPost("tataCara"),
            "tujuan"      => $this->request->getPost("tujuan"),
            "komplikasi"      => $this->request->getPost("komplikasi"),
            "risiko"      => $this->request->getPost("risiko"),
            "prognosis"     => $this->request->getPost("prognosis"),
            "alternatif"    => $this->request->getPost("alternatif"),
            "lainLain"    => $this->request->getPost("lainLain"),
        ];

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->icPembiusan->save($data);
        } else {
            $noRawat = $this->request->getPost("noRawat");
            unset($data['noRawat']);

            $this->catatLog('ubah', 'ic_pembiusan', $noRawat, $this->icPembiusan->where('noRawat', $noRawat)->first(), $data);

            $this->icPembiusan->where('noRawat', $noRawat)->set($data)->update();
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

        $this->icPembiusan->where('noRawat', $noRawat)->set($data)->update();
        echo json_encode('');
    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $this->catatLog('hapus', 'ic_pembiusan', $noRawat, $this->icPembiusan->where('noRawat', $noRawat)->first());

        $this->icPembiusan->where("noRawat", $noRawat)->delete();
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

        $icPembiusan = $this->icPembiusan->where('noRawat', $noRawat)->first();
        if ($icPembiusan) {
            $icPembiusan["tglTtd"] = $this->tanggalCetak($icPembiusan["tglinput"]);
        }

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'icPembiusan' => $icPembiusan
        ];
        echo view("cetak/icPembiusan", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function simpanTtd()
    {
        // Ambil input noRawat dan data canvas dari form
        $noRawat    = $this->request->getPost("noRawat");
        $noRawat = str_replace('/', '-', $noRawat);
        $ttdWali    = $this->request->getPost("ttdWali");
        $ttdSaksi    = $this->request->getPost("ttdSaksi");

        $lokasiFolder = 'icPembiusan';

        $data = [
            "ttdWali" => $this->uploadTtd($ttdWali, $noRawat . '_wali', $lokasiFolder),
            "ttdSaksi" => $this->uploadTtd($ttdSaksi, $noRawat . '_saksi', $lokasiFolder)
        ];

        $noRawat = str_replace('-', '/', $noRawat);
        $this->icPembiusan->where('noRawat', $noRawat)->set($data)->update();

        return $this->response->setJSON([
            'status'  => 'success'
        ]);
    }
}
