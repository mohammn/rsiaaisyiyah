<?php

namespace App\Controllers\Jenis;


use App\Controllers\BaseController;

use App\Models\RegPeriksaModel;
use App\Models\PetugasModel;
use App\Models\PemeriksaanRalanModel;
use App\Models\PemeriksaanRanapModel;
use App\Models\CpptVerifModel;
use App\Models\CpptPenerimaModel;
use App\Models\Rm0SbarModel;
use App\Models\Rm0SbarDataModel;
use App\Models\DpjpModel;

use function PHPSTORM_META\type;

class Cppt extends BaseController
{
    protected $regPeriksaModel;
    protected $petugasModel;
    protected $cpptVerifModel;
    protected $cpptPenerimaModel;
    protected $dpjpModel;


    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->cpptVerifModel = new CpptVerifModel();
        $this->cpptPenerimaModel = new CpptPenerimaModel();
        $this->petugasModel = new PetugasModel();
        $this->dpjpModel = new DpjpModel();
    }

    public function index($noRawat)
    {
        $petugas = $this->petugasModel->where('nip !=', '-')->findAll();
        $noRawat = str_replace('-', '/', $noRawat);
        $dpjp = $this->dpjpModel->where('noRawat', $noRawat)->first();
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

        $data = (object) [
            'petugas'     => $petugas,
            'pasien'     => $pasien,
            'dpjp'     => $dpjp,
            'cppt' => $this->getDataCppt($noRawat)
        ];

        return view('jenis/cppt', ['data' => $data]);
    }


    // =================   FUNGSI HELPERR   =============================================================
    // =================   FUNGSI HELPERR   =============================================================
    // =================   FUNGSI HELPERR   =============================================================

    public function verifCppt()
    {
        $data = [
            // Data Pasien & Petugas
            "noRawat"           => $this->request->getPost("noRawat"),
            "tanggal"              => $this->request->getPost("tanggal"),
            "jam"                => $this->request->getPost("jam"),
        ];

        $this->cpptVerifModel->save($data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function serahTerima()
    {
        $data = [
            // Data Pasien, Waktu & Penerima
            "noRawat"  => $this->request->getPost("noRawat"),
            "tanggal"  => $this->request->getPost("tanggal"),
            "jam"      => $this->request->getPost("jam"),
            "penerima" => $this->request->getPost("penerima"),
        ];

        // Simpan data menggunakan model cpptPenerimaModel
        if ($this->cpptPenerimaModel->save($data)) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Data serah terima berhasil disimpan'
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Gagal menyimpan data serah terima'
        ]);
    }

    public function hapusSerahTerima()
    {
        $noRawat = $this->request->getPost('noRawat');
        $tanggal = $this->request->getPost('tanggal');
        $jam     = $this->request->getPost('jam');

        $deleted = $this->cpptPenerimaModel
            ->where('noRawat', $noRawat)
            ->where('tanggal', $tanggal)
            ->where('jam', $jam)
            ->delete();

        if ($deleted) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Data serah terima berhasil dihapus'
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Gagal menghapus data'
        ]);
    }

    public function cetakCppt($noRawat)
    {
        $noRawat = str_replace('-', '/', $noRawat);
        $dpjp = $this->dpjpModel->where('noRawat', $noRawat)->first();
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

        $data = (object) [
            'pasien'     => $pasien,
            'dpjp'     => $dpjp,
            'cppt' => $this->getDataCppt($noRawat)
        ];

        // dd($this->getDataCppt($noRawat));

        return view('cetak/cppt', ['data' => $data]);
    }

    private function getDataCppt($noRawat)
    {
        // 1. Format no_rawat
        $no_rawat = str_replace('-', '/', urldecode($noRawat));

        // 2. Inisialisasi Model
        $regPeriksaModel       = new RegPeriksaModel();
        $pemeriksaanRalanModel = new PemeriksaanRalanModel();
        $pemeriksaanRanapModel = new PemeriksaanRanapModel();
        $sbarModel             = new Rm0SbarModel();
        $sbarDataModel             = new Rm0SbarDataModel();

        // 3. RegPeriksa (firstOrFail)
        $registration = $regPeriksaModel->where('no_rawat', $no_rawat)->first();

        // 4. Query data dari masing-masing model
        $ralanData = $pemeriksaanRalanModel->getByNoRawat($no_rawat);
        $ranapData = $pemeriksaanRanapModel->getByNoRawat($no_rawat);

        $ralanData = $this->masukkanWaktuVerif($ralanData);
        $ranapData = $this->masukkanWaktuVerif($ranapData);

        $ralanData = $this->masukkanPenerima($ralanData);
        $ranapData = $this->masukkanPenerima($ranapData);

        // Mengambil nama tabel dari properti $table milik $sbarModel dan $sbarDataModel
        $sbarData = $sbarDataModel
            ->select("
        {$sbarModel->table}.*, 
        {$sbarDataModel->table}.*")
            ->join($sbarModel->table, "{$sbarModel->table}.id = {$sbarDataModel->table}.idSbar", 'left')
            ->where("{$sbarModel->table}.noRawat", $no_rawat)
            ->findAll();

        // 5. Mapping Ralan
        $ralanMapped = array_map(function ($item) {
            $item['sumber']        = (isset($item['kd_poli']) && $item['kd_poli'] === 'IGDK') ? 'IGD' : ($item['nm_poli'] ?? 'Ralan');
            $item['jenis_hasil']   = 'SOAP';
            $item['tanggal_hasil'] = $item['tgl_perawatan'];
            $item['jam_hasil']     = $item['jam_rawat'];
            $this->mapPelaksana($item);

            return $item;
        }, $ralanData);

        // 6. Mapping Ranap
        $ranapMapped = array_map(function ($item) {
            $item['sumber']        = 'Ranap';
            $item['jenis_hasil']   = 'SOAP';
            $item['tanggal_hasil'] = $item['tgl_perawatan'];
            $item['jam_hasil']     = $item['jam_rawat'];
            $this->mapPelaksana($item);

            return $item;
        }, $ranapData);

        // 7. Mapping SBAR
        $sbarMapped = array_map(function ($item) use ($registration) {
            $item['sumber']            = $item['judul']; //$this->registrationSource($registration);
            $item['jenis_hasil']       = 'SBAR';
            $item['tanggal_hasil'] = date('Y-m-d', strtotime($item['waktu']));
            $item['jam_hasil']     = date('H:i:s', strtotime($item['waktu']));
            $item['nama_pelaksana']    = $item['petugas_id'] ?? $item['nip'] ?? null;
            $item['jenis_pelaksana']   = 'Petugas';
            $item['jabatan_pelaksana'] = null;

            return $item;
        }, $sbarData);

        // 8. Concat (Merge Array)
        $combinedData = array_merge($ralanMapped, $ranapMapped, $sbarMapped);

        usort($combinedData, function ($a, $b) {
            return [$a['tanggal_hasil'], $a['jam_hasil']] <=> [$b['tanggal_hasil'], $b['jam_hasil']];
        });

        return $combinedData;
    }

    private function masukkanWaktuVerif(array $cpptData): array
    {
        if (empty($cpptData)) {
            return [];
        }

        foreach ($cpptData as &$item) {
            $verif = $this->cpptVerifModel
                ->select('waktuVerif')
                ->where('noRawat', $item['no_rawat'])
                ->where('tanggal', $item['tgl_perawatan'])
                ->where('jam', $item['jam_rawat'])
                ->first();

            // Menyisipkan nilai waktuVerif jika ada, jika belum diverifikasi di-set NULL
            $item['waktuVerif'] = $verif['waktuVerif'] ?? null;
        }

        return $cpptData;
    }

    private function masukkanPenerima(array $cpptData): array
    {
        if (empty($cpptData)) {
            return [];
        }

        foreach ($cpptData as &$item) {
            $penerimaData = $this->cpptPenerimaModel
                ->select('penerima')
                ->where('noRawat', $item['no_rawat'])
                ->where('tanggal', $item['tgl_perawatan'])
                ->where('jam', $item['jam_rawat'])
                ->first();

            // Menyisipkan nilai penerima jika ada, jika belum di-set NULL
            $item['penerima'] = $penerimaData['penerima'] ?? null;
        }

        return $cpptData;
    }

    private function registrationSource($registration): string
    {
        // Cek jika $registration berupa array atau object
        $statusLanjut = is_array($registration) ? ($registration['status_lanjut'] ?? null) : ($registration->status_lanjut ?? null);
        $noKam        = is_array($registration) ? ($registration['no_kam'] ?? null) : ($registration->no_kam ?? null);
        $kdPoli       = is_array($registration) ? ($registration['kd_poli'] ?? null) : ($registration->kd_poli ?? null);
        $nmPoli       = is_array($registration) ? ($registration['nm_poli'] ?? null) : ($registration->nm_poli ?? null);

        if ($statusLanjut === 'Ranap' || !empty($noKam)) {
            return 'Ranap';
        }

        if ($kdPoli === 'IGDK') {
            return 'IGD';
        }

        return $nmPoli ?? 'Ralan';
    }

    private function mapPelaksana(&$item): void
    {
        if (!empty($item['nm_dokter'])) {
            $item['nama_pelaksana']    = $item['nm_dokter'];
            $item['jenis_pelaksana']   = 'Dokter';
            $item['jabatan_pelaksana'] = null;
            return;
        }

        if (!empty($item['nama_petugas']) || !empty($item['nama'])) {
            $item['nama_pelaksana']    = $item['nama_petugas'] ?? $item['nama'];
            $item['jenis_pelaksana']   = $item['nm_jbtn'] ?? 'Petugas';
            $item['jabatan_pelaksana'] = null;
            return;
        }

        $item['nama_pelaksana']    = $item['nip'] ?? null;
        $item['jenis_pelaksana']   = null;
        $item['jabatan_pelaksana'] = null;
    }
}
