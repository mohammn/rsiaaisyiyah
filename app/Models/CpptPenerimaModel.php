<?php

namespace App\Models;

use CodeIgniter\Model;

class CpptPenerimaModel extends Model
{
    protected $table      = 'cppt_penerima';
    protected $primaryKey = 'id';

    protected $allowedFields    = [
        'noRawat',
        'tanggal',
        'jam',
        'penerima'
    ];
}
