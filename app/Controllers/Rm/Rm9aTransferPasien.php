<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\Rm9aTransferPasienModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;
use App\Models\PetugasModel;

class rm9aTransferPasien extends BaseController
{
    protected $regPeriksaModel;
    protected $rm9aTransferPasienModel;
    protected $sysLog;
    protected $pengaturan;
    protected $pjPasienModel;
    protected $petugasModel;
    protected $dokterModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->rm9aTransferPasienModel = new Rm9aTransferPasienModel();
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->sysLog = new SysLogModel();
        $this->pengaturan = new PengaturanModel();
        $this->pjPasienModel = new PjPasienModel();
        $this->dokterModel = new DokterModel();
        $this->petugasModel = new PetugasModel();
    }

    public function index($noRawat, $id = null)
    {
        $dokter =  $this->dokterModel->where('kd_dokter !=', '-')->findAll();
        $petugas = $this->petugasModel->where('nip !=', '-')->findAll();

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

        $rm9aTransferPasien = $this->rm9aTransferPasienModel->where('id', $id)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'petugas'     => $petugas,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,
            'rm9aTransferPasien' => $rm9aTransferPasien,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/rm9aTransferPasien', ['data' => $data]);
    }

    public function simpan()
    {
        $data = [
            // Data Pasien & Petugas
            "noRawat"             => $this->request->getPost("noRawat"),
            "judul"                => $this->request->getPost("judul"),
            "nama"                => $this->request->getPost("nama"),
            "sebagai"             => $this->request->getPost("sebagai"),
            "dariUnit"            => $this->request->getPost("dariUnit"),
            "keUnit"              => $this->request->getPost("keUnit"),
            "dokter"              => $this->request->getPost("dokter"),
            "waktu"               => !empty($this->request->getPost("waktu")) ? $this->request->getPost("waktu") : null,
            "alasanAdmisi"        => $this->request->getPost("alasanAdmisi"),
            "metodePindah"        => $this->request->getPost("metodePindah"),

            // Indikasi Pindah & Diagnosa (Array di-encode ke JSON)
            "indikasiPindah"      => json_encode($this->request->getPost("indikasiPindah") ?? []),
            "isiIndikasiLainnya"  => $this->request->getPost("isiIndikasiLainnya"),
            "diagnosa"            => $this->request->getPost("diagnosa"),
            "temuan"              => $this->request->getPost("temuan"),
            "tindakan"            => $this->request->getPost("tindakan"),
            "obat"                => $this->request->getPost("obat"),
            "pemeriksaan"         => $this->request->getPost("pemeriksaan"),

            // Alat Medis & Persetujuan (Array di-encode ke JSON)
            "alatMedis"           => json_encode($this->request->getPost("alatMedis") ?? []),
            "setuju"              => $this->request->getPost("setuju"),

            // Keadaan Pasien Sebelum Transfer
            "keadaanKU"           => $this->request->getPost("keadaanKU"),
            "keadaanTD"           => $this->request->getPost("keadaanTD"),
            "keadaanN"            => $this->request->getPost("keadaanN"),
            "keadaanS"            => $this->request->getPost("keadaanS"),
            "keadaanCRT"          => $this->request->getPost("keadaanCRT"),
            "keadaanRR"           => $this->request->getPost("keadaanRR"),
            "keadaanLainLain"     => $this->request->getPost("keadaanLainLain"),
            "keluhanUtama"        => $this->request->getPost("keluhanUtama"),

            // Keadaan Pasien Setelah Transfer
            "keadaanKU2"          => $this->request->getPost("keadaanKU2"),
            "keadaanTD2"          => $this->request->getPost("keadaanTD2"),
            "keadaanN2"           => $this->request->getPost("keadaanN2"),
            "keadaanS2"           => $this->request->getPost("keadaanS2"),
            "keadaanCRT2"         => $this->request->getPost("keadaanCRT2"),
            "keadaanRR2"          => $this->request->getPost("keadaanRR2"),
            "keadaanLainLain2"    => $this->request->getPost("keadaanLainLain2"),
            "keluhanUtama2"       => $this->request->getPost("keluhanUtama2"),

            // Petugas
            "petugasMenyerahkan" => $this->request->getPost("petugasMenyerahkan"),
            "petugasMenerima"    => $this->request->getPost("petugasMenerima"),
            "petugas"            => $this->request->getPost("petugas")
        ];

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->rm9aTransferPasienModel->save($data);
            $id = $this->rm9aTransferPasienModel->getInsertID();
            $this->catatLog('simpan', 'rm9a_transfer_pasien', $this->request->getPost("noRawat"), $this->rm9aTransferPasienModel->where('id', $id)->first());
        } else {
            $id = $this->request->getPost("tujuanSimpan");
            unset($data['noRawat']);

            $this->catatLog('ubah', 'rm9a_transfer_pasien', $id, $this->rm9aTransferPasienModel->where('id', $id)->first(), $data);

            $this->rm9aTransferPasienModel->where('id', $id)->set($data)->update();
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil disimpan',
            'id' => $id
        ]);
    }

    public function hapus()
    {
        $id = $this->request->getPost("id");
        $this->catatLog('hapus', 'rm9a_transfer_pasien', $id, $this->rm9aTransferPasienModel->where('id', $id)->first());

        $this->rm9aTransferPasienModel->where("id", $id)->delete();
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

        $rm9aTransferPasien = $this->rm9aTransferPasienModel->where('id', $id)->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'rm9aTransferPasien' => $rm9aTransferPasien
        ];
        echo view("cetak/rm9aTransferPasien", ["data" => $data]);

        // Load the view file and get its HTML content

    }
}
