<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm26ePendapatLainModel extends Model
{
    protected $table         = 'rm26e_pendapat_lain';
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
        'tanggalLahir', // Ini untuk menampung input tglLahir
        'dokter',
        'nik',

        // Kolom pemberian informasi
        'diagnosa',
        'hasilPemeriksaan',

        // Kolom dokter rumah sakit lain
        'dokterLain',
        'ahli',
        'rumahSakit',

        // Kolom yang kamu minta untuk dibiarkan saja
        'tglinput',
        'ttdWali',
    ];
}
