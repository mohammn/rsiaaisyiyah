<?php

namespace App\Models;

use CodeIgniter\Model;

class CpptVerifModel extends Model
{
    protected $table      = 'cppt_verif';
    protected $primaryKey = 'id';

    protected $allowedFields    = [
        'noRawat',
        'tanggal',
        'jam'
    ];
}
