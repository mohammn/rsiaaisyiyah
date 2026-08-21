<?php

namespace App\Models;

use CodeIgniter\Model;

class ResepPulangModel extends Model
{
    protected $DBGroup    = 'sik';
    protected $table      = 'resep_pulang';
    protected $primaryKey = 'no_rawat';
    protected $allowedFields = [];

    /**
     * Mengambil data resep_pulang + nama_brng dari databarang
     */
    public function getResepByNoRawat($noRawat)
    {
        return $this->select('resep_pulang.*, databarang.nama_brng')
            ->join('databarang', 'databarang.kode_brng = resep_pulang.kode_brng', 'left')
            ->where('resep_pulang.no_rawat', $noRawat)
            ->findAll();
    }
}
