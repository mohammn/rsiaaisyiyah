<?php

namespace App\Models;

use CodeIgniter\Model;

class DataBarangModel extends Model
{
    protected $DBGroup = 'sik';
    protected $table      = 'databarang';
    protected $primaryKey = 'kode_brng';
    protected $allowedFields = [];
}
