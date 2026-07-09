<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm20bUddsDataJamSementaraModel extends Model
{
    protected $table         = 'rm20b_udds_data_jam_sementara';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        // --- Data Utama ---
        'tgl',
        'idUdds',
        'namaObat',
        'jenisObat',
        'catatan',

        'pagi',
        'siang',
        'sore',
        'malam',
    ];
}
