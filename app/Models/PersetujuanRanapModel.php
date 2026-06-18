<?php

namespace App\Models;

use CodeIgniter\Model;

class PersetujuanRanapModel extends Model
{
    protected $table      = 'persetujuan_ranap';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'noRawat',
        'namaWali',
        'noTelp',
        'alamat',
        'sebagai',
        'petugas',
        'saksi',
        'dokter',
        'namaKeluarga',
        'izin_jenguk',
        'isi_kecuali',
        'jenis_pasien',
        'status_asuransi_umum',
        'kelas_umum',
        'kelas_umum_lain_text',
        'biaya_min',
        'biaya_max',
        'no_bpjs',
        'bpjs_status_kelas',
        'bpjs_naik_tingkat',
        'nama_asuransi_lain',
        'ttdWali',
        'ttdSaksi',
        'tglinput'
    ];
}
