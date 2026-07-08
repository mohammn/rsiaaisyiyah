<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm26bRujukKeluarDataModel extends Model
{
    protected $table         = 'rm26b_rujuk_keluar_data';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        // Dipertahankan sesuai request awal
        'noRawat',

        // Data Penanggung Jawab
        'idRujuk',
        'namaTindakan',
        'waktuTindakan',
    ];
}
