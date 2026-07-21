<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\TbIbuModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;

class TbIbu extends BaseController
{
    protected $regPeriksaModel;
    protected $tbIbuModel;
    protected $sysLog;
    protected $pengaturan;
    protected $pjPasienModel;
    protected $dokterModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->tbIbuModel = new TbIbuModel();
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->sysLog = new SysLogModel();
        $this->pengaturan = new PengaturanModel();
        $this->pjPasienModel = new PjPasienModel();
        $this->dokterModel = new DokterModel();
    }

    public function index($noRawat)
    {
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

        $tbIbu = $this->tbIbuModel->where('noRawat', $noRawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'tbIbu' => $tbIbu,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/tbIbu', ['data' => $data]);
    }

    public function simpan()
    {
        // Mengambil data input
        $tglBerobat = $this->request->getPost("tglBerobatTbc");
        $tglWbp     = $this->request->getPost("tglWbp");
        $tglSkrining = $this->request->getPost("tglSkrining");

        $data = [
            "noRawat"             => $this->request->getPost("noRawat"),
            "petugas"             => $this->request->getPost("petugas"),
            "beratBadan"          => $this->request->getPost("beratBadan"),
            "tinggiBadan"         => $this->request->getPost("tinggiBadan"),
            "imt"         => $this->request->getPost("imt"),
            "statusGizi"          => $this->request->getPost("statusGizi"),
            "kontakTbc"           => $this->request->getPost("kontakTbc"),
            "jenisKontak"         => $this->request->getPost("jenisKontak"),
            "isiJenisKontakLainnya"         => $this->request->getPost("isiJenisKontakLainnya"),
            "indeksTbc"           => $this->request->getPost("indeksTbc"),
            "jenisTbc"            => $this->request->getPost("jenisTbc"),
            "berobatTbc"          => $this->request->getPost("berobatTbc"),

            // Logika untuk mengubah tanggal kosong menjadi NULL
            "tglBerobatTbc"       => !empty($tglBerobat) ? $tglBerobat : null,

            "berobatTbcTakTuntas" => $this->request->getPost("berobatTbcTakTuntas"),
            "kurangGizi"          => $this->request->getPost("kurangGizi"),
            "merokok"             => $this->request->getPost("merokok"),
            "perokokPasif"        => $this->request->getPost("perokokPasif"),
            "kencingManis"        => $this->request->getPost("kencingManis"),
            "odhiv"               => $this->request->getPost("odhiv"),
            "lansia"              => $this->request->getPost("lansia"),
            "ibuhamil"            => $this->request->getPost("ibuhamil"),
            "wbp"                 => $this->request->getPost("wbp"),

            // Logika untuk mengubah tanggal kosong menjadi NULL
            "tglWbp"              => !empty($tglWbp) ? $tglWbp : null,

            "statusWbp"           => $this->request->getPost("statusWbp"),
            "kumuh"               => $this->request->getPost("kumuh"),

            // Logika untuk mengubah tanggal kosong menjadi NULL
            "tglSkrining"         => !empty($tglSkrining) ? $tglSkrining : null,

            "tempatSkrining"      => $this->request->getPost("tempatSkrining"),
            "batuk"               => $this->request->getPost("batuk"),
            "durasiBatuk"         => $this->request->getPost("durasiBatuk"),
            "demam"               => $this->request->getPost("demam"),
            "bb"                  => $this->request->getPost("bb"),
            "lesu"                => $this->request->getPost("lesu"),
            "getahBening"         => $this->request->getPost("getahBening"),
            "positif"             => $this->request->getPost("positif"),
            "radiografi"          => $this->request->getPost("radiografi"),
            "skorRadiologi"       => $this->request->getPost("skorRadiologi"),
            "kesanRadiologi"      => $this->request->getPost("kesanRadiologi"),
            "kesimpulan"          => $this->request->getPost("kesimpulan"),
            "terduga"             => $this->request->getPost("terduga"),
            "laten"               => $this->request->getPost("laten"),
            "fasyankes"           => $this->request->getPost("fasyankes")
        ];

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->tbIbuModel->save($data);
            $this->catatLog('tambah', 'tb_anak', $this->request->getPost("noRawat"), $this->tbIbuModel->where('noRawat', $this->request->getPost("noRawat"))->first());
        } else {
            $noRawat = $this->request->getPost("noRawat");
            unset($data['noRawat']);

            $this->catatLog('ubah', 'tb_anak', $noRawat, $this->tbIbuModel->where('noRawat', $noRawat)->first(), $data);

            $this->tbIbuModel->where('noRawat', $noRawat)->set($data)->update();
        }

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

        $this->tbIbuModel->where('noRawat', $noRawat)->set($data)->update();
        echo json_encode('');
    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $this->catatLog('hapus', 'ic_darah', $noRawat, $this->tbIbuModel->where('noRawat', $noRawat)->first());

        $this->tbIbuModel->where("noRawat", $noRawat)->delete();
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

        $tbIbu = $this->tbIbuModel->where('noRawat', $noRawat)->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'tbIbu' => $tbIbu
        ];
        echo view("cetak/tbIbu", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function simpanTtd()
    {
        // Ambil input noRawat dan data canvas dari form
        $noRawat    = $this->request->getPost("noRawat");
        $noRawat = str_replace('/', '-', $noRawat);
        $ttdWali    = $this->request->getPost("ttdWali");
        $ttdSaksi    = $this->request->getPost("ttdSaksi");

        $lokasiFolder = 'tbIbu';

        $data = [
            "ttdWali" => $this->uploadTtd($ttdWali, $noRawat . '_wali', $lokasiFolder),
            "ttdSaksi" => $this->uploadTtd($ttdSaksi, $noRawat . '_saksi', $lokasiFolder)
        ];

        $noRawat = str_replace('-', '/', $noRawat);
        $this->tbIbuModel->where('noRawat', $noRawat)->set($data)->update();

        return $this->response->setJSON([
            'status'  => 'success'
        ]);
    }
}
