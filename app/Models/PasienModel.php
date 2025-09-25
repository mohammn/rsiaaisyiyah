<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $DBGroup = 'sik';
    protected $table      = 'pasien';
    protected $primaryKey = 'no_rkm_medis';
    protected $allowedFields = ['no_rkm_medis', 'no_ktp', 'nm_pasien', 'alamat', 'tgl_lahir', 'jk', 'no_tlp'];
}
