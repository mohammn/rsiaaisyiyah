<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\Rm20bUddsModel;
use App\Models\Rm20bUddsDataModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;
use App\Models\PetugasModel;
use App\Models\DataBarangModel;

class Rm20bUdds extends BaseController
{
    protected $regPeriksaModel;
    protected $rm20bUddsModel;
    protected $rm20bUddsDataModel;
    protected $sysLog;
    protected $pengaturan;
    protected $pjPasienModel;
    protected $dokterModel;
    protected $petugasModel;
    protected $dataBarangModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->rm20bUddsModel = new Rm20bUddsModel();
        $this->rm20bUddsDataModel = new Rm20bUddsDataModel();
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->sysLog = new SysLogModel();
        $this->pengaturan = new PengaturanModel();
        $this->pjPasienModel = new PjPasienModel();
        $this->dokterModel = new DokterModel();
        $this->petugasModel = new PetugasModel();
        $this->dataBarangModel = new DataBarangModel();
    }

    public function index($noRawat)
    {
        $petugas =  $this->petugasModel->where('nip !=', '-')->findAll();
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

        $rm20bUdds = $this->rm20bUddsModel->where('noRawat', $noRawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();
        $dataObat = $this->dataBarangModel->findAll();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'petugas'     => $petugas,      // Jangan pakai (object) di sini
            'rm20bUdds' => $rm20bUdds,
            'pjPasien' => $pjPasien,
            'dataObat' => $dataObat,
            'pengaturan' => $pengaturan
        ];

        return view('rm/rm20bUdds', ['data' => $data]);
    }

    public function simpan()
    {
        // 1. Definisikan data dasar Anda terlebih dahulu
        $data = [
            // --- Data Utama ---
            "noRawat"         => $this->request->getPost("noRawat"),

            // --- Data Pasien ---
            "ruang"           => $this->request->getPost("ruang") ?? '',
            "kamar"           => $this->request->getPost("kamar") ?? '',
            "alergi"          => $this->request->getPost("alergi") ?? '',

            // --- Data Petugas & Medis ---
            "dokter"          => $this->request->getPost("dokter") ?? '',
            "apoteker"        => $this->request->getPost("apoteker") ?? '',
            "pemberiObatOral" => $this->request->getPost("pemberiObatOral") ?? '',
            "pemberiObat"     => $this->request->getPost("pemberiObat") ?? '',
            "diagnosa"        => $this->request->getPost("diagnosa") ?? '',
        ];

        // =====================================================================

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->rm20bUddsModel->save($data);
            $this->catatLog('tambah', 'rm20b_udds', $this->request->getPost("noRawat"), $this->rm20bUddsModel->where('noRawat', $this->request->getPost("noRawat"))->first());
        } else {
            $noRawat = $this->request->getPost("noRawat");
            unset($data['noRawat']);

            $this->catatLog('ubah', 'rm20b_udds', $noRawat, $this->rm20bUddsModel->where('noRawat', $noRawat)->first(), $data);

            $this->rm20bUddsModel->where('noRawat', $noRawat)->set($data)->update();
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $this->catatLog('hapus', 'rm20b_udds', $noRawat, $this->rm20bUddsModel->where('noRawat', $noRawat)->first());

        $this->rm20bUddsModel->where("noRawat", $noRawat)->delete();
        echo json_encode("");
    }

    public function simpanObat()
    {
        // 1. Definisikan data dasar Anda terlebih dahulu
        $data = [
            // --- Data Utama ---
            "noRawat"     => $this->request->getPost("noRawat"),

            // --- Data Obat ---
            "jenis_obat"  => $this->request->getPost("jenis_obat") ?? '',
            "nama_obat"   => $this->request->getPost("nama_obat") ?? '',
            "dosis"       => $this->request->getPost("dosis") ?? '',
            "jumlah"      => $this->request->getPost("jumlah") ?? '',

            // --- Kondisi Tanggal (Jika kosong, masukkan NULL) ---
            "tanggal"     => !empty($this->request->getPost("tanggal")) ? $this->request->getPost("tanggal") : null,

            // --- Data Jam Pemberian ---
            "pagi"        => $this->request->getPost("jam[pagi]") ?? null,
            "siang"       => $this->request->getPost("jam[siang]") ?? null,
            "sore"        => $this->request->getPost("jam[sore]") ?? null,
            "malam"       => $this->request->getPost("jam[malam]") ?? null,
        ];

        // =====================================================================

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->rm20bUddsDataModel->save($data);
            $this->catatLog('tambah', 'rm20b_udds_data', $this->request->getPost("noRawat"), $this->rm20bUddsDataModel->where('noRawat', $this->request->getPost("noRawat"))->first());
        } else {
            $id = $this->request->getPost("id");
            unset($data['noRawat']);

            $this->catatLog('ubah', 'rm20b_udds_data', $id, $this->rm20bUddsDataModel->where('id', $id)->first(), $data);

            $this->rm20bUddsDataModel->where('id', $id)->set($data)->update();
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function muatObat()
    {
        echo json_encode($this->rm20bUddsDataModel->where('noRawat', $this->request->getPost("noRawat"))->findAll());
    }

    public function lihat()
    {
        echo json_encode($this->rm20bUddsDataModel->where('id', $this->request->getPost("id"))->first());
    }

    public function hapusObat()
    {
        $id = $this->request->getPost("id");
        $this->catatLog('hapus', 'rm20b_udds_data', $id, $this->rm20bUddsDataModel->where('id', $id)->first());

        $this->rm20bUddsDataModel->where("id", $id)->delete();
        echo json_encode("");
    }

    public function tambahPaket()
    {
        $noRawat = $this->request->getPost("noRawat");
        $jenis = $this->request->getPost("jenis");

        if ($jenis == 'oral') {
            $data = [
                [
                    "noRawat"    => $noRawat,
                    "nama_obat"  => 'CEFADROXIL',
                    "jenis_obat" => 'oral',
                    "dosis"      => '500 MG',
                    "jumlah"     => '3',
                ],
                [
                    "noRawat"    => $noRawat,
                    "nama_obat"  => 'ASAM MEFENAMAT',
                    "jenis_obat" => 'oral',
                    "dosis"      => '500 MG',
                    "jumlah"     => '3',
                ],
                [
                    "noRawat"    => $noRawat,
                    "nama_obat"  => 'NATRIUM DIKLOFENAK',
                    "jenis_obat" => 'oral',
                    "dosis"      => '50 mg',
                    "jumlah"     => '2',
                ],
                [
                    "noRawat"    => $noRawat,
                    "nama_obat"  => 'NIFEDIPIN TABLET',
                    "jenis_obat" => 'oral',
                    "dosis"      => '10 MG',
                    "jumlah"     => '3',
                ],
                [
                    "noRawat"    => $noRawat,
                    "nama_obat"  => 'PARACETAMOL TABLET',
                    "jenis_obat" => 'oral',
                    "dosis"      => '500 MG',
                    "jumlah"     => '8',
                ],
                [
                    "noRawat"    => $noRawat,
                    "nama_obat"  => 'TABLET TAMBAH DARAH',
                    "jenis_obat" => 'oral',
                    "dosis"      => '500 MG',
                    "jumlah"     => '2',
                ],
                [
                    "noRawat"    => $noRawat,
                    "nama_obat"  => 'TRAMADOL TABLET',
                    "jenis_obat" => 'oral',
                    "dosis"      => '50 MG',
                    "jumlah"     => '2',
                ],
                [
                    "noRawat"    => $noRawat,
                    "nama_obat"  => 'TABLET TAMBAH DARAH',
                    "jenis_obat" => 'oral',
                    "dosis"      => '500 MG',
                    "jumlah"     => '2',
                ],
                [
                    "noRawat"    => $noRawat,
                    "nama_obat"  => 'MYOTONIC',
                    "jenis_obat" => 'oral',
                    "dosis"      => '125 MCG',
                    "jumlah"     => '3',
                ],
                [
                    "noRawat"    => $noRawat,
                    "nama_obat"  => 'CAPSINAT',
                    "jenis_obat" => 'oral',
                    "dosis"      => '500 MG',
                    "jumlah"     => '3',
                ],
                [
                    "noRawat"    => $noRawat,
                    "nama_obat"  => 'FEMISIC',
                    "jenis_obat" => 'oral',
                    "dosis"      => '500 MG',
                    "jumlah"     => '3',
                ],
            ];
        } else {
            $data = [];
        }
        $this->rm20bUddsDataModel->insertBatch($data);

        return $this->response->setJSON([
            'status'  => 'success'
        ]);
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

        $rm20bUdds = $this->rm20bUddsModel->where('noRawat', $noRawat)->first();
        $rm20bUddsData = $this->rm20bUddsDataModel->where('noRawat', $noRawat)->findAll();

        $tanggalUnik = $this->rm20bUddsDataModel->select('tanggal')->distinct()->where('noRawat', $noRawat)->findAll();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'rm20bUdds' => $rm20bUdds,
            'rm20bUddsData' => $rm20bUddsData,
            'tanggalUnik' => $tanggalUnik
        ];
        echo view("cetak/rm20bUdds", ["data" => $data]);

        // Load the view file and get its HTML content

    }
}
