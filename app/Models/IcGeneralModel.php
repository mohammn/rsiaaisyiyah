<?php

namespace App\Models;

use CodeIgniter\Model;

class IcGeneralModel extends Model
{
    protected $table         = 'ic_general';
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
        'tindakanMedis',
        'saksi',
        'tglinput',
        'ttdSaksi',
        'ttdWali',
        'saksi',
        'judul',

        'jenis',

        // 11 Field Baru Pemberian Informasi
        'diagnosis',
        'dasar',
        'tindakan',
        'indikasi',
        'tataCara',
        'tujuan',
        'risiko',
        'komplikasi',
        'prognosis',
        'alternatif',
        'lainLain'
    ];
}
