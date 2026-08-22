<?php

namespace App\Models;

use CodeIgniter\Model;

class PenerjemahModel extends Model
{
    protected $table         = 'penerjemah';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        'noRawat',
        'nama',
        'jk',
        'alamat',
        'sebagai',
        'petugas',
        'tempatLahir',
        'tanggalLahir',
        'nik',
        'bahasa',
        'noHp',
        // Kolom yang kamu minta untuk dibiarkan saja
        'tglinput',
        'ttdWali',
    ];
}
