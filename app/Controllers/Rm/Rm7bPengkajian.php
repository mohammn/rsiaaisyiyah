<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\Rm7bPengkajianModel;
use App\Models\Rm7bPengkajianDataModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;
use App\Models\ResepPulangModel;

class Rm7bPengkajian extends BaseController
{
    protected $regPeriksaModel;
    protected $rm7bPengkajianModel;
    protected $rm7bPengkajianDataModel;
    protected $sysLog;
    protected $pengaturan;
    protected $pjPasienModel;
    protected $dokterModel;
    protected $resepPulangModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->rm7bPengkajianModel = new Rm7bPengkajianModel();
        $this->rm7bPengkajianDataModel = new Rm7bPengkajianDataModel();
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->sysLog = new SysLogModel();
        $this->pengaturan = new PengaturanModel();
        $this->pjPasienModel = new PjPasienModel();
        $this->dokterModel = new DokterModel();
        $this->resepPulangModel = new ResepPulangModel();
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

        $dokter =  $this->dokterModel->where('kd_dokter !=', '-')->findAll();

        $rm7bPengkajian = $this->rm7bPengkajianModel->where('noRawat', $noRawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $resepPulang = $this->resepPulangModel->getResepByNoRawat($noRawat);
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'rm7bPengkajian' => $rm7bPengkajian,
            'resepPulang' => $resepPulang,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/rm7bPengkajian', ['data' => $data]);
    }

