<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm0SbarDataModel extends Model
{
    protected $table         = 'rm0_sbar_data';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        // --- Data Pasien & Petugas ---
        'noRawat',
        'idSbar',
        'petugas',
        'dokter',
        'waktu',

        's',
        'b',
        'a',
        'r',

        'tglVerif',
    ];
}
