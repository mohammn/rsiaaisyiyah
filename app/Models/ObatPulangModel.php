<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatPulangModel extends Model
{
    protected $table         = 'obat_pulang';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi
    protected $allowedFields = [
        'noRawat',  // sesuaikan penulisan kolom jika di database no_rawat / noRawat
        'nama',
        'ruang',
        'petugas',
        'keterangan',
        'ttdWali',
        'tglinput'
    ];
}
