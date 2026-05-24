<?php

namespace App\Controllers\Rm;

use App\Controllers\BaseController;

use App\Models\SkorModel;
use App\Models\RegPeriksaModel;
use App\Models\PasienModel;

class SkorPoudji extends BaseController
{
    protected $regPeriksaModel;
    protected $skorModel;
    protected $pasienModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->skorModel = new SkorModel();
        $this->regPeriksaModel = new RegPeriksaModel();
        $this->pasienModel = new PasienModel();
    }

    public function index($noRawat, $id = null)
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

        $skorPoudji = $this->skorModel->where('id', $id)->first();

        // Tambahkan (object) di depan variabel agar array berubah jadi object
        $data = (object) [
            'pasien'     => $pasien,      // Jangan pakai (object) di sini
            'skorPoudji' => $skorPoudji
        ];

        return view('rm/skorPoudji', ['data' => $data]);
    }

    public function muatSkor($id)
    {
        $dataSkor = $this->skorModel->where('id', $id)->findAll();

        echo json_encode($dataSkor);
    }

    public function tambahSkor()
    {
        $noRm = $this->request->getPost("noRm");
        $data = [
            "noRm" => $noRm,
            "i" => $this->request->getPost("i"),
            "ii" => $this->request->getPost("ii"),
            "iii" => $this->request->getPost("iii"),
            "iiii" => $this->request->getPost("iiii"),
        ];

        $this->skorModel->save($data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data berhasil disimpan',
            'id'      => $this->skorModel->getInsertID()
        ]);
    }

    public function ubahSkor()
    {
        $id = $this->request->getPost("id");

        $data = [
            "i" => $this->request->getPost("i"),
            "ii" => $this->request->getPost("ii"),
            "iii" => $this->request->getPost("iii"),
            "iiii" => $this->request->getPost("iiii")
        ];


        $skorPoudji = $this->skorModel->where('id', $id)->first();

        $this->catatLog('Ubah', 'skorpoudji', $skorPoudji['noRm'], $skorPoudji, $data);

        $this->skorModel->where('id', $id);
        $this->skorModel->update(null, $data);
        echo json_encode('');
    }

    public function hapus()
    {
        $id = $this->request->getPost("id");
        $skorPoudji = $this->skorModel->where('id', $id)->first();

        $this->catatLog('Hapus', 'skorpoudji', $skorPoudji['noRm'], $skorPoudji);

        $this->skorModel->where("id", $id)->delete();
        echo json_encode("");
    }

    public function printSkor($id)
    {
        $skorPoudji = $this->skorModel->where('id', $id)->first();

        $pasien = $this->pasienModel->where('no_rkm_medis', $skorPoudji["noRm"])->first();
        $data = (object) [
            'pasien'     => $pasien,
            'skorPoudji'     => $skorPoudji
        ];
        // dd($data);

        return view("cetak/skorPoudji", ['data' => $data]);
    }
}
