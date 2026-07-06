<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm26iPeyimpananBarangDataModel extends Model
{
    protected $table         = 'rm26i_penyimpanan_barang_data';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        // Dipertahankan sesuai request awal
        'idPenyimpanan',

        // Data Penanggung Jawab
        'namaBarang',
        'jumlah',
        'kondisiTitip',
        'kondisiSerah',
    ];
}
