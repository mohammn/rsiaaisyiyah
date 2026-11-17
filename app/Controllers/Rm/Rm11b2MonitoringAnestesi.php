<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\Rm11b2MonitoringAnestesiModel;
use App\Models\Rm11b2MonitoringAnestesiDataModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;
use App\Models\PetugasModel;

class Rm11b2MonitoringAnestesi extends BaseController
{
    protected $regPeriksaModel;
    protected $rm11b2MonitoringAnestesiModel;
    protected $rm11b2MonitoringAnestesiDataModel;
    protected $sysLog;
    protected $pengaturan;
    protected $pjPasienModel;
    protected $dokterModel;
    protected $petugasModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->rm11b2MonitoringAnestesiModel = new Rm11b2MonitoringAnestesiModel();
        $this->rm11b2MonitoringAnestesiDataModel = new Rm11b2MonitoringAnestesiDataModel();
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->sysLog = new SysLogModel();
        $this->pengaturan = new PengaturanModel();
        $this->pjPasienModel = new PjPasienModel();
        $this->dokterModel = new DokterModel();
        $this->petugasModel = new PetugasModel();
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

        $rm11b2MonitoringAnestesi = $this->rm11b2MonitoringAnestesiModel->where('noRawat', $noRawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'petugas'     => $petugas,      // Jangan pakai (object) di sini
            'rm11b2MonitoringAnestesi' => $rm11b2MonitoringAnestesi,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/rm11b2MonitoringAnestesi', ['data' => $data]);
    }

