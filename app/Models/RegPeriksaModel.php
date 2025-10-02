<?php

namespace App\Models;

use CodeIgniter\Model;

class RegPeriksaModel extends Model
{
    protected $DBGroup = 'sik';
    protected $table      = 'reg_periksa';
    protected $primaryKey = 'no_reg';
    protected $allowedFields = [];
}
