<?php

namespace App\Models;

use CodeIgniter\Model;

class IcPembiusanLokalModel extends Model
{
    protected $table         = 'ic_pembiusan_lokal';
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
        'jenis',
        'tglinput',
        'ttdSaksi',
        'ttdWali',

        // Kolom tambahan baru
        'diagnosis',
        'prognosis',
        'alternatif',
        'lainLain',
    ];
}
