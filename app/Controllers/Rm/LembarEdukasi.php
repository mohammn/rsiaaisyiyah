<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\LembarEdukasiModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\PetugasModel;

class LembarEdukasi extends BaseController
{
    protected $regPeriksaModel;
    protected $lembarEdukasiModel;
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
        $this->lembarEdukasiModel = new LembarEdukasiModel();
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->sysLog = new SysLogModel();
        $this->pengaturan = new PengaturanModel();
        $this->pjPasienModel = new PjPasienModel();
        $this->petugasModel = new PetugasModel();
    }

    public function index($noRawat)
    {
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
                pasien.agama, 
                pasien.tmp_lahir, 
                pasien.tgl_lahir
            ')
            ->join('pasien', 'pasien.no_rkm_medis = reg_periksa.no_rkm_medis', 'left')
            ->where('reg_periksa.no_rawat', $noRawat)
            ->first();

        $lembarEdukasi = $this->lembarEdukasiModel->where('noRawat', $noRawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'lembarEdukasi' => $lembarEdukasi,
            'pjPasien' => $pjPasien,
            'petugas'     => $petugas,      // Jangan pakai (object) di sini
            'pengaturan' => $pengaturan
        ];

        return view('rm/lembarEdukasi', ['data' => $data]);
    }

    public function simpan()
    {
        // 1. Tangkap objek identitas dan dataEdukasi dari AJAX
        $identitas   = $this->request->getPost("identitas");
        $dataEdukasi = $this->request->getPost("dataEdukasi");

        // 2. Masukkan data Identitas Utama ke array $data
        $data = [
            "noRawat"            => $identitas["noRawat"] ?? null,
            "petugas"             => $identitas["petugas"] ?? null,
            "nama"                => $identitas["nama"] ?? null,
            "agama"               => $identitas["agama"] ?? '',
            "bahasa"              => $identitas["bahasa"] ?? '',
            "penerjemah"          => $identitas["penerjemah"] ?? '',
            "pendidikan"              => $identitas["pendidikan"] ?? '',
            "baca_tulis"          => $identitas["bacaTulis"] ?? '',
            "komunikasi"          => $identitas["komunikasi"] ?? '',
            "hambatan_edukasi"    => $identitas["hambatan_edukasi"] ?? '',
            "intervensi_hambatan" => $identitas["intervensi_hambatan"] ?? '',
            "nilai_keyakinan"     => $identitas["nilai_keyakinan"] ?? null,
            "kesediaan_informasi" => $identitas["kesediaan_informasi"] ?? ''
        ];

        // 3. Masukkan data dari indeks 1-8 langsung ke dalam array $data yang sama (Menyamping)
        if (!empty($dataEdukasi)) {
            foreach ($dataEdukasi as $idx => $item) {
                // Gabungkan array checkbox menjadi string dipisah koma
                $metodeString = isset($item['metode']) ? implode(', ', $item['metode']) : '';
                $mediaString  = isset($item['media']) ? implode(', ', $item['media']) : '';

                // Otomatis membuat key: tgl_1, metode_1, media_1, dll.
                $data["tgl_{$idx}"]      = !empty($item["tanggal"]) ? $item["tanggal"] : null;
                $data["metode_{$idx}"]   = $metodeString;
                $data["media_{$idx}"]    = $mediaString;
                $data["evaluasi_{$idx}"] = !empty($item["evaluasi"]) ? $item["evaluasi"] : null;

                // Masukkan data 'lainnya' jika kolomnya ada di database (misal di indeks 5, 6, 7, 8)
                $data["lainnya_{$idx}"]  = $item["lainnya"] ?? '';
                $data["petugas_{$idx}"]  = $item["petugas"] ?? '';
                $data["wali_{$idx}"]  = $item["wali"] ?? '';
            }
        }

        $noRawat = $identitas["noRawat"] ?? null;

        // 4. Eksekusi Simpan / Ubah menggunakan Model Tunggal Anda
        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->lembarEdukasiModel->save($data);
        } else {
            unset($data['noRawat']); // hapus primary key agar tidak ikut ter-update

            // Catat log perubahan data
            $this->catatLog('ubah', 'lembar_edukasi', $noRawat, $this->lembarEdukasiModel->where('noRawat', $noRawat)->first(), $data);

            // Update data
            $this->lembarEdukasiModel->where('noRawat', $noRawat)->set($data)->update();
        }

        // 5. Response JSON kembalian ke AJAX
        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil disimpan ke dalam 1 tabel'
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

        $this->lembarEdukasiModel->where('noRawat', $noRawat)->set($data)->update();
        echo json_encode('');
    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $this->catatLog('hapus', 'lembar_edukasi', $noRawat, $this->lembarEdukasiModel->where('noRawat', $noRawat)->first());

        $this->lembarEdukasiModel->where("noRawat", $noRawat)->delete();
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
                pasien.tgl_lahir,
                bangsal.nm_bangsal
            ')
            ->join('pasien', 'pasien.no_rkm_medis = reg_periksa.no_rkm_medis', 'left')
            ->join('kamar_inap', 'reg_periksa.no_rawat = kamar_inap.no_rawat', 'left')
            ->join('kamar', 'kamar_inap.kd_kamar = kamar.kd_kamar', 'left')
            ->join('bangsal', 'kamar.kd_bangsal = bangsal.kd_bangsal', 'left')
            ->where('reg_periksa.no_rawat', $noRawat)
            ->first();

        $lembarEdukasi = $this->lembarEdukasiModel->where('noRawat', $noRawat)->first();
        if ($lembarEdukasi) {
            $lembarEdukasi["tglTtd"] = $this->tanggalCetak($lembarEdukasi["tglinput"]);
        }

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'lembarEdukasi' => $lembarEdukasi
        ];
        echo view("cetak/lembarEdukasi", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function simpanTtd()
    {
        // Ambil input noRawat dan data canvas dari form
        $noRawat = $this->request->getPost("noRawat");
        $lembarEdukasi = $this->lembarEdukasiModel->where('noRawat', $noRawat)->first();

        // Jika data rekam medis tidak ditemukan, kembalikan error agar tidak terjadi fatal error di bawah
        if (!$lembarEdukasi) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Data Lembar Edukasi tidak ditemukan.'
            ]);
        }

        $noRawat = str_replace('/', '-', $noRawat);
        $ttdWali = $this->request->getPost("ttdWali");
        $ttd     = $this->request->getPost("ttd"); // Berupa array/objek dari JS

        $lokasiFolder = 'lembarEdukasi';
        $data = [];

        // Cek Wali: Jika dikirimkan tanda tangan baru DAN di DB masih kosong/belum ada nama file
        if (!empty($ttdWali) && empty($lembarEdukasi["ttdWali"])) {
            $data["ttdWali"] = $this->uploadTtd($ttdWali, $noRawat . '_wali', $lokasiFolder);
        }

        // Cek 8 Tanda Tangan Edukasi
        if (is_array($ttd)) {
            foreach ($ttd as $idx => $item) {
                // PERBAIKAN: $item adalah string Base64.
                // Cek jika $item tidak kosong (ada ttd baru) DAN di DB kolom ttd tersebut masih kosong
                if (!empty($item) && empty($lembarEdukasi["ttd_" . $idx])) {
                    $data["ttd_{$idx}"] = $this->uploadTtd($item, $noRawat . '_ttd_' . $idx, $lokasiFolder);
                }
            }
        }

        // Hanya lakukan update jika ada data baru yang berhasil diproses/dimasukkan ke array $data
        if (!empty($data)) {
            $noRawat = str_replace('-', '/', $noRawat);
            $this->lembarEdukasiModel->where('noRawat', $noRawat)->set($data)->update();
        }

        return $this->response->setJSON([
            'status'  => 'success'
        ]);
    }
}
