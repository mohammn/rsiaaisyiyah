<?php

namespace App\Controllers;

use App\Models\RegPeriksaModel;
use App\Models\SkorModel;
use App\Models\PersetujuanRajalModel;
use App\Models\DpjpModel;
use App\Models\RekonsiliasiObatModel;
use App\Models\RekonsiliasiObatDataModel;
use App\Models\IcGeneralModel;
use App\Models\IcDarahModel;
use App\Models\IcSesarModel;
use App\Models\IcPembiusanModel;

use function PHPSTORM_META\type;

class Rm extends BaseController
{
    protected $regPeriksaModel;
    protected $skorModel;
    protected $persRajalModel;
    protected $dpjpModel;
    protected $rekonsiliasiObatModel;
    protected $rekonsiliasiObatDataModel;
    protected $icGeneralModel;
    protected $icDarahModel;
    protected $icSesarModel;
    protected $icPembiusanModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->skorModel = new SkorModel();
        $this->persRajalModel = new PersetujuanRajalModel();
        $this->dpjpModel = new DpjpModel();
        $this->rekonsiliasiObatModel = new RekonsiliasiObatModel();
        $this->rekonsiliasiObatDataModel = new RekonsiliasiObatDataModel();
        $this->icGeneralModel = new IcGeneralModel();
        $this->icDarahModel = new IcDarahModel();
        $this->icSesarModel = new IcSesarModel();
        $this->icPembiusanModel = new IcPembiusanModel();
    }
    public function index($no_rawat)
    {
        $no_rawat = str_replace('-', '/', $no_rawat);
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
            ->where('reg_periksa.no_rawat', $no_rawat)
            ->first();

        // pengiriman dataa===============
        $skorPoudji = $this->skorModel->where('noRm', $pasien['no_rkm_medis'])->findAll();
        $persRajal = $this->persRajalModel->where('noRm', $pasien['no_rkm_medis'])->first();
        $dpjp = $this->dpjpModel->where('noRawat', $no_rawat)->first();
        $rekonsiliasiObat = $this->rekonsiliasiObatModel->where('noRawat', $no_rawat)->first();
        $rekonsiliasiObatData = $this->rekonsiliasiObatDataModel->where('noRawat', $no_rawat)->first();
        $icGeneral = $this->icGeneralModel->where('noRawat', $no_rawat)->findAll();
        $icDarah = $this->icDarahModel->where('noRawat', $no_rawat)->first();
        $icSesar = $this->icSesarModel->where('noRawat', $no_rawat)->first();
        $icPembiusan = $this->icPembiusanModel->where('noRawat', $no_rawat)->first();


        //===========status data=====================
        $statusSKorPoudji = [];
        for ($i = 0; $i < count($skorPoudji); $i++) {
            $statusSKorPoudji[$i] = $this->cekSemuaKolom($skorPoudji[$i]);
        }
        $statusIcGeneral = [];
        for ($i = 0; $i < count($icGeneral); $i++) {
            $statusIcGeneral[$i] = $this->cekSemuaKolom($icGeneral[$i], ['ttdWali', 'ttdSaksi']);
        }

        $pengecualianIcPembiusan = ['isiKombinasi', 'tataCara', 'tujuan', 'komplikasi', 'risiko', 'alternatif', 'ttdWali', 'ttdSaksi'];
        if ($icPembiusan) {
            if ($icPembiusan['jenisAnestesi'] === "Blok Syaraf Perifer" or $icPembiusan['jenisAnestesi'] === "Anestesi Umum") {
                unset($pengecualianIcPembiusan['alternatif']);
            } elseif ($icPembiusan['jenisAnestesi'] === "kombinasi") {
                $pengecualianIcPembiusan = ['ttdWali', 'ttdSaksi'];
            }
        }

        $status = [
            "skorPoudji" => $statusSKorPoudji,
            "persRajal" => $this->cekSemuaKolom($persRajal, ['selesai', 'ttdWali', 'ttdSaksi']),
            "dpjp" => $this->cekSemuaKolom($dpjp, ['ttdWali']),
            "rekonsiliasiObat" => $this->statusRekonsiliasiObat($rekonsiliasiObat, $rekonsiliasiObatData),
            "icGeneral" => $statusIcGeneral,
            "icDarah" => $this->cekSemuaKolom($icDarah, ['ttdWali', 'ttdSaksi']),
            "icSesar" => $this->cekSemuaKolom($icSesar, ['ttdWali', 'ttdSaksi', 'indikasiIbu', 'indikasiJanin']),
            "icPembiusan" => $this->cekSemuaKolom($icPembiusan, $pengecualianIcPembiusan),
        ];

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'skorPoudji' => $skorPoudji,  // Biarkan null jika data tidak ada
            'persRajal'  => $persRajal,    // Biarkan null jika data tidak ada
            'dpjp'  => $dpjp,    // Biarkan null jika data tidak ada
            'rekonsiliasiObat'  => $rekonsiliasiObat,    // Biarkan null jika data tidak ada
            'icGeneral'  => $icGeneral,    // Biarkan null jika data tidak ada
            'icDarah'  => $icDarah,    // Biarkan null jika data tidak ada
            'icSesar'  => $icSesar,    // Biarkan null jika data tidak ada
            'icPembiusan'  => $icPembiusan,    // Biarkan null jika data tidak ada
            'status'  => $status    // Biarkan null jika data tidak ada
        ];

        return view('rm/index', ['data' => $data]);
    }

    public function statusRekonsiliasiObat($dataRekonsiliasiObat, $dataObat)
    {
        if ($dataObat) {
            $listRuangan = array_column($dataObat, 'ruangan');
        } else {
            $listRuangan = [];
        }

        $ada["igd"]  = true;
        $ada["ko"]  = in_array('ko', $listRuangan);
        $ada["rr"]  = in_array('rr', $listRuangan);
        $ada["ri"]  = in_array('ri', $listRuangan);

        $ruangan = ['Igd', 'Ko', 'Rr', 'Ri'];
        $data = [];
        $hasilCek = [];

        foreach ($ruangan as $r) {
            $keyLower = strtolower($r);

            $data[$keyLower] = [
                "perawat{$r}"      => $dataRekonsiliasiObat["perawat{$r}"] ?? null,
                "dokter{$r}"       => $dataRekonsiliasiObat["dokter{$r}"] ?? null,
                "farmasi{$r}"      => $dataRekonsiliasiObat["farmasi{$r}"] ?? null,
                "waktuPerawat{$r}" => $dataRekonsiliasiObat["waktuPerawat{$r}"] ?? null,
                "waktuDokter{$r}"  => $dataRekonsiliasiObat["waktuDokter{$r}"] ?? null,
                "waktuFarmasi{$r}" => $dataRekonsiliasiObat["waktuFarmasi{$r}"] ?? null,
            ];

            $hasilCek[$keyLower] = $this->cekSemuaKolom($data[$keyLower]);
        }

        // dd($hasilCek);

        foreach ($ruangan as $r) {
            $keyLower = strtolower($r);

            if ($hasilCek[$keyLower] === 'Tidak Lengkap') {
                return 'Tidak Lengkap';
            }

            if ($keyLower != 'igd' && $ada[$keyLower] && $hasilCek[$keyLower] != 'Lengkap') {
                return 'Tidak Lengkap';
            }
        }
        return "Lengkap";
    }
}
