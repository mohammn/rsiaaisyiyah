<?php

namespace App\Models;

use CodeIgniter\Model;

class CatatanAdimeGiziModel extends Model
{
    protected $DBGroup       = 'sik';
    protected $table         = 'catatan_adime_gizi';
    protected $primaryKey    = 'no_rawat';

    public function getByNoRawat(string $no_rawat): array
    {
        return $this->select('
                catatan_adime_gizi.*,
                petugas.nama as nama_petugas,
                jabatan.nm_jbtn,
                poliklinik.nm_poli,
                reg_periksa.kd_poli
            ')
            ->join('reg_periksa', 'reg_periksa.no_rawat = catatan_adime_gizi.no_rawat', 'left')
            ->join('poliklinik', 'poliklinik.kd_poli = reg_periksa.kd_poli', 'left')
            ->join('petugas', 'petugas.nip = catatan_adime_gizi.nip', 'left')
            ->join('jabatan', 'jabatan.kd_jbtn = petugas.kd_jbtn', 'left')
            ->where('catatan_adime_gizi.no_rawat', $no_rawat)
            ->findAll();
    }
}
