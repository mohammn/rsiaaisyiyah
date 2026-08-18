<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\Rm11a2TimbangModel;
use App\Models\RegPeriksaModel;
use App\Models\SysLogModel;
use App\Models\PengaturanModel;
use App\Models\PjPasienModel;
use App\Models\DokterModel;
use App\Models\PetugasModel;

class Rm11a2Timbang extends BaseController
{
    protected $regPeriksaModel;
    protected $rm11a2TimbangModel;
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
        $this->rm11a2TimbangModel = new Rm11a2TimbangModel();
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

        $rm11a2Timbang = $this->rm11a2TimbangModel->where('noRawat', $noRawat)->first();

        $pengaturan = $this->pengaturan->where('id', 1)->first();
        $pjPasien = $this->pjPasienModel->where('noRm', $pasien["no_rkm_medis"])->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'dokter'     => $dokter,      // Jangan pakai (object) di sini
            'petugas'     => $petugas,      // Jangan pakai (object) di sini
            'rm11a2Timbang' => $rm11a2Timbang,
            'pjPasien' => $pjPasien,
            'pengaturan' => $pengaturan
        ];

        return view('rm/rm11a2Timbang', ['data' => $data]);
    }

    public function simpan()
    {
        $tglTranfusi  = $this->request->getPost("tglTranfusi");
        $tglTranfusi2 = $this->request->getPost("tglTranfusi2");

        $data = [
            // --- HEADER / SBAR & SITUASI ---
            "noRawat"           => $this->request->getPost("noRawat"),
            "dpjp"              => $this->request->getPost("dpjp"),
            "unitLain"          => $this->request->getPost("unitLain"),
            "diagnosaMedis"     => $this->request->getPost("diagnosaMedis"),
            "situasi"           => json_encode($this->request->getPost("situasi") ?? []),
            "isiKelas"          => $this->request->getPost("isiKelas"),

            // --- KOLOM KIRI (PENYERAHAN DARI RUANGAN) ---
            "diagnosaPra"       => $this->request->getPost("diagnosaPra"),
            "rencanaOperasi"    => $this->request->getPost("rencanaOperasi"),
            "rpd"               => json_encode($this->request->getPost("rpd") ?? []),
            "isiRpdLainnya"     => $this->request->getPost("isiRpdLainnya"),
            "isolasi"           => json_encode($this->request->getPost("isolasi") ?? []),
            "isiIsolasiLainnya" => $this->request->getPost("isiIsolasiLainnya"),
            "alergi"            => $this->request->getPost("alergi"),
            "isiAlergi"         => $this->request->getPost("isiAlergi"),
            "darahStatus"       => $this->request->getPost("darahStatus"),
            "jumlahDarah"       => $this->request->getPost("jumlahDarah"),
            "darahDetail"       => json_encode($this->request->getPost("darahDetail") ?? []),
            "isiPackJenis"      => $this->request->getPost("isiPackJenis"),
            "isiGolonganDarah"  => $this->request->getPost("isiGolonganDarah"),
            "markingStatus"     => $this->request->getPost("markingStatus"),
            "markingKondisi"    => $this->request->getPost("markingKondisi"),
            "informedConsent"   => $this->request->getPost("informedConsent"),
            "labStatus"         => $this->request->getPost("labStatus"),
            "isiLabJml"         => $this->request->getPost("isiLabJml"),
            "perhatianKhusus"   => json_encode($this->request->getPost("perhatianKhusus") ?? []),
            "isiHb"             => $this->request->getPost("isiHb"),
            "isiBun"            => $this->request->getPost("isiBun"),
            "isiPkLainLain"     => $this->request->getPost("isiPkLainLain"),
            "isiAlbumin"        => $this->request->getPost("isiAlbumin"),
            "isiKreatinin"      => $this->request->getPost("isiKreatinin"),
            "fotoStatus"        => $this->request->getPost("fotoStatus"),
            "isiFotoJml"        => $this->request->getPost("isiFotoJml"),
            "fotoDetail"        => json_encode($this->request->getPost("fotoDetail") ?? []),
            "isiRontgenKet"     => $this->request->getPost("isiRontgenKet"),
            "isiRontgenJml"     => $this->request->getPost("isiRontgenJml"),
            "isiUsgKet"         => $this->request->getPost("isiUsgKet"),
            "isiUsgJml"         => $this->request->getPost("isiUsgJml"),
            "isiBofJml"         => $this->request->getPost("isiBofJml"),
            "isiNst"            => $this->request->getPost("isiNst"),
            "isiEchoJml"        => $this->request->getPost("isiEchoJml"),
            "isiIvpJml"         => $this->request->getPost("isiIvpJml"),
            "isiEkgJml"         => $this->request->getPost("isiEkgJml"),
            "isiFotoLainnya"    => $this->request->getPost("isiFotoLainnya"),
            "isiTdSistole"      => $this->request->getPost("isiTdSistole"),
            "isiTdDiastole"     => $this->request->getPost("isiTdDiastole"),
            "isiSuhu"           => $this->request->getPost("isiSuhu"),
            "isiRr"             => $this->request->getPost("isiRr"),
            "isiNadi"           => $this->request->getPost("isiNadi"),
            "puasaStatus"       => $this->request->getPost("puasaStatus"),
            "isiPuasaJam"       => $this->request->getPost("isiPuasaJam"),
            "lavementStatus"    => $this->request->getPost("lavementStatus"),
            "isiLavementKet"    => $this->request->getPost("isiLavementKet"),
            "tamponAnus"        => $this->request->getPost("tamponAnus"),
            "scerenStatus"      => $this->request->getPost("scerenStatus"),
            "gigiPalsu"         => $this->request->getPost("gigiPalsu"),
            "isiGigiDibawaOleh" => $this->request->getPost("isiGigiDibawaOleh"),
            "kesadaran"         => $this->request->getPost("kesadaran"),
            "isiKesadaranLain"  => $this->request->getPost("isiKesadaranLain"),
            "keluargaTunggu"    => $this->request->getPost("keluargaTunggu"),
            "isiKontakPerson"   => $this->request->getPost("isiKontakPerson"),
            "isiTelpHubungi"    => $this->request->getPost("isiTelpHubungi"),

            // --- ASSESSMENT, RECOMMENDATION & PETUGAS (SISI KIRI) ---
            "assesment"         => $this->request->getPost("assesment"),
            "didampingi"        => json_encode($this->request->getPost("didampingi") ?? []),
            "alatTransport"     => $this->request->getPost("alatTransport"),
            "medikasi"     => $this->request->getPost("medikasi"),
            "waktu"             => !empty($this->request->getPost("waktu")) ? $this->request->getPost("waktu") : null,
            "pengantar"         => $this->request->getPost("pengantar"),
            "penerima"          => $this->request->getPost("penerima"),

            // --- RIWAYAT TRANSFUSI 1 ---
            "riwayatTranfusi"  => $this->request->getPost("riwayatTranfusi"),
            "tglTranfusi"      => !empty($tglTranfusi) ? $tglTranfusi : null,
            "jenisTranfusi"    => $this->request->getPost("jenisTranfusi"),
            "golTranfusi"      => $this->request->getPost("golTranfusi"),
            "jumlahTranfusi"   => $this->request->getPost("jumlahTranfusi"),

            // --- RIWAYAT TRANSFUSI 2 ---
            "riwayatTranfusi2" => $this->request->getPost("riwayatTranfusi2"),
            "tglTranfusi2"     => !empty($tglTranfusi2) ? $tglTranfusi2 : null,
            "jenisTranfusi2"   => $this->request->getPost("jenisTranfusi2"),
            "golTranfusi2"     => $this->request->getPost("golTranfusi2"),
            "jumlahTranfusi2"  => $this->request->getPost("jumlahTranfusi2"),

            // --- KOLOM KANAN (PENERIMAAN DI OK) ---
            "diagnosaPra2"       => $this->request->getPost("diagnosaPra2"),
            "rencanaOperasi2"    => $this->request->getPost("rencanaOperasi2"),
            "rpd2"               => json_encode($this->request->getPost("rpd2") ?? []),
            "isiRpdLainnya2"     => $this->request->getPost("isiRpdLainnya2"),
            "isolasi2"           => json_encode($this->request->getPost("isolasi2") ?? []),
            "isiIsolasiLainnya2" => $this->request->getPost("isiIsolasiLainnya2"),
            "alergi2"            => $this->request->getPost("alergi2"),
            "isiAlergi2"         => $this->request->getPost("isiAlergi2"),
            "darahStatus2"       => $this->request->getPost("darahStatus2"),
            "jumlahDarah2"       => $this->request->getPost("jumlahDarah2"),
            "darahDetail2"       => json_encode($this->request->getPost("darahDetail2") ?? []),
            "isiPackJenis2"      => $this->request->getPost("isiPackJenis2"),
            "isiGolonganDarah2"  => $this->request->getPost("isiGolonganDarah2"),
            "markingStatus2"     => $this->request->getPost("markingStatus2"),
            "markingKondisi2"    => $this->request->getPost("markingKondisi2"),
            "informedConsent2"   => $this->request->getPost("informedConsent2"),
            "labStatus2"         => $this->request->getPost("labStatus2"),
            "isiLabJml2"         => $this->request->getPost("isiLabJml2"),
            "perhatianKhusus2"   => json_encode($this->request->getPost("perhatianKhusus2") ?? []),
            "isiHb2"             => $this->request->getPost("isiHb2"),
            "isiBun2"            => $this->request->getPost("isiBun2"),
            "isiPkLainLain2"     => $this->request->getPost("isiPkLainLain2"),
            "isiAlbumin2"        => $this->request->getPost("isiAlbumin2"),
            "isiKreatinin2"      => $this->request->getPost("isiKreatinin2"),
            "fotoStatus2"        => $this->request->getPost("fotoStatus2"),
            "isiFotoJml2"        => $this->request->getPost("isiFotoJml2"),
            "fotoDetail2"        => json_encode($this->request->getPost("fotoDetail2") ?? []),
            "isiRontgenKet2"     => $this->request->getPost("isiRontgenKet2"),
            "isiRontgenJml2"     => $this->request->getPost("isiRontgenJml2"),
            "isiUsgKet2"         => $this->request->getPost("isiUsgKet2"),
            "isiUsgJml2"         => $this->request->getPost("isiUsgJml2"),
            "isiBofJml2"         => $this->request->getPost("isiBofJml2"),
            "isiNst2"            => $this->request->getPost("isiNst2"),
            "isiEchoJml2"        => $this->request->getPost("isiEchoJml2"),
            "isiIvpJml2"         => $this->request->getPost("isiIvpJml2"),
            "isiEkgJml2"         => $this->request->getPost("isiEkgJml2"),
            "isiFotoLainnya2"    => $this->request->getPost("isiFotoLainnya2"),
            "isiTdSistole2"      => $this->request->getPost("isiTdSistole2"),
            "isiTdDiastole2"     => $this->request->getPost("isiTdDiastole2"),
            "isiSuhu2"           => $this->request->getPost("isiSuhu2"),
            "isiRr2"             => $this->request->getPost("isiRr2"),
            "isiNadi2"           => $this->request->getPost("isiNadi2"),
            "puasaStatus2"       => $this->request->getPost("puasaStatus2"),
            "isiPuasaJam2"       => $this->request->getPost("isiPuasaJam2"),
            "lavementStatus2"    => $this->request->getPost("lavementStatus2"),
            "isiLavementKet2"    => $this->request->getPost("isiLavementKet2"),
            "tamponAnus2"        => $this->request->getPost("tamponAnus2"),
            "scerenStatus2"      => $this->request->getPost("scerenStatus2"),
            "gigiPalsu2"         => $this->request->getPost("gigiPalsu2"),
            "isiGigiDibawaOleh2" => $this->request->getPost("isiGigiDibawaOleh2"),
            "kesadaran2"         => $this->request->getPost("kesadaran2"),
            "isiKesadaranLain2"  => $this->request->getPost("isiKesadaranLain2"),
            "keluargaTunggu2"    => $this->request->getPost("keluargaTunggu2"),
            "isiKontakPerson2"   => $this->request->getPost("isiKontakPerson2"),
            "isiTelpHubungi2"    => $this->request->getPost("isiTelpHubungi2"),

            // --- ASSESSMENT, RECOMMENDATION & PETUGAS (SISI KANAN / SUFFIX 2) ---
            "assesment2"        => $this->request->getPost("assesment2"),
            "didampingi2"       => json_encode($this->request->getPost("didampingi2") ?? []),
            "alatTransport2"    => $this->request->getPost("alatTransport2"),
            "medikasi2"    => $this->request->getPost("medikasi2"),
            "waktu2"            => !empty($this->request->getPost("waktu2")) ? $this->request->getPost("waktu2") : null,
            "pengantar2"        => $this->request->getPost("pengantar2"),
            "penerima2"         => $this->request->getPost("penerima2"),
        ];

        if ($this->request->getPost("tujuanSimpan") == 'tambah') {
            $this->rm11a2TimbangModel->save($data);
            $this->catatLog('tambah', 'rm11a2_timbang', $this->request->getPost("noRawat"), $this->rm11a2TimbangModel->where('noRawat', $this->request->getPost("noRawat"))->first());
        } else {
            $noRawat = $this->request->getPost("noRawat");
            unset($data['noRawat']);

            $this->catatLog('ubah', 'rm11a2_timbang', $noRawat, $this->rm11a2TimbangModel->where('noRawat', $noRawat)->first(), $data);

            $this->rm11a2TimbangModel->where('noRawat', $noRawat)->set($data)->update();
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

        $this->rm11a2TimbangModel->where('noRawat', $noRawat)->set($data)->update();
        echo json_encode('');
    }

    public function hapus()
    {
        $noRawat = $this->request->getPost("noRawat");
        $noRawat = str_replace('-', '/', $noRawat);
        $this->catatLog('hapus', 'rm11b1_checklist', $noRawat, $this->rm11a2TimbangModel->where('noRawat', $noRawat)->first());

        $this->rm11a2TimbangModel->where("noRawat", $noRawat)->delete();
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

        $rm11a2Timbang = $this->rm11a2TimbangModel->where('noRawat', $noRawat)->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'rm11a2Timbang' => $rm11a2Timbang
        ];
        echo view("cetak/rm11a2Timbang", ["data" => $data]);

        // Load the view file and get its HTML content

    }

    public function simpanTtd()
    {
        // Ambil input noRawat dari form
        $noRawatRaw = $this->request->getPost("noRawat");
        $noRawatFile = str_replace('/', '-', $noRawatRaw); // Untuk penamaan file
        $noRawatDb   = str_replace('-', '/', $noRawatRaw); // Untuk query Database

        $lokasiFolder = 'rm11a2Timbang';

        // Daftar 7 field TTD beserta suffix nama filenya
        $listTtd = [
            'ttdPengantar' => '_pengantar',
            'ttdPenerima' => '_penerima',
            'ttdPengantar2' => '_pengantar2',
            'ttdPenerima2' => '_penerima2'
        ];

        // Ambil data eksisting dari Database
        $cekTtd = $this->rm11a2TimbangModel->where('noRawat', $noRawatDb)->first();

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
            $this->rm11a2TimbangModel->where('noRawat', $noRawatDb)->set($dataToUpdate)->update();
        }

        return $this->response->setJSON([
            'status' => 'success'
        ]);
    }
}
