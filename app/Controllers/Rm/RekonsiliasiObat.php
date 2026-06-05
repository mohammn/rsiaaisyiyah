<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\RekonsiliasiObatModel;
use App\Models\RekonsiliasiObatDataModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;
use App\Models\PetugasModel;
use App\Models\DataBarangModel;

class RekonsiliasiObat extends BaseController
{
    protected $regPeriksaModel;
    protected $rekonsiliasiObatModel;
    protected $rekonsiliasiObatDataModel;
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

        $this->rekonsiliasiObatModel = new RekonsiliasiObatModel();
        $this->rekonsiliasiObatDataModel = new RekonsiliasiObatDataModel();
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->sysLog = new SysLogModel();
        $this->pjPasienModel = new PjPasienModel();
        $this->dokterModel = new DokterModel();
        $this->petugasModel = new PetugasModel();
        $this->dataBarangModel = new DataBarangModel();
    }

    public function index($noRawat)
    {
        $dokter =  $this->dokterModel->where('kd_dokter !=', '-')->findAll();
        $petugas =  $this->petugasModel->where('nip !=', '-')->findAll();

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

        $rekonsiliasiObat = $this->rekonsiliasiObatModel->where('noRawat', $noRawat)->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'petugas'     => $petugas,      // Jangan pakai (object) di sini
            'rekonsiliasiObat' => $rekonsiliasiObat
        ];

        return view('rm/rekonsiliasiObat', ['data' => $data]);
    }

    public function muatData($noRawat)
    {
        $noRawat = str_replace('-', '/', $noRawat);
        $rekonsiliasiObat = $this->rekonsiliasiObatModel->where('noRawat', $noRawat)->first();
        return $this->response->setJSON($rekonsiliasiObat);
    }

    public function simpan()
    {
        // Ambil data noRawat terlebih dahulu untuk kondisi WHERE
        $noRawat = $this->request->getPost("noRawat");

        $data = [
            "noRawat"         => $noRawat,
            "alergi"          => $this->request->getPost("alergi"),
            "manifestasi"     => $this->request->getPost("manifestasi"),
            "dampak"          => $this->request->getPost("dampak"),

            // Data IGD (Pastikan nama getPost sesuai dengan atribut 'name' di HTML kamu)
            "perawatIgd"      => $this->request->getPost("perawatIgd"),
            "dokterIgd"       => $this->request->getPost("dokterIgd"),
            "farmasiIgd"      => $this->request->getPost("farmasiIgd"),
            "waktuPerawatIgd" => $this->request->getPost("waktuPerawatIgd"), // Sesuaikan jika di HTML huruf kecil 'w'
            "waktuDokterIgd"  => $this->request->getPost("waktuDokterIgd"),
            "waktuFarmasiIgd" => $this->request->getPost("waktuFarmasiIgd"),

            // Data KO (Kamar Operasi)
            "perawatKo"       => $this->request->getPost("perawatKo"),
            "dokterKo"        => $this->request->getPost("dokterKo"),
            "farmasiKo"       => $this->request->getPost("farmasiKo"),
            "waktuPerawatKo"  => $this->request->getPost("waktuPerawatKo"),
            "waktuDokterKo"   => $this->request->getPost("waktuDokterKo"),
            "waktuFarmasiKo"  => $this->request->getPost("waktuFarmasiKo"),

            // Data RR (Recovery Room)
            "perawatRr"       => $this->request->getPost("perawatRr"),
            "dokterRr"        => $this->request->getPost("dokterRr"),
            "farmasiRr"       => $this->request->getPost("farmasiRr"),
            "waktuPerawatRr"  => $this->request->getPost("waktuPerawatRr"),
            "waktuDokterRr"   => $this->request->getPost("waktuDokterRr"),
            "waktuFarmasiRr"  => $this->request->getPost("waktuFarmasiRr"),

            // Data RI (Rawat Inap)
            "perawatRi"       => $this->request->getPost("perawatRi"),
            "dokterRi"        => $this->request->getPost("dokterRi"),
            "farmasiRi"       => $this->request->getPost("farmasiRi"),
            "waktuPerawatRi"  => $this->request->getPost("waktuPerawatRi"),
            "waktuDokterRi"   => $this->request->getPost("waktuDokterRi"),
            "waktuFarmasiRi"  => $this->request->getPost("waktuFarmasiRi")
        ];

        $data = array_map(function ($value) {
            return ($value === '') ? null : $value;
        }, $data);

        if ($this->request->getPost("tujuan") == 'tambah') {
            // Tambah data baru
            $this->rekonsiliasiObatModel->save($data);
            $status = "Data berhasil ditambahkan";
        } else { // EDIT: Hapus noRawat dari array data agar tidak ikut di-update
            unset($data['noRawat']);


            $this->catatLog('ubah', 'rekonsiliasi_obat', $noRawat, $this->rekonsiliasiObatModel->where('noRawat', $noRawat)->first(), $data);

            // EDIT: Update data berdasarkan kolom 'noRawat'
            $this->rekonsiliasiObatModel->where('noRawat', $noRawat)->set($data)->update();
            $status = "Data berhasil diperbarui";
        }

        // Mengembalikan respons dalam bentuk JSON yang informatif ke AJAX jQuery
        return $this->response->setJSON([
            'status'  => 'success',
            'message' => $status
        ]);
    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $this->catatLog('hapus', 'rekonsiliasi_obat', $noRawat, $this->rekonsiliasiObatModel->where('noRawat', $noRawat)->first());

        $this->rekonsiliasiObatModel->where("noRawat", $noRawat)->delete();
        echo json_encode("");
    }

    public function dataObat($noRawat)
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
        $dataObat = $this->dataBarangModel->findAll();

        $rekonsiliasiObat = $this->rekonsiliasiObatModel->where('noRawat', $noRawat)->first();
        $rekonsiliasiObatData = $this->rekonsiliasiObatDataModel->where('noRawat', $noRawat)->findAll();

        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'rekonsiliasiObat' => $rekonsiliasiObat,
            'rekonsiliasiObatData' => $rekonsiliasiObatData,
            'dataObat' => $dataObat
        ];

        return view('rm/partials/rekonsiliasiObatData', ['data' => $data]);
    }

    public function muatDataObat($id)
    {
        $obat = $this->rekonsiliasiObatDataModel->where('id', $id)->first();
        return $this->response->setJSON($obat);
    }

    public function simpanObat()
    {
        $noRawat = $this->request->getPost("noRawat");

        $data = [
            "noRawat"        => $noRawat,
            "idRekonsiliasiObat"      => $this->request->getPost("id"),
            "namaObat"      => $this->request->getPost("namaObat"),
            "ruangan"        => $this->request->getPost("ruangan"),
            "dosis"          => $this->request->getPost("dosis"),
            "frekuensi"      => $this->request->getPost("frekuensi"),
            "caraPemberian" => $this->request->getPost("caraPemberian"),
            "waktuTerakhir" => str_replace('T', ' ', $this->request->getPost("waktuTerakhir")) . ':00',
            "dirawat"        => $this->request->getPost("dirawat"),
            "keluar"         => $this->request->getPost("keluar"),
        ];

        if ($this->request->getPost("tujuan") == 'tambah') {
            // TAMBAH: Masukkan data obat baru ke tabel detail / riwayat obat
            $this->rekonsiliasiObatDataModel->save($data);
            $status = "Data obat berhasil ditambahkan";
        } else {
            // EDIT: Unset noRawat dan kriteria unik lainnya agar tidak ikut di-update
            unset($data['noRawat']);
            unset($data['idRekonsiliasiObat']);

            // Catat log perubahan jika diperlukan (opsional, sesuaikan nama tabel detailmu)
            $this->catatLog('ubah', 'rekonsiliasi_obat_data', $this->request->getPost("id"), $this->rekonsiliasiObatDataModel->where(['id' => $this->request->getPost("id")])->first(), $data);

            // UPDATE: Berdasarkan noRawat dan nama_obat (atau ID primary key detail obat jika ada)
            $this->rekonsiliasiObatDataModel->where(['id'   => $this->request->getPost("id")])->set($data)->update();

            $status = "Data obat berhasil diperbarui";
        }

        // Kembalikan respons JSON ke AJAX jQuery
        return $this->response->setJSON([
            'status'  => 'success',
            'message' => $status
        ]);
    }

    public function tambahPaket()
    {
        $noRawat = $this->request->getPost("noRawat");
        $idRekonsiliasiObat = $this->request->getPost("id");
        $waktu = $this->request->getPost("waktu");
        $kamar = $this->request->getPost("kamar");

        if ($kamar == 'ko') {
            $data = [
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'RINGER LAKTAT INF 500ML',
                    "ruangan"            => 'ko',
                    "dosis"              => '500 ML',
                    "frekuensi"          => '1X1',
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'ETERFIX inf 100 ml',
                    "ruangan"            => 'ko',
                    "dosis"              => '10 MG/ML',
                    "frekuensi"          => '1X1',
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'TRAMADOL INJ 50 MG/ ML',
                    "ruangan"            => 'ko',
                    "dosis"              => '50 MG/ ML',
                    "frekuensi"          => '1X1',
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'RINVELL INJ',
                    "ruangan"            => 'ko',
                    "dosis"              => '-', // Kosong diganti -
                    "frekuensi"          => '1X1',
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'ASAM TRANEKSAMAT 500 MG',
                    "ruangan"            => 'ko',
                    "dosis"              => '500 MG',
                    "frekuensi"          => '1X1',
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'METAMIZOLE SODIUM 500MG/ML',
                    "ruangan"            => 'ko',
                    "dosis"              => '500MG/ML',
                    "frekuensi"          => '1X1',
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'REGIVELL 4 ML',
                    "ruangan"            => 'ko',
                    "dosis"              => '-',
                    "frekuensi"          => '1X1',
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'ATROPIN SULFATE',
                    "ruangan"            => 'ko',
                    "dosis"              => '-',
                    "frekuensi"          => '1X1',
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'DEXAMETHASONE',
                    "ruangan"            => 'ko',
                    "dosis"              => '-',
                    "frekuensi"          => '1X1',
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'ETANYL',
                    "ruangan"            => 'ko',
                    "dosis"              => '-',
                    "frekuensi"          => '1X11',
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'EPINEPHRINE',
                    "ruangan"            => 'ko',
                    "dosis"              => '-',
                    "frekuensi"          => '1X1',
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'METHYLERGOMETHRINE 0,2 MG INJ',
                    "ruangan"            => 'ko',
                    "dosis"              => '0,2 MG INJ',
                    "frekuensi"          => '1X11',
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'METOCLOPRAMIDE HYDROCHLORIDE', // Disesuaikan typo teks gambar GYDROCHLORIDE -> HYDROCHLORIDE
                    "ruangan"            => 'ko',
                    "dosis"              => '-',
                    "frekuensi"          => '1X11',
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'OXYTOCIN INJEKSI 10IU/ml',
                    "ruangan"            => 'ko',
                    "dosis"              => '10IU/ml',
                    "frekuensi"          => '1X3',
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'RANITIDINE HCL 25MG INJ',
                    "ruangan"            => 'ko',
                    "dosis"              => '25MG',
                    "frekuensi"          => '1X1',
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ]
            ];
        } elseif ($kamar == 'rr') {
            $data = [
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'RINGER LAKTAT INF 500ML',
                    "ruangan"            => 'rr',
                    "dosis"              => '500 ML',
                    "frekuensi"          => '-', // Kosong diganti -
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'D5 INF 500ML',
                    "ruangan"            => 'rr',
                    "dosis"              => '500 ML',
                    "frekuensi"          => '2 BANDING 1',
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'CEFTRIAXONE',
                    "ruangan"            => 'rr',
                    "dosis"              => '1 GRAM',
                    "frekuensi"          => '2X1',
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'CEFOTAXIME',
                    "ruangan"            => 'rr',
                    "dosis"              => '1 GRAM',
                    "frekuensi"          => '3X1',
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'ROFIDEN',
                    "ruangan"            => 'rr',
                    "dosis"              => '-',
                    "frekuensi"          => '3X1 / 3X2',
                    "caraPemberian"      => 'RECTAL',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'METAMIZOLE SODIUM 500MG/ML',
                    "ruangan"            => 'rr',
                    "dosis"              => '500MG/ML',
                    "frekuensi"          => '3X1',
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'OMEPRAZOLE 40 MG DRY INJ',
                    "ruangan"            => 'rr',
                    "dosis"              => '40 MG',
                    "frekuensi"          => '2X1',
                    "caraPemberian"      => 'IV',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ]
            ];
        } else {
            $data = [
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'CEFADROXIL',
                    "ruangan"            => 'ri',
                    "dosis"              => '500 MG',
                    "frekuensi"          => '3X1',
                    "caraPemberian"      => 'PO',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'ASAM MEFENAMAT',
                    "ruangan"            => 'ri',
                    "dosis"              => '500 MG',
                    "frekuensi"          => '3X1',
                    "caraPemberian"      => 'PO',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'NATRIUM DIKLOFENAK',
                    "ruangan"            => 'ri',
                    "dosis"              => '50 MossG', // Di gambar tertulis 50 MG
                    "dosis"              => '50 MG',
                    "frekuensi"          => '2X1',
                    "caraPemberian"      => 'PO',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'NIFEDIPIN TABLET',
                    "ruangan"            => 'ri',
                    "dosis"              => '10 MG',
                    "frekuensi"          => '3X1',
                    "caraPemberian"      => 'PO',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'PARACETAMOL TABLET',
                    "ruangan"            => 'ri',
                    "dosis"              => '500 MG',
                    "frekuensi"          => '4X2',
                    "caraPemberian"      => 'PO',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'TABLET TAMBAH DARAH',
                    "ruangan"            => 'ri',
                    "dosis"              => '500 MG',
                    "frekuensi"          => '2X1',
                    "caraPemberian"      => 'PO',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'TRAMADOL TABLET',
                    "ruangan"            => 'ri',
                    "dosis"              => '50 MG',
                    "frekuensi"          => '2X1',
                    "caraPemberian"      => 'PO',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'TABLET TAMBAH DARAH', // No 8 di gambar
                    "ruangan"            => 'ri',
                    "dosis"              => '500 MG',
                    "frekuensi"          => '3X1',
                    "caraPemberian"      => 'PO',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'MYOTONIC',
                    "ruangan"            => 'ri',
                    "dosis"              => '125 MCG',
                    "frekuensi"          => '3X1',
                    "caraPemberian"      => 'PO',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'CAPSINAT',
                    "ruangan"            => 'ri',
                    "dosis"              => '500 MG',
                    "frekuensi"          => '3X1',
                    "caraPemberian"      => 'PO',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ],
                [
                    "noRawat"            => $noRawat,
                    "idRekonsiliasiObat" => $idRekonsiliasiObat,
                    "namaObat"           => 'FEMISIC',
                    "ruangan"            => 'ri',
                    "dosis"              => '500 MG',
                    "frekuensi"          => '3X1',
                    "caraPemberian"      => 'PO',
                    "waktuTerakhir"      => str_replace('T', ' ', $waktu) . ':00'
                ]
            ];
        }

        $this->rekonsiliasiObatDataModel->insertBatch($data);
        return $this->response->setJSON([
            'status'  => 'success'
        ]);
    }

    public function hapusObat()
    {
        $id = $this->request->getPost("id");
        $this->catatLog('hapus', 'rekonsiliasi_obat', $id, $this->rekonsiliasiObatDataModel->where('id', $id)->first());

        $this->rekonsiliasiObatDataModel->where("id", $id)->delete();
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
                pasien.tgl_lahir
            ')
            ->join('pasien', 'pasien.no_rkm_medis = reg_periksa.no_rkm_medis', 'left')
            ->where('reg_periksa.no_rawat', $noRawat)
            ->first();

        $rekonsiliasiObat = $this->rekonsiliasiObatModel->where('noRawat', $noRawat)->first();
        $rekonsiliasiObatData = $this->rekonsiliasiObatDataModel->where('noRawat', $noRawat)->findAll();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'rekonsiliasiObat' => $rekonsiliasiObat,
            'rekonsiliasiObatData' => $rekonsiliasiObatData
        ];

        return view('cetak/rekonsiliasiObat', ['data' => $data]);
    }
}
