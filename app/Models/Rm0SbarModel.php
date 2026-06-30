<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm0SbarModel extends Model
{
    protected $table         = 'rm0_sbar';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        // --- Data Pasien & Petugas ---
        'noRawat',
        'judul',
    ];
}
