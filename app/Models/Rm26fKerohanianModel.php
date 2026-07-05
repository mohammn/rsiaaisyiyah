<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm26fKerohanianModel extends Model
{
    protected $table         = 'rm26f_kerohanian';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        // Dipertahankan sesuai request awal
        'noRawat',

        // Data Penanggung Jawab
        'nama',
        'jk',
        'tempatLahir',
        'tanggalLahir', // Menampung data 'tglLahir' dari JavaScript
        'nik',
        'alamat',
        'sebagai',

        // Pemberian Informasi & Detail (Sesuai Form Terbaru)
        'petugas',
        'petugasKerohanian', // TAMBAHAN: menangkap data petugas kerohanian baru
        'waktu',
        'noHp',              // DIPINDAHKAN: ke daftar field aktif

        // Kolom wajib yang diminta untuk dibiarkan saja
        'tglinput',
        'ttdWali',
    ];
}
