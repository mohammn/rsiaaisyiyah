<?php

namespace App\Models;

use CodeIgniter\Model;

class DpjpModel extends Model
{
    protected $table      = 'dpjp';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jk', 'tanggalLahir', 'umur', 'alamat', 'sebagai', 'dokter', 'ttdWali', 'tglinput', 'noRawat', 'nama', 'tempatLahir', 'petugas'];
}
