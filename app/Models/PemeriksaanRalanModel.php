<?php

namespace App\Models;

use CodeIgniter\Model;

class PemeriksaanRalanModel extends Model
{
    protected $DBGroup       = 'sik';
    protected $table         = 'pemeriksaan_ralan';
    protected $primaryKey    = 'no_rawat';

    public function getByNoRawat(string $no_rawat): array
    {
        return $this->select('
                pemeriksaan_ralan.*,
                dokter.nm_dokter,
                petugas.nama as nama_petugas,
                jabatan.nm_jbtn,
                poliklinik.nm_poli,
                reg_periksa.kd_poli
            ')
            ->join('reg_periksa', 'reg_periksa.no_rawat = pemeriksaan_ralan.no_rawat', 'left')
            ->join('poliklinik', 'poliklinik.kd_poli = reg_periksa.kd_poli', 'left')
            ->join('dokter', 'dokter.kd_dokter = pemeriksaan_ralan.nip', 'left')
            ->join('petugas', 'petugas.nip = pemeriksaan_ralan.nip', 'left')
            ->join('jabatan', 'jabatan.kd_jbtn = petugas.kd_jbtn', 'left')
            ->where('pemeriksaan_ralan.no_rawat', $no_rawat)
            ->findAll();
    }
}
