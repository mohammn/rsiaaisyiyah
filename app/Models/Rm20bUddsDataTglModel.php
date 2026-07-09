<?php

namespace App\Models;

use CodeIgniter\Model;

class rm20bUddsDataTglModel extends Model
{
    protected $table         = 'rm20b_udds_data_tgl';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        // --- Data Utama ---
        'idUdds',

        'tanggal',
    ];
}
