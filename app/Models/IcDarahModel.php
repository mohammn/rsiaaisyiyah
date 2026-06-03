<?php

namespace App\Models;

use CodeIgniter\Model;

class IcDarahModel extends Model
{
    protected $table         = 'ic_darah';
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
        'dokter',
        'nik',
        'saksi',
        'tindakanMedis',
        'tglinput',
        'ttdSaksi',
        'ttdWali',

        // Kolom tambahan baru
        'darah',
        'indikasi',
    ];
}
