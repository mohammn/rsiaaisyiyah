<?php

namespace App\Models;

use CodeIgniter\Model;

class IcPembiusanModel extends Model
{
    protected $table         = 'ic_pembiusan';
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
        'jenis',

        // Kolom tambahan baru
        'jenisAnestesi',
        'isiKombinasi',
        'diagnosa',
        'indikasi',
        'tataCara',
        'tujuan',
        'komplikasi',
        'risiko',
        'prognosis',
        'alternatif',
        'lainLain',
    ];
}
