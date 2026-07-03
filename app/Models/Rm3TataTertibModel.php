<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm3TataTertibModel extends Model
{
    protected $table         = 'rm3_tata_tertib';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        'noRawat',
        'nama',
        'petugas',
        'ttdWali',
        'tglinput',
    ];
}
