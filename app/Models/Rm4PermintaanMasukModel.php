<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm4PermintaanMasukModel extends Model
{
    protected $table         = 'rm4_permintaan_masuk';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        // Dipertahankan sesuai request awal
        'noRawat',

        // Data Penanggung Jawab (Form Kiri)
        'nama',
        'noKartu',
        'noSep',
        'biaya',
        'isiBiayaLain',

        // Pemberian Informasi (Form Kanan)
        'tglMasuk',
        'ruang',
        'petugas',
        'dokter',
        'diagnosa',

        // Kolom wajib yang diminta untuk dibiarkan saja
        'tglinput',
        'ttdWali',
        'ttdDokter',
        'ttdPetugas',
    ];
}
