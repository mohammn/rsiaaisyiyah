<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\Rm26iPeyimpananBarangModel;
use App\Models\Rm26iPeyimpananBarangDataModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\PetugasModel;

class Rm26iPenyimpananBarang extends BaseController
{
    protected $regPeriksaModel;
    protected $rm26iPenyimpananBarangModel;
    protected $rm26iPenyimpananBarangDataModel;
    protected $sysLog;
    protected $pengaturan;
    protected $pjPasienModel;
    protected $petugasModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->rm26iPenyimpananBarangModel = new Rm26iPeyimpananBarangModel();
        $this->rm26iPenyimpananBarangDataModel = new Rm26iPeyimpananBarangDataModel();
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->sysLog = new SysLogModel();
        $this->pengaturan = new PengaturanModel();
        $this->pjPasienModel = new PjPasienModel();
        $this->petugasModel = new PetugasModel();
    }

    public function index($noRawat)
    {
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

        $rm26iPenyimpananBarang = $this->rm26iPenyimpananBarangModel->where('noRawat', $noRawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'petugas'     => $petugas,      // Jangan pakai (object) di sini
            'rm26iPenyimpananBarang' => $rm26iPenyimpananBarang,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/rm26iPenyimpananBarang', ['data' => $data]);
    }

    public function simpan()
    {
        $data = [
            // Data Pasien & Petugas
            "noRawat"           => $this->request->getPost("noRawat"),
            "nama"              => $this->request->getPost("nama"),
            "waktuTitip" => !empty($this->request->getPost("waktuTitip")) ? $this->request->getPost("waktuTitip") : null,
            "waktuSerah" => !empty($this->request->getPost("waktuSerah")) ? $this->request->getPost("waktuSerah") : null,

            // Pemberian Informasi & Detail Izin
            "petugas"           => $this->request->getPost("petugas"),
            "satpam"           => $this->request->getPost("satpam"),
        ];

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->rm26iPenyimpananBarangModel->save($data);
            $this->catatLog('tambah', 'rm26i_peyimpanan_barang', $this->request->getPost("noRawat"), $this->rm26iPenyimpananBarangModel->where('noRawat', $this->request->getPost("noRawat"))->first());
        } else {
            $noRawat = $this->request->getPost("noRawat");
            unset($data['noRawat']);

            $this->catatLog('ubah', 'ic_sesar', $noRawat, $this->rm26iPenyimpananBarangModel->where('noRawat', $noRawat)->first(), $data);

            $this->rm26iPenyimpananBarangModel->where('noRawat', $noRawat)->set($data)->update();
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function simpanBarang()
    {
        $data = [
            // Data Pasien & Petugas
            "idPenyimpanan"           => $this->request->getPost("id"),
            "namaBarang"              => $this->request->getPost("namaBarang"),
            "jumlah"              => $this->request->getPost("jumlah"),
            "kondisiTitip"              => $this->request->getPost("kondisiTitip"),
            "kondisiSerah"              => $this->request->getPost("kondisiSerah"),
        ];

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->rm26iPenyimpananBarangDataModel->save($data);
            $this->catatLog('tambah', 'rm26i_peyimpanan_barang_data', $this->rm26iPenyimpananBarangDataModel->getInsertID(), $this->rm26iPenyimpananBarangDataModel->where('id', $this->rm26iPenyimpananBarangDataModel->getInsertID())->first());
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function muatData()
    {
        echo json_encode($this->rm26iPenyimpananBarangDataModel->where('idPenyimpanan', $this->request->getPost("id"))->findAll());
    }

    public function hapusBarang()
    {
        $id = $this->request->getPost("id");
        $this->catatLog('hapus', 'rm26i_penyimpanan_barang', $id, $this->rm26iPenyimpananBarangDataModel->where('id', $id)->first());

        $this->rm26iPenyimpananBarangDataModel->where("id", $id)->delete();
        echo json_encode("");
    }

    public function ubahWaktu()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $waktu   = $this->request->getPost("waktu");

        $data = [
            "tglinput" => str_replace('T', ' ', $waktu) . ':00'
        ];

        $this->rm26iPenyimpananBarangModel->where('noRawat', $noRawat)->set($data)->update();
        echo json_encode('');
    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $this->catatLog('hapus', 'rm26i_penyimpanan_barang', $noRawat, $this->rm26iPenyimpananBarangModel->where('noRawat', $noRawat)->first());

        $this->rm26iPenyimpananBarangModel->where("noRawat", $noRawat)->delete();
        echo json_encode("");
    }


    public function cetak($noRawat)
    {
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

        $rm26iPenyimpananBarang = $this->rm26iPenyimpananBarangModel->where('noRawat', $noRawat)->first();
        $rm26iPenyimpananBarangData = $this->rm26iPenyimpananBarangDataModel->where('idPenyimpanan', $rm26iPenyimpananBarang['id'])->findAll();
        if ($rm26iPenyimpananBarang) {
            $rm26iPenyimpananBarang["tglTtd"] = $this->tanggalCetak($rm26iPenyimpananBarang["tglinput"]);
        }

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'petugas'     => $petugas,      // Jangan pakai (object) di sini
            'rm26iPenyimpananBarang' => $rm26iPenyimpananBarang,
            'rm26iPenyimpananBarangData' => $rm26iPenyimpananBarangData
        ];
        echo view("cetak/rm26iPenyimpananBarang", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function simpanTtd()
    {
        // Ambil input noRawat dan data canvas dari form
        $noRawat    = $this->request->getPost("noRawat");
        $noRawat = str_replace('/', '-', $noRawat);
        $ttdWali    = $this->request->getPost("ttdWali");
        $ttdSaksi    = $this->request->getPost("ttdSaksi");

        $lokasiFolder = 'rm26iPenyimpananBarang';

        $data = [
            "ttdWali" => $this->uploadTtd($ttdWali, $noRawat . '_wali', $lokasiFolder),
            "ttdSaksi" => $this->uploadTtd($ttdSaksi, $noRawat . '_saksi', $lokasiFolder)
        ];

        $noRawat = str_replace('-', '/', $noRawat);
        $this->rm26iPenyimpananBarangModel->where('noRawat', $noRawat)->set($data)->update();

        return $this->response->setJSON([
            'status'  => 'success'
        ]);
    }
}
