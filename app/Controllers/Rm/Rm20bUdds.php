<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\Rm20bUddsModel;
use App\Models\Rm20bUddsDataModel;
use App\Models\Rm20bUddsDataJamModel;
use App\Models\Rm20bUddsDataJamSementaraModel;
use App\Models\Rm20bUddsDataTglModel;
use App\Models\Rm20bUddsDataPetugasModel;
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
    protected $rm20bUddsDataTglModel;
    protected $rm20bUddsDataJamModel;
    protected $rm20bUddsDataJamSementaraModel;
    protected $rm20bUddsDataPetugasModel;
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
        $this->rm20bUddsDataTglModel = new Rm20bUddsDataTglModel();
        $this->rm20bUddsDataJamModel = new Rm20bUddsDataJamModel();
        $this->rm20bUddsDataJamSementaraModel = new Rm20bUddsDataJamSementaraModel();
        $this->rm20bUddsDataPetugasModel = new Rm20bUddsDataPetugasModel();
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

        // 1. Ambil data induk (Satu baris saja)
        $rm20bUdds = $this->rm20bUddsModel->where('noRawat', $noRawat)->first();
        $idUdds = $rm20bUdds['id'] ?? 0;

        // 2. Ambil data anak (Bisa banyak baris)
        $rm20bUddsData = $this->rm20bUddsDataModel->where('idUdds', $idUdds)->findAll();
        $rm20bUddsDataTgl = $this->rm20bUddsDataTglModel->where('idUdds', $idUdds)->findAll();

        // 3. Ekstrak semua ID dari data anak menjadi bentuk Array tunggal: [1, 2, 3, ...]
        $arrIdData = !empty($rm20bUddsData) ? array_column($rm20bUddsData, 'id') : [0];
        $arrIdTgl  = !empty($rm20bUddsDataTgl) ? array_column($rm20bUddsDataTgl, 'id') : [0];

        $rm20bUddsDataPetugas = $this->rm20bUddsDataPetugasModel
            ->whereIn('idTgl', $arrIdTgl)
            ->findAll();

        // 4. Gunakan whereIn karena kita mencocokkan dengan banyak ID sekaligus
        $rm20bUddsDataJam = $this->rm20bUddsDataJamModel
            ->whereIn('idData', $arrIdData)
            ->whereIn('idTgl', $arrIdTgl)
            ->findAll();

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
            'rm20bUddsData' => $rm20bUddsData,
            'rm20bUddsDataTgl' => $rm20bUddsDataTgl,
            'rm20bUddsDataJam' => $rm20bUddsDataJam,
            'rm20bUddsDataPetugas' => $rm20bUddsDataPetugas,
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

    public function muatTgl()
    {
        echo json_encode($this->rm20bUddsDataTglModel->where('idUdds', $this->request->getPost("idUdds"))->findAll());
    }

    public function simpanTgl()
    {
        // 1. Definisikan data dasar Anda terlebih dahulu
        $data = [
            // --- Data Utama ---
            "idUdds"     => $this->request->getPost("idUdds"),
            "tanggal"     => !empty($this->request->getPost("tanggal")) ? $this->request->getPost("tanggal") : null,
        ];

        // =====================================================================

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->rm20bUddsDataTglModel->save($data);

            $insertId = $this->rm20bUddsDataTglModel->getInsertID();
            $dataBaru = $this->rm20bUddsDataTglModel->find($insertId);
            $this->catatLog('tambah', 'rm20b_udds_data_tgl', $insertId, $dataBaru);
        } else {
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil disimpan',
            'id' => $this->request->getPost("idUdds")
        ]);
    }

    public function hapusTgl()
    {
        $id = $this->request->getPost("id");
        $this->catatLog('hapus', 'rm20b_udds_data_tgl', $id, $this->rm20bUddsDataTglModel->where('id', $id)->first());

        $this->rm20bUddsDataTglModel->where("id", $id)->delete();
        echo json_encode("");
    }

    public function simpanJam()
    {
        // 1. Ambil data berdasarkan key JSON yang dikirim JS
        $dataJam     = $this->request->getPost("dataJam");
        $dataPetugas = $this->request->getPost("dataPetugas");

        // Validasi dasar
        if (empty($dataJam) && empty($dataPetugas)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Tidak ada data jam maupun petugas yang dikirim.'
            ]);
        }

        $processedIds = [];

        // 2. PROSES TABEL 1: DATA JAM (`rm20b_udds_data_jam`)
        if (!empty($dataJam) && is_array($dataJam)) {
            foreach ($dataJam as $row) {
                $idData = $row['idData'] ?? null;
                $idTgl  = $row['idTgl'] ?? null;

                if (!$idData || !$idTgl) continue;

                $dataJamDb = [
                    "idData" => $idData,
                    "idTgl"  => $idTgl,
                    "pagi"   => (!empty($row['pagi']) && $row['pagi'] !== '00:00') ? $row['pagi'] : null,
                    "siang"  => (!empty($row['siang']) && $row['siang'] !== '00:00') ? $row['siang'] : null,
                    "sore"   => (!empty($row['sore']) && $row['sore'] !== '00:00') ? $row['sore'] : null,
                    "malam"  => (!empty($row['malam']) && $row['malam'] !== '00:00') ? $row['malam'] : null,
                ];

                // Cek eksistensi data jam berdasarkan kombinasi idData + idTgl
                $jamEksis = $this->rm20bUddsDataJamModel
                    ->where('idData', $idData)
                    ->where('idTgl', $idTgl)
                    ->first();

                if ($jamEksis) {
                    $this->rm20bUddsDataJamModel->update($jamEksis['id'], $dataJamDb);
                    $dataUpdate = $this->rm20bUddsDataJamModel->find($jamEksis['id']);
                    $this->catatLog('ubah', 'rm20b_udds_data_jam', $jamEksis['id'], $dataUpdate);
                } else {
                    $this->rm20bUddsDataJamModel->save($dataJamDb);
                    $insertId = $this->rm20bUddsDataJamModel->getInsertID();
                    $dataBaru  = $this->rm20bUddsDataJamModel->find($insertId);
                    $this->catatLog('tambah', 'rm20b_udds_data_jam', $insertId, $dataBaru);
                }

                $processedIds[] = $idData;
            }
        }

        // 3. PROSES TABEL 2: DATA PETUGAS (`rm20b_udds_data_petugas`)
        if (!empty($dataPetugas) && is_array($dataPetugas)) {
            foreach ($dataPetugas as $petugas) {
                $idTgl = $petugas['idTgl'] ?? null;
                if (!$idTgl) continue;

                $dataPetugasDb = [
                    'idTgl'                => $idTgl,
                    'apotekerPagi'         => !empty($petugas['apotekerPagi']) ? $petugas['apotekerPagi'] : null,
                    'apotekerSiang'        => !empty($petugas['apotekerSiang']) ? $petugas['apotekerSiang'] : null,
                    'apotekerSore'         => !empty($petugas['apotekerSore']) ? $petugas['apotekerSore'] : null,
                    'apotekerMalam'        => !empty($petugas['apotekerMalam']) ? $petugas['apotekerMalam'] : null,
                    'pemberiObatPagi'      => !empty($petugas['pemberiObatPagi']) ? $petugas['pemberiObatPagi'] : null,
                    'pemberiObatSiang'     => !empty($petugas['pemberiObatSiang']) ? $petugas['pemberiObatSiang'] : null,
                    'pemberiObatSore'      => !empty($petugas['pemberiObatSore']) ? $petugas['pemberiObatSore'] : null,
                    'pemberiObatMalam'     => !empty($petugas['pemberiObatMalam']) ? $petugas['pemberiObatMalam'] : null,
                    'pemberiObatOralPagi'  => !empty($petugas['pemberiObatOralPagi']) ? $petugas['pemberiObatOralPagi'] : null,
                    'pemberiObatOralSiang' => !empty($petugas['pemberiObatOralSiang']) ? $petugas['pemberiObatOralSiang'] : null,
                    'pemberiObatOralSore'  => !empty($petugas['pemberiObatOralSore']) ? $petugas['pemberiObatOralSore'] : null,
                    'pemberiObatOralMalam' => !empty($petugas['pemberiObatOralMalam']) ? $petugas['pemberiObatOralMalam'] : null,
                ];

                // Cek apakah data petugas dengan idTgl tersebut sudah ada
                $petugasEksis = $this->rm20bUddsDataPetugasModel
                    ->where('idTgl', $idTgl)
                    ->first();

                if ($petugasEksis) {
                    $this->rm20bUddsDataPetugasModel->update($petugasEksis['id'], $dataPetugasDb);
                    $petugasUpdate = $this->rm20bUddsDataPetugasModel->find($petugasEksis['id']);
                    $this->catatLog('ubah', 'rm20b_udds_data_petugas', $petugasEksis['id'], $petugasUpdate);
                } else {
                    $this->rm20bUddsDataPetugasModel->save($dataPetugasDb);
                    $insertPetugasId = $this->rm20bUddsDataPetugasModel->getInsertID();
                    $petugasBaru  = $this->rm20bUddsDataPetugasModel->find($insertPetugasId);
                    $this->catatLog('tambah', 'rm20b_udds_data_petugas', $insertPetugasId, $petugasBaru);
                }
            }
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data jam dan petugas berhasil diproses dan disimpan',
            'id'      => array_unique($processedIds) // Membersihkan duplikasi idData di response
        ]);
    }

    public function muatJamSementara()
    {
        echo json_encode($this->rm20bUddsDataJamSementaraModel->where('idUdds', $this->request->getPost("idUdds"))->findAll());
    }

    public function simpanJamSementara()
    {
        $data = [
            // --- Data Utama ---
            "tgl"     => $this->request->getPost("tgl"),
            "idUdds"     => $this->request->getPost("idUdds"),
            "namaObat"     => $this->request->getPost("namaObat"),
            "jenisObat"     => $this->request->getPost("jenisObat"),
            "catatan"     => $this->request->getPost("catatan"),

            "pagi"  => (!empty($this->request->getPost('pagi')) && $this->request->getPost('pagi') !== '00:00') ? $this->request->getPost('pagi') : null,
            "siang" => (!empty($this->request->getPost('siang')) && $this->request->getPost('siang') !== '00:00') ? $this->request->getPost('siang') : null,
            "sore"  => (!empty($this->request->getPost('sore')) && $this->request->getPost('sore') !== '00:00') ? $this->request->getPost('sore') : null,
            "malam" => (!empty($this->request->getPost('malam')) && $this->request->getPost('malam') !== '00:00') ? $this->request->getPost('malam') : null,

        ];

        // =====================================================================

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->rm20bUddsDataJamSementaraModel->save($data);
            $this->catatLog('tambah', 'rm20b_udds_data_jam_sementara', $this->rm20bUddsDataJamSementaraModel->getInsertID(), $this->rm20bUddsDataJamSementaraModel->where('id',  $this->rm20bUddsDataJamSementaraModel->getInsertID())->first());
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function hapusJamSementara()
    {
        $id = $this->request->getPost("id");
        $this->catatLog('hapus', 'rm20b_udds_data_jam_sementara', $id, $this->rm20bUddsDataJamSementaraModel->where('id', $id)->first());

        $this->rm20bUddsDataJamSementaraModel->where("id", $id)->delete();
        echo json_encode("");
    }



    public function simpanObat()
    {
        // 1. Definisikan data dasar Anda terlebih dahulu
        $data = [
            // --- Data Utama ---
            "idUdds"     => $this->request->getPost("idUdds"),

            // --- Data Obat ---
            "jenis_obat"  => $this->request->getPost("jenis_obat") ?? '',
            "nama_obat"   => $this->request->getPost("nama_obat") ?? '',
            "dosis"       => $this->request->getPost("dosis") ?? '',
            "jumlah"      => $this->request->getPost("jumlah") ?? '',
        ];

        // =====================================================================

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->rm20bUddsDataModel->save($data);
            $this->catatLog('tambah', 'rm20b_udds_data', $this->request->getPost("idUdds"), $this->rm20bUddsDataModel->where('id',  $this->rm20bUddsDataModel->getInsertID())->first());
        } else {
            $id = $this->request->getPost("idEdit");
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
        echo json_encode($this->rm20bUddsDataModel->where('idUdds', $this->request->getPost("idUdds"))->findAll());
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
        $idUdds = $this->request->getPost("idUdds");
        $jenis = $this->request->getPost("jenis");

        if ($jenis == 'oral') {
            $data = [
                [
                    "idUdds"    => $idUdds,
                    "nama_obat"  => 'CEFADROXIL',
                    "jenis_obat" => 'oral',
                    "dosis"      => '500 MG',
                    "jumlah"     => '3',
                ],
                [
                    "idUdds"    => $idUdds,
                    "nama_obat"  => 'ASAM MEFENAMAT',
                    "jenis_obat" => 'oral',
                    "dosis"      => '500 MG',
                    "jumlah"     => '3',
                ],
                [
                    "idUdds"    => $idUdds,
                    "nama_obat"  => 'NATRIUM DIKLOFENAK',
                    "jenis_obat" => 'oral',
                    "dosis"      => '50 mg',
                    "jumlah"     => '2',
                ],
                [
                    "idUdds"    => $idUdds,
                    "nama_obat"  => 'NIFEDIPIN TABLET',
                    "jenis_obat" => 'oral',
                    "dosis"      => '10 MG',
                    "jumlah"     => '3',
                ],
                [
                    "idUdds"    => $idUdds,
                    "nama_obat"  => 'PARACETAMOL TABLET',
                    "jenis_obat" => 'oral',
                    "dosis"      => '500 MG',
                    "jumlah"     => '8',
                ],
                [
                    "idUdds"    => $idUdds,
                    "nama_obat"  => 'TABLET TAMBAH DARAH',
                    "jenis_obat" => 'oral',
                    "dosis"      => '500 MG',
                    "jumlah"     => '2',
                ],
                [
                    "idUdds"    => $idUdds,
                    "nama_obat"  => 'TRAMADOL TABLET',
                    "jenis_obat" => 'oral',
                    "dosis"      => '50 MG',
                    "jumlah"     => '2',
                ],
                [
                    "idUdds"    => $idUdds,
                    "nama_obat"  => 'TABLET TAMBAH DARAH',
                    "jenis_obat" => 'oral',
                    "dosis"      => '500 MG',
                    "jumlah"     => '2',
                ],
                [
                    "idUdds"    => $idUdds,
                    "nama_obat"  => 'MYOTONIC',
                    "jenis_obat" => 'oral',
                    "dosis"      => '125 MCG',
                    "jumlah"     => '3',
                ],
                [
                    "idUdds"    => $idUdds,
                    "nama_obat"  => 'CAPSINAT',
                    "jenis_obat" => 'oral',
                    "dosis"      => '500 MG',
                    "jumlah"     => '3',
                ],
                [
                    "idUdds"    => $idUdds,
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


        // 1. Ambil data induk (Satu baris saja)
        $rm20bUdds = $this->rm20bUddsModel->where('noRawat', $noRawat)->first();
        $idUdds = $rm20bUdds['id'] ?? 0;

        // 2. Ambil data anak (Bisa banyak baris)
        $rm20bUddsData = $this->rm20bUddsDataModel->where('idUdds', $idUdds)->findAll();
        $rm20bUddsDataTgl = $this->rm20bUddsDataTglModel->where('idUdds', $idUdds)->findAll();

        // 3. Ekstrak semua ID dari data anak menjadi bentuk Array tunggal: [1, 2, 3, ...]
        $arrIdData = !empty($rm20bUddsData) ? array_column($rm20bUddsData, 'id') : [0];
        $arrIdTgl  = !empty($rm20bUddsDataTgl) ? array_column($rm20bUddsDataTgl, 'id') : [0];

        $rm20bUddsDataPetugas = $this->rm20bUddsDataPetugasModel
            ->whereIn('idTgl', $arrIdTgl)
            ->findAll();

        // 4. Gunakan whereIn karena kita mencocokkan dengan banyak ID sekaligus
        $rm20bUddsDataJam = $this->rm20bUddsDataJamModel
            ->whereIn('idData', $arrIdData)
            ->whereIn('idTgl', $arrIdTgl)
            ->findAll();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        // dd($rm20bUddsDataJam);
        $data = (object) [
            'pasien'     => $pasien,
            'rm20bUddsData' => $rm20bUddsData,
            'rm20bUddsDataTgl' => $rm20bUddsDataTgl,
            'rm20bUddsDataJam' => $rm20bUddsDataJam,
            'rm20bUddsDataPetugas' => $rm20bUddsDataPetugas,
        ];
        echo view("cetak/rm20bUdds", ["data" => $data]);

        // Load the view file and get its HTML content

    }
}
