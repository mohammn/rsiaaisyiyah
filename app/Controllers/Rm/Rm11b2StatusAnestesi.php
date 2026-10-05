<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\Rm11b2StatusAnestesiModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;
use App\Models\PetugasModel;

class Rm11b2StatusAnestesi extends BaseController
{
    protected $regPeriksaModel;
    protected $rm11b2StatusAnestesiModel;
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
        $this->rm11b2StatusAnestesiModel = new Rm11b2StatusAnestesiModel();
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

        $rm11b2StatusAnestesi = $this->rm11b2StatusAnestesiModel->where('noRawat', $noRawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'petugas'     => $petugas,      // Jangan pakai (object) di sini
            'rm11b2StatusAnestesi' => $rm11b2StatusAnestesi,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/rm11b2StatusAnestesi', ['data' => $data]);
    }

    public function simpan()
    {
        // 1. Ambil seluruh data dari request POST
        $allData = $this->request->getPost();

        // 2. Daftar Field Array (Checklist / Multiple Choices) -> Simpan sebagai JSON
        $arrayFields = [
            // Tab I: Assesment & Pemeriksaan Organ
            'anamnesaDari',
            'pernafasan',
            'kardiovaskuler',
            'neuroMuskuloskeletal',
            'renalEndokrin',
            'hepatoGastro',
            'organLainLain',

            // Tab II: Rencana Anestesi
            'obatAwal',
            'permedikasiDetail',
            'generalAnestesiTipe',
            'obatInduksi',          // Jika sudah dipisah dari obatAwal
            'sedatifDetail',
            'analgetikDetail',
            'pelumpuhDetail',
            'obatMaintenance',      // Jika sudah dipisah dari obatAwal
            'inhalasiDetail',
            'intravenaDetail',
            'regionalAnestesiTipe',
            'anestesiLokalDetail',

            // Tab IV: Daftar Tilik & Pasca Induksi
            'persiapan',
            'pascaInduksi',

            // Tab V: Tata Laksana
            'posisi',
            'peralatanLain'
        ];

        foreach ($arrayFields as $field) {
            if (isset($allData[$field]) && is_array($allData[$field])) {
                // Encode ke format JSON: ["Item 1", "Item 2"]
                $allData[$field] = json_encode($allData[$field]);
            } else {
                // Jika tidak ada pilihan yang dicentang
                $allData[$field] = json_encode([]);
            }
        }

        // 3. Daftar Field Date & DateTime-Local -> Ubah string kosong "" menjadi NULL
        $dateTimeFields = [
            'tgl',             // type="date" (Tab Dokter/Perawat)
            'tanggalJamI',     // type="datetime-local" (Tab I)
            'tanggalJamII',    // type="datetime-local" (Tab II)
            'makanTerakhir',   // type="datetime-local" (Tab III)
            'minumTerakhir',   // type="datetime-local" (Tab III)
            'tanggalJamIII'    // type="datetime-local" (Tab III)
        ];

        foreach ($dateTimeFields as $field) {
            if (isset($allData[$field]) && trim($allData[$field]) === "") {
                $allData[$field] = null; // Mencegah error format tanggal 0000-00-00 di MySQL
            }
        }

        // Daftar nama checkbox tunggal
        $checkboxNames = [
            'pernafasanLainnyaCheck',
            'kardiovaskulerLainnyaCheck',
            'neuroLainnyaCheck',
            'renalLainnyaCheck',
            'hepatoLainnyaCheck',
            'organLainnyaCheck',
            'pernafasanDbn',
            'kardiovaskulerDbn',
            'neuroMuskuloskeletalDbn',
            'renalEndokrinDbn',
            'hepatoGastroDbn',
            'organLainLainDbn',
            'permedikasiLainnyaCheck',
            'gaLainnyaCheck',
            'sedatifLainnyaCheck',
            'analgetikLainnyaCheck',
            'pelumpuhLainnyaCheck',
            'inhalasiLainnyaCheck',
            'intravenaLainnyaCheck',
            'raLainnyaCheck',
            'additif1Check',
            'additif2Check'
        ];

        // Otomatis set nilai 1 jika dicentang, atau 0 jika di-uncheck
        foreach ($checkboxNames as $name) {
            $allData[$name] = ($this->request->getPost($name) == 1) ? 1 : 0;
        }

        // 4. Manajemen Penyimpanan & Log Activity
        $tujuanSimpan = $allData['tujuanSimpan'] ?? 'tambah';
        $noRawat      = $allData['noRawat'] ?? $this->request->getPost('noRawat');

        // Hapus variabel pendukung UI yang tidak ada di tabel database
        unset($allData['tujuanSimpan']);
        $data = $allData;

        if ($tujuanSimpan == 'tambah') {
            $this->rm11b2StatusAnestesiModel->save($data);
            $this->catatLog('tambah', 'rm11b2_status_anestesi', $noRawat, $this->rm11b2StatusAnestesiModel->where('noRawat', $noRawat)->first());
        } else {
            unset($data['noRawat']);

            $this->catatLog('ubah', 'rm11b2_status_anestesi', $noRawat, $this->rm11b2StatusAnestesiModel->where('noRawat', $noRawat)->first(), $data);
            $this->rm11b2StatusAnestesiModel->where('noRawat', $noRawat)->set($data)->update();
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data status anestesi berhasil disimpan'
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

        $this->rm11b2StatusAnestesiModel->where('noRawat', $noRawat)->set($data)->update();
        echo json_encode('');
    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $this->catatLog('hapus', 'rm11b1_checklist', $noRawat, $this->rm11b2StatusAnestesiModel->where('noRawat', $noRawat)->first());

        $this->rm11b2StatusAnestesiModel->where("noRawat", $noRawat)->delete();
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

        $rm11b2StatusAnestesi = $this->rm11b2StatusAnestesiModel->where('noRawat', $noRawat)->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'rm11b2StatusAnestesi' => $rm11b2StatusAnestesi
        ];
        echo view("cetak/rm11b2StatusAnestesi", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function simpanTtd()
    {
        // Ambil input noRawat dari form
        $noRawatRaw = $this->request->getPost("noRawat");
        $noRawatFile = str_replace('/', '-', $noRawatRaw); // Untuk penamaan file
        $noRawatDb   = str_replace('-', '/', $noRawatRaw); // Untuk query Database

        $lokasiFolder = 'rm11b2StatusAnestesi';

        // Daftar 7 field TTD beserta suffix nama filenya
        $listTtd = [
            'ttdDokter1' => '_ttdDokter1',
            'ttdDokter2' => '_ttdDokter2',
            'ttdDokter3'        => '_ttdDokter3',
            'ttdDokter4'       => '_ttdDokter4'
        ];

        // Ambil data eksisting dari Database
        $cekTtd = $this->rm11b2StatusAnestesiModel->where('noRawat', $noRawatDb)->first();

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
            $this->rm11b2StatusAnestesiModel->where('noRawat', $noRawatDb)->set($dataToUpdate)->update();
        }

        return $this->response->setJSON([
            'status' => 'success'
        ]);
    }
}
