<?php

namespace App\Models;

use CodeIgniter\Model;

class PjPasienModel extends Model
{
    protected $table      = 'pj_pasien';
    protected $primaryKey = 'id';
    protected $allowedFields = ['namaPj', 'nikPj', 'tglLahirPj', 'jkPj', 'alamatPj', 'noRm', 'tempatLahirPj'];
}
