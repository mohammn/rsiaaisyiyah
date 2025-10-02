<?php

namespace App\Models;

use CodeIgniter\Model;

class KamarInapModel extends Model
{
    protected $DBGroup = 'sik';
    protected $table      = 'kamar_inap';
    protected $primaryKey = 'no_rawat';
    protected $allowedFields = [];
}
