<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\SysLogModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    /**
     * Mengecek semua field dalam data hasil query
     * @param mixed $data - Hasil query (Object/Array)
     * @return string
     */
    protected function cekSemuaKolom($data, array $kecualikan = []): string
    {
        if (empty($data)) {
            return "Belum Diisi";
        }

        // Pastikan data dalam bentuk array agar bisa di-loop
        $dataArray = is_object($data) ? get_object_vars($data) : $data;

        $totalKolomDicek = 0;
        $kolomTerisi = 0;

        foreach ($dataArray as $key => $value) {
            // Jika nama kolom (key) ada di dalam daftar pengecualian, lewati (skip)
            if (in_array($key, $kecualikan)) {
                continue;
            }

            $totalKolomDicek++;

            // Cek apakah kolom ini ada isinya (tidak null, tidak string kosong, dan bukan cuma spasi)
            if ($value !== null && trim((string)$value) !== "") {
                $kolomTerisi++;
            }
        }

        // =======================================================
        // PENENTUAN STATUS BERDASARKAN COUNTER
        // =======================================================
        if ($kolomTerisi === 0) {
            return "Belum Diisi"; // Semua kolom kosong
        }

        if ($kolomTerisi === $totalKolomDicek) {
            return "Lengkap"; // Semua kolom terisi tanpa terkecuali
        }

        return "Tidak Lengkap"; // Menggantung (ada yang terisi, ada yang kosong)
    }

    protected function uploadTtd($canvasData, $fileName, $folderPath)
    {
        if (empty($canvasData)) {
            return null;
        }

        // 1. Bersihkan data jika ada spasi yang berubah menjadi karakter '+' saat dikirim via POST
        $canvasData = str_replace(' ', '+', $canvasData);

        // 2. Mengurai data Base64 dengan regex yang lebih aman
        if (preg_match('/^data:image\/(\w+);base64,/', $canvasData, $type)) {
            // Ambil data setelah tanda koma
            $fileData = substr($canvasData, strpos($canvasData, ',') + 1);
            $extension = strtolower($type[1]); // png, jpg, dll
        } else {
            // Jika formatnya string base64 murni tanpa header 'data:image/png...'
            $fileData = $canvasData;
            $extension = 'png';
        }

        // Decode data base64 menjadi biner gambar
        $binaryData = base64_decode($fileData);
        if ($binaryData === false) {
            return null; // Gagal decode
        }

        // Tentukan nama file dan path folder tujuan
        $fullFileName = $fileName . '.' . $extension;
        $destinationFolder = ROOTPATH . 'public/ttd/' . trim($folderPath, '/') . '/';

        // Buat folder otomatis jika belum ada dengan permission 0755 atau 0777
        if (!is_dir($destinationFolder)) {
            mkdir($destinationFolder, 0775, true);
        }

        $savePath = $destinationFolder . $fullFileName;

        // 3. Proses simpan file fisik
        if (file_put_contents($savePath, $binaryData) !== false) {
            // Tambahan: Set permission file agar bisa dibaca/ditulis dengan aman
            chmod($savePath, 0664);
            return $fullFileName;
        }

        return null; // Gagal menulis file ke disk
    }

    public function catatLog($tindakan, $tabel, $noRawat, $dataLama, $dataBaru = null)
    {
        $sysLog = new SysLogModel();

        $petugas = session()->get('nama') ?? 'System / Unknown';

        $jsonLama = !empty($dataLama) ? json_encode($dataLama, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) : null;
        $jsonBaru = !empty($dataBaru) ? json_encode($dataBaru, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) : null;

        $log = [
            "petugas"  => $petugas,
            "tindakan" => $tindakan,
            "tabel"    => $tabel,
            "dataLama" => $jsonLama,
            "dataBaru" => $jsonBaru,
            "noRawat"  => $noRawat
        ];

        // Menggunakan try-catch agar jika log gagal disimpan, aplikasi utama tidak ikut crash
        try {
            $sysLog->save($log);
        } catch (\Exception $e) {
            // Opsional: Anda bisa me-log error internal ini ke log file CodeIgniter
            log_message('error', 'Gagal mencatat SysLog: ' . $e->getMessage());
        }
    }

    function tanggalCetak($tanggalInput)
    {
        // Proteksi jika data di database NULL atau kosong
        if (empty($tanggalInput) || $tanggalInput == '0000-00-00 00:00:00') {
            return '-';
        }

        $bulan = [
            1 => "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];

        $timestamp = strtotime($tanggalInput);

        $hari = date("j", $timestamp);
        $bulanNama = $bulan[(int)date("n", $timestamp)];
        $tahun = date("Y", $timestamp);

        $jam = date("H:i", $timestamp);

        return $hari . " " . $bulanNama . " " . $tahun . ", Pukul " . $jam . " WIB";
    }
}
