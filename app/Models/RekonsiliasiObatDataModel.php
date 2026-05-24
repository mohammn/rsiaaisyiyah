<?php

namespace App\Models;

use CodeIgniter\Model;

class RekonsiliasiObatDataModel extends Model
{
    // Nama tabel disesuaikan dengan info darimu
    protected $table         = 'rekonsiliasi_obat_data';
    protected $primaryKey     = 'id';

    // Fitur otomatisasi timestamp CodeIgniter 4 (sinkron dengan created_at dan updated_at di DB)
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Daftar field yang disesuaikan persis dengan skema data obat terbaru
    protected $allowedFields = [
        'idRekonsiliasiObat', // Foreign Key ke tabel induk
        'noRawat',
        'namaObat',
        'ruangan',
        'dosis',
        'frekuensi',
        'caraPemberian',
        'waktuTerakhir',
        'dirawat',
        'keluar'
    ];
}
