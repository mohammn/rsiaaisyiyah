<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\PersetujuanRajalModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;

class PersetujuanRajal extends BaseController
{
    protected $regPeriksaModel;
    protected $persetujuanRajalModel;
    protected $sysLog;
    protected $pengaturan;
    protected $pjPasienModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->persetujuanRajalModel = new PersetujuanRajalModel();
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->sysLog = new SysLogModel();
        $this->pengaturan = new PengaturanModel();
        $this->pjPasienModel = new PjPasienModel();
    }

    public function index($noRawat)
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

        $persetujuanRajal = $this->persetujuanRajalModel->where('noRm', $pasien["no_rkm_medis"])->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'persetujuanRajal' => $persetujuanRajal,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/persetujuanRajal', ['data' => $data]);
    }

    public function tambah()
    {
        $data = [
            "noRm" => $this->request->getPost("noRm"),
            "nama" => $this->request->getPost("namaWali"),
            "noHp" => $this->request->getPost("noTelp"),
            "alamat" => $this->request->getPost("alamat"),
            "sebagai" => $this->request->getPost("sebagai"),
            "petugas" => $this->request->getPost("petugas"),
            "saksi" => $this->request->getPost("saksi"),
            "keluarga" => $this->request->getPost("namaKeluarga"),
            "pembayaran" => $this->request->getPost("pembayaran"),
            "selesai" => '0'
        ];

        $this->persetujuanRajalModel->save($data);

        echo json_encode("");
    }

    public function edit()
    {
        $noRm = $this->request->getPost("noRm");
        $data = [
            "keluarga" => $this->request->getPost("namaKeluarga"),
            "noHp" => $this->request->getPost("noTelp")
        ];


        $this->catatLog('ubah', 'persetujuanrajal', $noRm, $this->persetujuanRajalModel->where('noRm', $noRm)->first(), $data);

        $this->persetujuanRajalModel->where('noRm', $noRm);
        $this->persetujuanRajalModel->update(null, $data);
        echo json_encode('');
    }

    public function ubahWaktu()
    {
        $noRm = $this->request->getPost("noRm");
        $waktu   = $this->request->getPost("waktu");

        $data = [
            "tglinput" => str_replace('T', ' ', $waktu) . ':00'
        ];

        $this->persetujuanRajalModel->where('noRm', $noRm)->set($data)->update();
        echo json_encode('');
    }

    public function hapus()
    {
        $noRm = $this->request->getPost("noRm");
        $this->catatLog('hapus', 'persetujuan_rajal', $noRm, $this->persetujuanRajalModel->where('noRm', $noRm)->first());

        $this->persetujuanRajalModel->where("noRm", $noRm)->delete();
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

        $persetujuanRajal = $this->persetujuanRajalModel->where('noRm', $pasien["no_rkm_medis"])->first();
        if ($persetujuanRajal) {
            $persetujuanRajal["tglTtd"] = $this->tanggalCetak($persetujuanRajal["tglinput"]);
        }

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'persetujuanRajal' => $persetujuanRajal
        ];
        echo view("cetak/persRajal", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function simpanTtd()
    {
        // Ambil input noRawat dan data canvas dari form
        $noRm    = $this->request->getPost("noRm");
        $ttdSaksi   = $this->request->getPost("ttdSaksi");
        $ttdWali    = $this->request->getPost("ttdWali");

        $lokasiFolder = 'persRajal';

        $data = [
            "selesai" => "1",
            "ttdWali" => $this->uploadTtd($ttdWali, $noRm . '_wali', $lokasiFolder),
            "ttdSaksi" => $this->uploadTtd($ttdSaksi, $noRm . '_saksi', $lokasiFolder)
        ];

        $this->persetujuanRajalModel->where('noRm', $noRm)->set($data)->update();

        return $this->response->setJSON([
            'status'  => 'success'
        ]);
    }

    public function jalankanMigrasiTtd()
    {
        // Tambah batas waktu eksekusi agar tidak timeout
        set_time_limit(300);

        $semuaData = $this->persetujuanRajalModel->findAll();

        // PERBAIKAN: Menggunakan ROOTPATH agar pasti masuk ke folder public yang benar
        $folderTujuan = ROOTPATH . 'public/ttd/persRajal/';

        // Buat folder tujuan secara rekursif jika belum ada
        if (!is_dir($folderTujuan)) {
            mkdir($folderTujuan, 0777, true);
        }

        $jumlahWaliTerubah = 0;
        $jumlahSaksiTerubah = 0;
        $errorLog = [];

        foreach ($semuaData as $row) {
            $noRm = $row['noRm'];
            $dataUpdate = ['id' => $row['id']]; // Sesuaikan nama Primary Key tabel kamu
            $eksekusiUpdate = false;

            // Fungsi lokal untuk memproses decoding Base64 dan penulisan file fisik
            $prosesFile = function ($fieldData, $suffix) use ($folderTujuan, $noRm, &$errorLog) {
                if (empty($fieldData) || str_contains((string)$fieldData, '.png')) {
                    return false;
                }

                $namaFile = $noRm . $suffix . '.png';
                $fullPath = $folderTujuan . $namaFile;

                // Jika data berupa resource stream dari database
                if (is_resource($fieldData)) {
                    $fieldData = stream_get_contents($fieldData);
                }

                // Decode data Base64 dari Canvas
                if (str_contains((string)$fieldData, 'data:image/png;base64,')) {
                    $rawBase64 = explode(',', $fieldData);
                    $dataBiner = base64_decode($rawBase64[1]);
                } else {
                    $dataBiner = $fieldData; // Fallback jika ternyata biner murni
                }

                // Tulis file ke target folder di public/ttd/persRajal/
                if (file_put_contents($fullPath, $dataBiner) !== false) {
                    return $namaFile;
                } else {
                    $errorLog[] = "Gagal menulis file fisik di folder public untuk RM: " . $noRm;
                    return false;
                }
            };

            // Eksekusi TTD Wali
            $hasilWali = $prosesFile($row['ttdWali'], '_wali');
            if ($hasilWali !== false) {
                $dataUpdate['ttdWali'] = $hasilWali;
                $eksekusiUpdate = true;
                $jumlahWaliTerubah++;
            }

            // Eksekusi TTD Saksi
            $hasilSaksi = $prosesFile($row['ttdSaksi'], '_saksi');
            if ($hasilSaksi !== false) {
                $dataUpdate['ttdSaksi'] = $hasilSaksi;
                $eksekusiUpdate = true;
                $jumlahSaksiTerubah++;
            }

            // Database HANYA di-update jika file fisik sukses tertulis di folder public yang benar
            if ($eksekusiUpdate) {
                $this->persetujuanRajalModel->save($dataUpdate);
            }
        }

        // Tampilkan Laporan Akhir
        echo "<h2>Hasil Migrasi Sukses (Path Terbuka):</h2>";
        echo "Sukses TTD Wali: " . $jumlahWaliTerubah . " file.<br>";
        echo "Sukses TTD Saksi: " . $jumlahSaksiTerubah . " file.<br>";
        echo "Lokasi fisik saat ini: <code>" . $folderTujuan . "</code><br>";

        if (!empty($errorLog)) {
            echo "<h3>Log Error:</h3><ul>";
            foreach ($errorLog as $err) {
                echo "<li style='color:red;'>$err</li>";
            }
            echo "</ul>";
        } else {
            echo "<h3 style='color:green;'>Selamat! Semua file sukses masuk ke folder public/ttd/persRajal/</h3>";
        }
        exit;
    }
}
