<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm26iPeyimpananBarangModel extends Model
{
    protected $table         = 'rm26i_penyimpanan_barang';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        // Dipertahankan sesuai request awal
        'noRawat',

        // Data Penanggung Jawab
        'nama',
        'petugas',
        'satpam',
        'waktuTitip',
        'waktuSerah',

        // Kolom wajib yang diminta untuk dibiarkan saja
        'tglinput',
        'ttdWali',
    ];
}
