<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $DBGroup = 'sik';
    protected $table      = 'pasien';
    protected $primaryKey = 'no_rkm_medis';
    protected $allowedFields = ['no_rkm_medis', 'no_ktp', 'nm_pasien', 'alamat', 'tgl_lahir', 'jk', 'no_tlp', 'namakeluarga', 'alamatpj', 'kelurahanpj', 'kecamatanpj', 'kabupatenpj'];

    public function getPasienWithAlamat($no_rkm_medis = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('pasien.*, kelurahan.nm_kel, kecamatan.nm_kec, kabupaten.nm_kab');
        $builder->join('kelurahan', 'kelurahan.kd_kel = pasien.kd_kel', 'left');
        $builder->join('kecamatan', 'kecamatan.kd_kec = pasien.kd_kec', 'left');
        $builder->join('kabupaten', 'kabupaten.kd_kab = pasien.kd_kab', 'left');

        if ($no_rkm_medis !== null) {
            return $builder->where('pasien.no_rkm_medis', $no_rkm_medis)->get()->getRowArray();
        }

        return $builder->get()->getResultArray();
    }
}
