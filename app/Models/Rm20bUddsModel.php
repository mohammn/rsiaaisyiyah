<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm20bUddsModel extends Model
{
    protected $table         = 'rm20b_udds';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        // --- Data Utama ---
        'noRawat',

        // --- Data Pasien ---
        'ruang',
        'kamar',
        'alergi',

        // --- Data Petugas & Medis ---
        'dokter',
        'diagnosa',
    ];
}
