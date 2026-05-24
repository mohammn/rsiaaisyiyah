<?php

namespace App\Controllers;

use App\Models\RegPeriksaModel;

class Ranap extends BaseController
{
    protected $regPeriksaModel;

    public function __construct()
    {
        if (!session()->get('nama')) {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->regPeriksaModel = new RegPeriksaModel();
    }
    public function index()
    {

        echo view('ranap');
    }

    public function muatData()
    {
        // 1. Ambil input dari request
        $tglMulai = $this->request->getPost("tglMulai");
        $tglAkhir = $this->request->getPost("tglAkhir");
        $status   = $this->request->getPost("status");

        // 2. Gunakan Query Builder melalui model
        $builder = $this->regPeriksaModel->builder();

        $builder->select('
        reg_periksa.no_rawat,
        reg_periksa.tgl_registrasi,
        reg_periksa.jam_reg,
        reg_periksa.kd_dokter,
        reg_periksa.no_rkm_medis,
        reg_periksa.kd_poli,
        reg_periksa.p_jawab,
        reg_periksa.hubunganpj,
        reg_periksa.umurdaftar,
        reg_periksa.sttsumur,
        reg_periksa.kd_pj,
        pasien.nm_pasien,
        pasien.alamat,
        dokter.nm_dokter,
        penjab.png_jawab,
        kamar_inap.stts_pulang,
        kamar_inap.kd_kamar,
        kamar_inap.tgl_masuk,
        kamar_inap.tgl_keluar,
        kamar_inap.jam_masuk,
        kamar_inap.jam_keluar,
        kamar_inap.lama,
        kamar_inap.kd_kamar,
        kamar_inap.tgl_keluar,
        bangsal.nm_bangsal
    ');

        // 3. Join manual untuk menggantikan 'with'
        $builder->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'left');
        $builder->join('dokter', 'reg_periksa.kd_dokter = dokter.kd_dokter', 'left');
        $builder->join('penjab', 'reg_periksa.kd_pj = penjab.kd_pj', 'left');
        $builder->join('kamar_inap', 'reg_periksa.no_rawat = kamar_inap.no_rawat', 'left');
        $builder->join('kamar', 'kamar_inap.kd_kamar = kamar.kd_kamar', 'left');
        $builder->join('bangsal', 'kamar.kd_bangsal = bangsal.kd_bangsal', 'left');

        // 4. Logika Filter Status (Pengganti whereHas)
        if ($status == 'belum') {
            // Hanya yang belum pulang
            $builder->where('kamar_inap.stts_pulang', '-');
        } elseif ($status == 'sudah') {
            // Hanya yang sudah pulang dalam rentang tanggal
            $builder->where('kamar_inap.stts_pulang !=', '-')
                ->where('kamar_inap.tgl_keluar >=', $tglMulai)
                ->where('kamar_inap.tgl_keluar <=', $tglAkhir);
        } else {
            // Tampil semua (Sudah & Belum Pulang)
            // Kita gunakan grouping WHERE agar logika tanggal hanya berlaku untuk yang sudah keluar, 
            // atau jika Anda ingin semua yang registrasi di tanggal tersebut muncul:
            $builder->groupStart()
                ->where('kamar_inap.tgl_keluar >=', $tglMulai)
                ->where('kamar_inap.tgl_keluar <=', $tglAkhir)
                ->orWhere('kamar_inap.stts_pulang', '-')
                ->groupEnd();
        }

        // 5. Eksekusi query
        $dataPasien = $builder->orderBy('reg_periksa.tgl_registrasi', 'DESC')
            ->get()
            ->getResultArray(); // Mengembalikan data dalam bentuk array

        // 6. Return response JSON khas CI4
        return $this->response->setJSON($dataPasien);
    }
}
