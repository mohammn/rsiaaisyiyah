<?php

namespace App\Models;

use CodeIgniter\Model;

class PemeriksaanRanapModel extends Model
{
    protected $DBGroup       = 'sik';
    protected $table         = 'pemeriksaan_ranap';
    protected $primaryKey    = 'no_rawat';

    public function getByNoRawat(string $no_rawat): array
    {
        return $this->select('
                pemeriksaan_ranap.*,
                dokter.nm_dokter,
                petugas.nama as nama_petugas,
                jabatan.nm_jbtn
            ')
            ->join('dokter', 'dokter.kd_dokter = pemeriksaan_ranap.nip', 'left')
            ->join('petugas', 'petugas.nip = pemeriksaan_ranap.nip', 'left')
            ->join('jabatan', 'jabatan.kd_jbtn = petugas.kd_jbtn', 'left')
            ->where('pemeriksaan_ranap.no_rawat', $no_rawat)
            ->findAll();
    }
}
