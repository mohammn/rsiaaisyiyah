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
        'jenis',
        'tglinput',
        'ttdSaksi',
        'ttdWali',

        // Kolom tambahan baru
        'jenisBayar',
        'lainLain',
        'diagnosis',
        'dasarDiagnosis',
        'alternatif',
        'prognosis',
        'darah',
        'indikasi',
    ];
}
