<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $table      = 'pasien';
    protected $primaryKey = 'id';
    protected $allowedFields = ['noRm', 'nik', 'nama', 'alamat', 'tanggalLahir', 'status'];
}