    public function simpan()
    {
        // 1. Get all data from the POST request
        $allData = $this->request->getPost();

        // 2. Process Array Fields (Save as JSON)
        $arrayFields = [
            'jenisGynekologi',
            'riwayatAlergi',
            'keadaanPsikologis',
            'tinggalBersama',
            'diagnosaKhusus',
            'keluhanLain',
            'perinium',
            'jahitan',
            'kelainan',
            'intervensi'
        ];

        foreach ($arrayFields as $field) {
            if (isset($allData[$field]) && is_array($allData[$field])) {
                // Convert PHP Array to JSON string: ["Value1","Value2"]
                $allData[$field] = json_encode($allData[$field]);
            } else {
                // If nothing is selected, save as an empty JSON array or NULL
                $allData[$field] = json_encode([]);
            }
        }

        // 3. Process Date, Time, and DateTime fields (Save as NULL if empty)
        // List all your date/time field names here
        $dateTimeFields = ['tgl', 'hpht', 'hpl', 'jamNyeri', 'waktuVt'];

        foreach ($dateTimeFields as $field) {
            if (isset($allData[$field]) && trim($allData[$field]) === "") {
                $allData[$field] = null; // This sends actual NULL to MySQL
            }
        }

        // 4. Metadata handling
        $tujuanSimpan = $allData['tujuanSimpan'] ?? 'tambah';
        $noRawat = $allData['noRawat'];

        // Remove variables that don't exist in your Database table

        unset($allData['tujuanSimpan']);
        $data = $allData;

        if ($tujuanSimpan == 'tambah') {
            $this->rm7bPengkajianModel->save($data);
            $this->catatLog('tambah', 'rm7b_pengkajian', $this->request->getPost("noRawat"), $this->rm7bPengkajianModel->where('noRawat', $this->request->getPost("noRawat"))->first());
        } else {
            $noRawat = $this->request->getPost("noRawat");
            unset($data['noRawat']);

            $this->catatLog('ubah', 'rm7b_pengkajian', $noRawat, $this->rm7bPengkajianModel->where('noRawat', $noRawat)->first(), $data);

            $this->rm7bPengkajianModel->where('noRawat', $noRawat)->set($data)->update();
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function muatRiwayat()
    {
        $id = $this->request->getPost('id');
        $data = $this->rm7bPengkajianDataModel
            ->where('id_pengkajian', $id)
            ->orderBy('hamil_ke', 'ASC') // Mengurutkan dari hamil ke-1, 2, dst.
            ->findAll();

        return $this->response->setJSON($data);
    }

    public function tambahRiwayat()
    {
        $data = [
            'id_pengkajian'      => $this->request->getPost('idPengkajian'),
            'hamil_ke'           => $this->request->getPost('hamil_ke'),
            'abortus'            => $this->request->getPost('abortus'),
            'prematur'           => $this->request->getPost('prematur'),
            'aterm'              => $this->request->getPost('aterm'),
            'jenis_persalinan'   => $this->request->getPost('jenis_persalinan'),
            'penolong_nakes'     => $this->request->getPost('penolong_nakes'),
            'penolong_non_nakes' => $this->request->getPost('penolong_non_nakes'),
            'jk'                 => $this->request->getPost('jk'),
            'bbl'                => $this->request->getPost('bbl'),
            'keadaan_normal'     => $this->request->getPost('keadaan_normal'),
            'keadaan_cacat'      => $this->request->getPost('keadaan_cacat'),
            'keadaan_mati'       => $this->request->getPost('keadaan_mati'),
        ];

        $this->rm7bPengkajianDataModel->save($data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function hapusRiwayat()
    {
        $id = $this->request->getPost('id');

        if ($id) {
            $hapus = $this->rm7bPengkajianDataModel->delete($id);

            if ($hapus) {
                return $this->response->setJSON([
                    'status'  => 'success',
                    'message' => 'Data riwayat berhasil dihapus'
                ]);
            }
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Gagal menghapus data'
        ], 400);
    }

    public function ubahWaktu()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $waktu   = $this->request->getPost("waktu");

        $data = [
            "tglinput" => str_replace('T', ' ', $waktu) . ':00'
        ];

        $this->rm7bPengkajianModel->where('noRawat', $noRawat)->set($data)->update();
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

        $rm7bPengkajian = $this->rm7bPengkajianModel->where('noRawat', $noRawat)->first();
        $rm7bPengkajianData = $this->rm7bPengkajianDataModel
            ->where('id_pengkajian', $rm7bPengkajian['id'])
            ->orderBy('hamil_ke', 'ASC') // Mengurutkan dari hamil ke-1, 2, dst.
            ->findAll();
        if ($rm7bPengkajian) {
            $rm7bPengkajian["tglTtd"] = $this->tanggalCetak($rm7bPengkajian["tglinput"]);
        }

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $resepPulang = $this->resepPulangModel->getResepByNoRawat($noRawat);
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'rm7bPengkajian' => $rm7bPengkajian,
            'rm7bPengkajianData' => $rm7bPengkajianData,
            'resepPulang' => $resepPulang,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];
        echo view("cetak/rm7bPengkajian", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $this->catatLog('hapus', 'rm7b_pengkajian', $noRawat, $this->rm7bPengkajianModel->where('noRawat', $noRawat)->first());

        $this->rm7bPengkajianModel->where("noRawat", $noRawat)->delete();
        echo json_encode("");
    }

    public function simpanTtd()
    {
        // Ambil input noRawat dan data canvas dari form
        $noRawat    = $this->request->getPost("noRawat");
        $noRawat = str_replace('/', '-', $noRawat);
        $ttdPetugas    = $this->request->getPost("ttdPetugas");

        $lokasiFolder = 'rm7bPengkajian';

        $data = [
            "ttdPetugas" => $this->uploadTtd($ttdPetugas, $noRawat . '_petugas', $lokasiFolder)
        ];

        $noRawat = str_replace('-', '/', $noRawat);
        $cekTtd = $this->rm7bPengkajianModel->where('noRawat', $noRawat)->first();

        if ($cekTtd['ttdPetugas']) {
            unset($data['ttdPetugas']);
        }
        $this->rm7bPengkajianModel->where('noRawat', $noRawat)->set($data)->update();

        return $this->response->setJSON([
            'status'  => 'success'
        ]);
    }
}
