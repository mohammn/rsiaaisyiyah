<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatPulangDataModel extends Model
{
    protected $table         = 'obat_pulang_data';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi
    protected $allowedFields = [
        'obat_pulang_id',
        'noRawat',
        'kode_brng',
        'pagi',
        'siang',
        'sore',
        'malam',
        'instruksi',
        'petugas'
    ];
}
