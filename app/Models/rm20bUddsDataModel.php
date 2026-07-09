<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm20bUddsDataModel extends Model
{
    protected $table         = 'rm20b_udds_data';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        // --- Data Utama ---
        'idUdds',
        'jenis_obat',
        'nama_obat',
        'dosis',
        'jumlah',
    ];
}
