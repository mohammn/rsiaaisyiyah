<?php

namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $DBGroup = 'sik';
    protected $table      = 'petugas';
    protected $primaryKey = 'nip';
    protected $allowedFields = [];
}
