<?php

namespace App\Models;

use CodeIgniter\Model;

class rm20bUddsDataJamModel extends Model
{
    protected $table         = 'rm20b_udds_data_jam';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        // --- Data Utama ---
        'noRawat',
        'idObat',

        'apoteker',
        'pemberiObatOral',
        'pemberiObat',

        'tanggal',
        'pagi',
        'siang',
        'sore',
        'malam',
    ];
}
