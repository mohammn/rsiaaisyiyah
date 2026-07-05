<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm26hKepercayaanModel extends Model
{
    protected $table         = 'rm26h_kepercayaan';
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
        'nilaiKepercayaan',            // DIPINDAHKAN: ke daftar field aktif

        // Kolom wajib yang diminta untuk dibiarkan saja
        'tglinput',
        'ttdWali',
    ];
}
