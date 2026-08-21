<?php

namespace App\Controllers\Farmasi;

use App\Controllers\BaseController;

use App\Models\ObatPulangModel;
use App\Models\ObatPulangDataModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;
use App\Models\ResepPulangModel;
use App\Models\DpjpModel;

class ObatPulang extends BaseController
{
    protected $regPeriksaModel;
    protected $obatPulangModel;
    protected $obatPulangDataModel;
    protected $sysLog;
    protected $pengaturan;
    protected $pjPasienModel;
    protected $dokterModel;
    protected $resepPulangModel;
    protected $dpjpModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->obatPulangModel = new ObatPulangModel();
        $this->obatPulangDataModel = new ObatPulangDataModel();
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->sysLog = new SysLogModel();
        $this->pengaturan = new PengaturanModel();
        $this->pjPasienModel = new PjPasienModel();
        $this->dokterModel = new DokterModel();
        $this->resepPulangModel = new ResepPulangModel();
        $this->dpjpModel = new DpjpModel();
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
                pasien.tmp_lahir, 
                pasien.tgl_lahir
            ')
            ->join('pasien', 'pasien.no_rkm_medis = reg_periksa.no_rkm_medis', 'left')
            ->where('reg_periksa.no_rawat', $noRawat)
            ->first();
        $dpjp = $this->dpjpModel->where('noRawat', $noRawat)->first();

        $obatPulang = $this->obatPulangModel->where('noRawat', $noRawat)->first();
        $dataObatDetail = $this->obatPulangDataModel->where('noRawat', $noRawat)->findAll();
        $obatPulangDataMap = [];
        foreach ($dataObatDetail as $detail) {
            $obatPulangDataMap[$detail['kode_brng']] = $detail;
        }

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $resepPulang = $this->resepPulangModel->getResepByNoRawat($noRawat);
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'obatPulang' => $obatPulang,
            'obatPulangData'  => $obatPulangDataMap, // Data Anak (indexed by kode_brng)
            'resepPulang' => $resepPulang,
            'pjPasien' => $pjPasien,
            'dpjp'     => $dpjp,
            'pengaturan' => $pengaturan
        ];

        return view('farmasi/obatPulang', ['data' => $data]);
    }

    public function simpan()
    {
        log_message('error', 'DATA POST: ' . print_r($this->request->getPost(), true));

        $db = \Config\Database::connect();
        $db->transBegin();

        $noRawat = trim($this->request->getPost("noRawat") ?? '');

        // 1. Data Utama
        $dataUtama = [
            "noRawat"    => $noRawat,
            "nama"       => $this->request->getPost("nama"),
            "ruang"       => $this->request->getPost("ruang"),
            "petugas"    => $this->request->getPost("petugas"),
            "keterangan" => $this->request->getPost("keterangan"),
        ];

        // 2. Data Obat Dinamis
        $dataObat = $this->request->getPost("pemberianObat") ?? [];

        // Cek apakah data sudah ada di database
        $dataLama = $this->obatPulangModel->where('noRawat', $noRawat)->first();

        if ($dataLama) {
            // --- JIKA DATA SUDAH ADA -> UPDATE ---
            $obatPulangId = $dataLama['id'];

            $updateResult = $this->obatPulangModel->update($obatPulangId, $dataUtama);
            if (!$updateResult) {
                $err = $db->error();
                $db->transRollback();
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'Gagal Update Data Utama: ' . $err['message']
                ]);
            }

            // Hapus detail obat lama untuk di-insert ulang
            $this->obatPulangDataModel->where('obat_pulang_id', $obatPulangId)->delete();
        } else {
            // --- JIKA DATA BELUM ADA -> INSERT BARU ---
            $insertResult = $this->obatPulangModel->insert($dataUtama);
            if (!$insertResult) {
                $err = $db->error();
                $db->transRollback();
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'Gagal Insert Data Utama: ' . $err['message']
                ]);
            }

            // AMBIL LAST INSERT ID DARI DATABASE LANGSUNG
            $obatPulangId = $db->insertID();
        }

        // PROTEKSI KETAT: Jika ID tetap gagal/0, batalkan proses
        if (!$obatPulangId || $obatPulangId == 0) {
            $db->transRollback();
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Gagal mendapatkan ID Utama! ID bernilai: ' . var_export($obatPulangId, true)
            ]);
        }

        // 3. Simpan Detail Obat
        if (!empty($dataObat)) {
            $batchDataObat = [];

            foreach ($dataObat as $item) {
                if (!empty($item['kode_brng'])) {
                    $batchDataObat[] = [
                        'obat_pulang_id' => (int) $obatPulangId, // Pastikan ID terisi Integer valid
                        'noRawat'        => $noRawat,
                        'kode_brng'      => trim($item['kode_brng']),
                        'pagi'           => !empty($item['pagi']) ? $item['pagi'] : null,
                        'siang'          => !empty($item['siang']) ? $item['siang'] : null,
                        'sore'           => !empty($item['sore']) ? $item['sore'] : null,
                        'malam'          => !empty($item['malam']) ? $item['malam'] : null,
                        'instruksi'      => !empty($item['instruksi']) ? $item['instruksi'] : null,
                        'petugas'        => $this->request->getPost("petugas")
                    ];
                }
            }

            if (!empty($batchDataObat)) {
                $batchResult = $this->obatPulangDataModel->insertBatch($batchDataObat);
                if (!$batchResult) {
                    $err = $db->error();
                    $db->transRollback();
                    return $this->response->setJSON([
                        'status'  => 'error',
                        'message' => 'Gagal Insert Detail Obat: ' . $err['message']
                    ]);
                }
            }
        }

        $db->transCommit();

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil disimpan'
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

        $this->obatPulangModel->where('noRawat', $noRawat)->set($data)->update();
        echo json_encode('');
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

        $obatPulang = $this->obatPulangModel->where('noRawat', $noRawat)->first();
        if ($obatPulang) {
            $obatPulang["tglTtd"] = $this->tanggalCetak($obatPulang["tglinput"]);
        }
        $dataObatDetail = $this->obatPulangDataModel->where('noRawat', $noRawat)->findAll();
        $obatPulangDataMap = [];
        foreach ($dataObatDetail as $detail) {
            $obatPulangDataMap[$detail['kode_brng']] = $detail;
        }

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $resepPulang = $this->resepPulangModel->getResepByNoRawat($noRawat);
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'obatPulang' => $obatPulang,
            'obatPulangData'  => $obatPulangDataMap, // Data Anak (indexed by kode_brng)
            'resepPulang' => $resepPulang,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];
        echo view("cetak/obatPulang", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $this->catatLog('hapus', 'obat_pulang', $noRawat, $this->obatPulangModel->where('noRawat', $noRawat)->first());

        $this->obatPulangModel->where("noRawat", $noRawat)->delete();
        echo json_encode("");
    }

    public function simpanTtd()
    {
        // Ambil input noRawat dan data canvas dari form
        $noRawat    = $this->request->getPost("noRawat");
        $noRawat = str_replace('/', '-', $noRawat);
        $ttdWali    = $this->request->getPost("ttdWali");

        $lokasiFolder = 'obatPulang';

        $data = [
            "ttdWali" => $this->uploadTtd($ttdWali, $noRawat . '_wali', $lokasiFolder),
        ];

        $noRawat = str_replace('-', '/', $noRawat);
        $this->obatPulangModel->where('noRawat', $noRawat)->set($data)->update();

        return $this->response->setJSON([
            'status'  => 'success'
        ]);
    }
}
