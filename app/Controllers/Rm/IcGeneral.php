<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\IcGeneralModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;

class IcGeneral extends BaseController
{
    protected $regPeriksaModel;
    protected $icGeneralModel;
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
        $this->icGeneralModel = new IcGeneralModel();
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->sysLog = new SysLogModel();
        $this->pengaturan = new PengaturanModel();
        $this->pjPasienModel = new PjPasienModel();
        $this->dokterModel = new DokterModel();
    }

    public function index($noRawat, $id = null)
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

        $icGeneral = $this->icGeneralModel->where('id', $id)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'icGeneral' => $icGeneral,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/icGeneral', ['data' => $data]);
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
            "tindakanMedis"      => $this->request->getPost("tindakanMedis"),
            "saksi"      => $this->request->getPost("saksi"),
            "judul"      => $this->request->getPost("judul"),

            "jenis"      => $this->request->getPost("jenis"),

            // 11 Data Pemberian Informasi (Baru)
            "diagnosis"     => $this->request->getPost("diagnosis"),
            "dasar"         => $this->request->getPost("dasar"),
            "tindakan"      => $this->request->getPost("tindakan"),
            "indikasi"      => $this->request->getPost("indikasi"),
            "tataCara"      => $this->request->getPost("tataCara"),
            "tujuan"        => $this->request->getPost("tujuan"),
            "risiko"        => $this->request->getPost("risiko"),
            "komplikasi"    => $this->request->getPost("komplikasi"),
            "prognosis"     => $this->request->getPost("prognosis"),
            "alternatif"    => $this->request->getPost("alternatif"),
            "lainLain"      => $this->request->getPost("lainLain"),
        ];

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->icGeneralModel->save($data);
            $id = $this->icGeneralModel->getInsertID();
        } else {
            $id = $this->request->getPost("tujuanSimpan");
            unset($data['noRawat']);
            $this->icGeneralModel->where('id', $id)->set($data)->update();
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil disimpan',
            'id'      => $id
        ]);
    }

    public function ubahWaktu()
    {
        $id = $this->request->getPost("id");
        $waktu   = $this->request->getPost("waktu");

        $data = [
            "tglinput" => str_replace('T', ' ', $waktu) . ':00'
        ];

        $this->icGeneralModel->where('id', $id)->set($data)->update();
        echo json_encode('');
    }

    public function hapus()
    {
        $id = $this->request->getPost("id");
        $this->catatLog('hapus', 'dpjp', $id, $this->icGeneralModel->where('id', $id)->first());

        $this->icGeneralModel->where("id", $id)->delete();
        echo json_encode("");
    }


    public function cetak($noRawat, $id = null)
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

        $icGeneral = $this->icGeneralModel->where('id', $id)->first();
        if ($icGeneral) {
            $icGeneral["tglTtd"] = $this->tanggalCetak($icGeneral["tglinput"]);
        }

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'icGeneral' => $icGeneral
        ];
        echo view("cetak/icGeneral", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function simpanTtd()
    {
        // Ambil input noRawat dan data canvas dari form
        $id    = $this->request->getPost("id");
        $ttdWali    = $this->request->getPost("ttdWali");
        $ttdSaksi    = $this->request->getPost("ttdSaksi");

        $lokasiFolder = 'icGeneral';

        $data = [
            "ttdWali" => $this->uploadTtd($ttdWali, $id . '_wali', $lokasiFolder),
            "ttdSaksi" => $this->uploadTtd($ttdSaksi, $id . '_saksi', $lokasiFolder)
        ];

        $this->icGeneralModel->where('id', $id)->set($data)->update();

        return $this->response->setJSON([
            'status'  => 'success'
        ]);
    }
}
