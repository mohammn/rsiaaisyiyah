<?php

namespace App\Models;

use CodeIgniter\Model;

class RekonsiliasiObatModel extends Model
{
    protected $table         = 'rekonsiliasi_obat';
    protected $primaryKey     = 'id';

    // Fitur otomatisasi timestamp CodeIgniter 4 (karena di tabel kamu ada created_at dan updated_at)
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Daftar field yang disesuaikan persis dengan struktur table database kamu
    protected $allowedFields = [
        'noRawat',
        'alergi',
        'manifestasi',
        'dampak',

        // Data & waktu Ruang IGD
        'perawatIgd',
        'dokterIgd',
        'farmasiIgd',
        'waktuPerawatIgd',
        'waktuDokterIgd',
        'waktuFarmasiIgd',

        // Data & waktu Ruang KO (Kamar Operasi)
        'perawatKo',
        'dokterKo',
        'farmasiKo',
        'waktuPerawatKo',
        'waktuDokterKo',
        'waktuFarmasiKo',

        // Data & waktu Ruang RR (Recovery Room)
        'perawatRr',
        'dokterRr',
        'farmasiRr',
        'waktuPerawatRr',
        'waktuDokterRr',
        'waktuFarmasiRr',

        // Data & waktu Ruang RI (Rawat Inap)
        'perawatRi',
        'dokterRi',
        'farmasiRi',
        'waktuPerawatRi',
        'waktuDokterRi',
        'waktuFarmasiRi'
    ];
}