    public function simpan()
    {
        // 1. Ambil seluruh data dari request POST
        $allData = $this->request->getPost();

        // 2. Daftar Field Array (Checklist / Multiple Choices & Tabel Skor) -> Simpan sebagai JSON
        $arrayFields = [
            'gasFlow',
            'bromage_t',
            'sirkulasi_t',
            'kesadaran_t',
            'oksigenasi_t',
            'pernafasan_t',
            'aktivitas_t'
        ];

        foreach ($arrayFields as $field) {
            if (isset($allData[$field]) && is_array($allData[$field])) {
                // Encode ke format JSON: ["Item 1", "Item 2"] atau associative array
                $allData[$field] = json_encode($allData[$field]);
            } else {
                // Jika tidak ada pilihan yang dicentang / kosong
                $allData[$field] = json_encode([]);
            }
        }

        // 3. Daftar Field Date & DateTime-Local -> Ubah string kosong "" menjadi NULL
        $dateTimeFields = [
            'waktuMasukOk',
            'waktuPembiusan',
            'waktuInsisi',
            'waktuSelesaiOp',
            'waktuSelesaiAnestesi',
            'waktuKeluarOk',
            'waktuBayiLahir',
            'waktuTtd1',
            'waktuPindah',
            'puasaSampai',
            'puasaMinum',
            'puasaMakan'
        ];

        foreach ($dateTimeFields as $field) {
            if (isset($allData[$field]) && trim($allData[$field]) === "") {
                $allData[$field] = null; // Mencegah error format tanggal 0000-00-00 di MySQL
            }
        }

        // 4. Manajemen Penyimpanan & Log Activity
        $tujuanSimpan = $allData['tujuanSimpan'] ?? 'tambah';
        $noRawat      = $allData['noRawat'] ?? $this->request->getPost('noRawat');

        // Hapus variabel pendukung UI yang tidak ada di kolom tabel database
        unset($allData['tujuanSimpan']);

        // Pastikan noRawat masuk ke dalam array data yang akan disimpan
        $allData['noRawat'] = $noRawat;

        $data = $allData;

        if ($tujuanSimpan == 'tambah') {
            // Jika menggunakan validasi model dan gagal, save() mengembalikan false
            if ($this->rm11b2MonitoringAnestesiModel->save($data) === false) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'Gagal validasi/menyimpan data.',
                    'errors'  => $this->rm11b2MonitoringAnestesiModel->errors()
                ]);
            }

            $this->catatLog('tambah', 'rm11b2_monitoring_anestesi', $noRawat, $this->rm11b2MonitoringAnestesiModel->where('noRawat', $noRawat)->first());
        } else {
            unset($data['noRawat']);

            // Validasi update via model (opsional jika menggunakan update())
            $oldData = $this->rm11b2MonitoringAnestesiModel->where('noRawat', $noRawat)->first();

            $updated = $this->rm11b2MonitoringAnestesiModel->where('noRawat', $noRawat)->set($data)->update();

            if ($updated === false) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'Gagal memperbarui data.',
                    'errors'  => $this->rm11b2MonitoringAnestesiModel->errors()
                ]);
            }

            $this->catatLog('ubah', 'rm11b2_monitoring_anestesi', $noRawat, $oldData, $data);
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data status anestesi berhasil disimpan'
        ]);
    }


    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $this->catatLog('hapus', 'rm11b1_checklist', $noRawat, $this->rm11b2MonitoringAnestesiModel->where('noRawat', $noRawat)->first());

        $this->rm11b2MonitoringAnestesiModel->where("noRawat", $noRawat)->delete();
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

        $rm11b2MonitoringAnestesi = $this->rm11b2MonitoringAnestesiModel->where('noRawat', $noRawat)->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'rm11b2MonitoringAnestesi' => $rm11b2MonitoringAnestesi
        ];
        echo view("cetak/rm11b2MonitoringAnestesi", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function simpanTtd()
    {
        // Ambil input noRawat dari form
        $noRawatRaw = $this->request->getPost("noRawat");
        $noRawatFile = str_replace('/', '-', $noRawatRaw); // Untuk penamaan file
        $noRawatDb   = str_replace('-', '/', $noRawatRaw); // Untuk query Database

        $lokasiFolder = 'rm11b2MonitoringAnestesi';

        // Daftar 7 field TTD beserta suffix nama filenya
        $listTtd = [
            'ttdDokter' => '_ttdDokter',
            'ttdPerawat' => '_ttdPerawat',
            'ttdPerawatRr'        => '_ttdPerawatRr',
            'ttdAnestesi'       => '_ttdAnestesi'
        ];

        // Ambil data eksisting dari Database
        $cekTtd = $this->rm11b2MonitoringAnestesiModel->where('noRawat', $noRawatDb)->first();

        $dataToUpdate = [];

        // Loop penanganan upload & validasi TTD
        foreach ($listTtd as $field => $suffix) {
            $dataPost = $this->request->getPost($field);

            // Jika TTD di DB sudah ada/terkunci, skip (jangan di-overwrite)
            if (!empty($cekTtd[$field])) {
                continue;
            }

            // Jika ada inputan TTD baru dari AJAX, upload filenya
            if (!empty($dataPost)) {
                $namaFile = $noRawatFile . $suffix;
                $dataToUpdate[$field] = $this->uploadTtd($dataPost, $namaFile, $lokasiFolder);
            }
        }

        // Lakukan update ke DB hanya jika ada data TTD baru yang diunggah
        if (!empty($dataToUpdate)) {
            $this->rm11b2MonitoringAnestesiModel->where('noRawat', $noRawatDb)->set($dataToUpdate)->update();
        }

        return $this->response->setJSON([
            'status' => 'success'
        ]);
    }

    public function simpanMonitoring()
    {
        // Pastikan request datang dari AJAX
        if (!$this->request->isAJAX()) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Mengambil data yang dikirim via POST dari jQuery (Tanpa 'tujuan' untuk db)
        $tujuan = $this->request->getPost('tujuan'); // Ambil tujuan hanya untuk percabangan logika

        $dataSimpan = [
            'idMonitoring' => $this->request->getPost('idMonitoring'),
            'waktu'        => $this->request->getPost('waktu'),
            'sistolik'     => $this->request->getPost('sistolik'),
            'diastolik'    => $this->request->getPost('diastolik'),
            'rr'           => $this->request->getPost('rr'),
            'spo2'         => $this->request->getPost('spo2'),
            'temp'         => $this->request->getPost('temp'),
            'jenis'        => $this->request->getPost('jenis')
        ];

        $dataTemplate = [];

        if ($tujuan == 'template') {
            // Ambil nilai dasar dari input
            $waktuAwal    = $this->request->getPost('waktu');
            $stAwal       = (int) $this->request->getPost('sistolik');
            $dAwal        = (int) $this->request->getPost('diastolik');
            $idMonitoring = $this->request->getPost('idMonitoring');
            $jenis        = $this->request->getPost('jenis');

            // Ubah format waktu awal ke timestamp agar mudah ditambah menit
            $timestampAwal = strtotime($waktuAwal);

            // Loop sebanyak 4 kali (index 0 sampai 3)
            for ($i = 0; $i < 4; $i++) {
                // Hitung penambahan waktu kelipatan 15 menit (0, 15, 30, 45)
                $waktuBaru = date('H:i', strtotime("+" . ($i * 15) . " minutes", $timestampAwal));

                // Menyesuaikan pola Sistolik & Diastolik berdasarkan urutan baris ($i)
                $st = $stAwal;
                $d  = $dAwal;
                if ($i == 0) {
                    $st = $stAwal;
                    $d  = $dAwal;
                } elseif ($i == 1) {
                    $st = $stAwal + 5;
                    $d  = $dAwal + 5;
                } elseif ($i == 2) {
                    $st = $stAwal;
                    $d  = $dAwal;
                } elseif ($i == 3) {
                    $st = $stAwal - 10;
                    $d  = $dAwal - 5;
                }

                // --- Cek ke database berdasarkan idMonitoring, waktu, dan jenis ---
                $cekAda = $this->rm11b2MonitoringAnestesiDataModel
                    ->where('idMonitoring', $idMonitoring)
                    ->where('waktu', $waktuBaru)
                    ->where('jenis', $jenis)
                    ->first();

                // Jika data sudah ada di database, lewati (pass)
                if ($cekAda) {
                    continue;
                }

                // Jika belum ada, susun data sementara (tanpa 'tujuan') lalu masukkan ke array
                $dataSementara = [
                    'idMonitoring' => $idMonitoring,
                    'waktu'        => $waktuBaru,
                    'sistolik'     => $st,
                    'diastolik'    => $d,
                    'rr'           => $this->request->getPost('rr'),
                    'spo2'         => $this->request->getPost('spo2'),
                    'temp'         => $this->request->getPost('temp'),
                    'jenis'        => $jenis
                ];

                array_push($dataTemplate, $dataSementara);
            }

            // Cek apakah dataTemplate tidak kosong sebelum melakukan insert batch
            if (!empty($dataTemplate)) {
                $simpan = $this->rm11b2MonitoringAnestesiDataModel->insertBatch($dataTemplate);

                if ($simpan) {
                    return $this->response->setJSON([
                        'status'  => 'success',
                        'message' => 'Data template tanda vital berhasil disimpan.'
                    ]);
                } else {
                    return $this->response->setJSON([
                        'status'  => 'error',
                        'message' => 'Gagal menyimpan data template ke database.'
                    ]);
                }
            } else {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'Data template gagal disimpan karena semua interval waktu tersebut sudah ada di database.'
                ]);
            }
        } else {
            // Proses untuk Single Data (Insert atau Update)
            $simpan = NULL;

            if ($tujuan == 'update') {
                // Logika Update: Update data berdasarkan idMonitoring, waktu, dan jenis
                $simpan = $this->rm11b2MonitoringAnestesiDataModel
                    ->where('idMonitoring', $dataSimpan['idMonitoring'])
                    ->where('waktu', $dataSimpan['waktu'])
                    ->where('jenis', $dataSimpan['jenis'])
                    ->set($dataSimpan)
                    ->update();

                $pesanSukses = 'Data tanda vital berhasil diperbarui.';
                $pesanGagal  = 'Gagal memperbarui data ke database.';
            } else {
                // Logika Insert Single: Cek dulu apakah data sudah ada
                $cekAda = $this->rm11b2MonitoringAnestesiDataModel
                    ->where('idMonitoring', $dataSimpan['idMonitoring'])
                    ->where('waktu', $dataSimpan['waktu'])
                    ->where('jenis', $dataSimpan['jenis'])
                    ->first();

                if ($cekAda) {
                    return $this->response->setJSON([
                        'status'  => 'ignored',
                        'message' => 'Data untuk waktu jam ' . $dataSimpan['waktu'] . ' sudah ada, input diabaikan.'
                    ]);
                }

                $simpan = $this->rm11b2MonitoringAnestesiDataModel->insert($dataSimpan);

                $pesanSukses = 'Data tanda vital berhasil disimpan.';
                $pesanGagal  = 'Gagal menyimpan data ke database.';
            }

            if ($simpan) {
                return $this->response->setJSON([
                    'status'  => 'success',
                    'message' => $pesanSukses
                ]);
            } else {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => $pesanGagal
                ]);
            }
        }
    }

    public function getDataMonitoring()
    {
        // Pastikan request datang dari AJAX
        if (!$this->request->isAJAX()) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $idMonitoring = $this->request->getPost('idMonitoring');
        $jenis        = $this->request->getPost('jenis');

        // Ambil data dari database menggunakan model, diurutkan berdasarkan waktu (ASC)
        $queryData = $this->rm11b2MonitoringAnestesiDataModel
            ->where('idMonitoring', $idMonitoring)
            ->where('jenis', $jenis)
            ->orderBy('waktu', 'ASC')
            ->findAll();

        // Menyiapkan struktur array penampung untuk dikelompokkan
        $jam      = [];
        $sistolik = [];
        $diastolik = [];
        $rr       = [];
        $spo2     = [];
        $temp     = [];

        // Looping untuk memisahkan data baris database ke dalam masing-masing array kolom
        foreach ($queryData as $row) {
            $jam[]      = $row['waktu'];
            $sistolik[] = (float) $row['sistolik'];
            $diastolik[] = (float) $row['diastolik'];
            $rr[]       = (float) $row['rr'];
            $spo2[]     = (float) $row['spo2'];
            $temp[]     = (float) $row['temp'];
        }

        // Menggabungkan data mentah dari DB dan data yang sudah diolah/dikelompokkan
        $response = [
            'status' => 'success',
            // 1. Data mentah langsung dari database
            'data_db' => $queryData,

            // 2. Data yang sudah diolah dan dikelompokkan khusus untuk Chart.js
            'chart_data' => [
                'jam'       => $jam,
                'sistolik'  => $sistolik,
                'diastolik' => $diastolik,
                'rr'        => $rr,
                'spo2'      => $spo2,
                'temp'      => $temp
            ]
        ];

        // Return sebagai JSON ke jQuery di sisi klien
        return $this->response->setJSON($response);
    }

    public function getDataMonitoringById()
    {
        // Pastikan request datang dari AJAX
        if (!$this->request->isAJAX()) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $id = $this->request->getPost('id');

        // Ambil data dari database menggunakan model, diurutkan berdasarkan waktu (ASC)
        $queryData = $this->rm11b2MonitoringAnestesiDataModel
            ->where('id', $id)
            ->first();

        // Menggabungkan data mentah dari DB dan data yang sudah diolah/dikelompokkan
        $response = [
            'status' => 'success',
            // 1. Data mentah langsung dari database
            'data' => $queryData,
        ];

        // Return sebagai JSON ke jQuery di sisi klien
        return $this->response->setJSON($response);
    }

    public function hapusMonitoring()
    {
        // Pastikan request datang dari AJAX
        if (!$this->request->isAJAX()) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $id = $this->request->getPost('id');

        if (empty($id)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'ID data tidak valid!'
            ]);
        }

        // Proses hapus menggunakan model
        $hapus = $this->rm11b2MonitoringAnestesiDataModel->delete($id);

        if ($hapus) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Data monitoring berhasil dihapus.'
            ]);
        } else {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Gagal menghapus data dari database.'
            ]);
        }
    }
}
