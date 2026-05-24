<?php

namespace App\Models;

use CodeIgniter\Model;

class DokterModel extends Model
{
    protected $DBGroup = 'sik';
    protected $table      = 'dokter';
    protected $primaryKey = 'kd_dokter';
    protected $allowedFields = [];
}
