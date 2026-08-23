<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm26jRujukanLuarModel extends Model
{
    protected $table         = 'rm26j_rujukan_luar';
    protected $primaryKey    = 'id';

    protected $allowedFields = [
        'noRawat',
        'nama',
        'petugas',

        // Data Umum
        'asal',
        'alasan',
        'keadaan',
        'kesadaran',
        'terapi',
        'tindakan',
        'umur',

        // Handover
        'handOver',
        'isiHandOverLainLain',

        // Keterangan Bidan Penerima
        'keteranganBidan',
        'alasanKeterangan',

        // Data Vital & Diagnosa
        'diagnosa',
        'td_sistol',
        'td_diastol',
        'nadi',
        'suhu',
        'rr',
        'tfu',
        'djj',
        'his',
        'vt',

        // Field Bawaan
        'ttdWali',
        'tglinput'
    ];
}
