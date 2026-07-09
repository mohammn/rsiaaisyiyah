<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm20bUddsDataPetugasModel extends Model
{
    protected $table         = 'rm20b_udds_data_petugas';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        // --- Data Utama ---
        'idTgl',

        'apotekerPagi',
        'apotekerSiang',
        'apotekerSore',
        'apotekerMalam',
        'pemberiObatPagi',
        'pemberiObatSiang',
        'pemberiObatSore',
        'pemberiObatMalam',

        'pemberiObatOralPagi',
        'pemberiObatOralSiang',
        'pemberiObatOralSore',
        'pemberiObatOralMalam',
    ];
}
