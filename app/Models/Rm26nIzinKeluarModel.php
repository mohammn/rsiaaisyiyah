<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm26nIzinKeluarModel extends Model
{
    protected $table         = 'rm26n_izin_keluar';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        'noRawat',
        'nama',
        'jk',
        'tempatLahir',
        'tanggalLahir', // Menampung input tglLahir
        'nik',
        'alamat',
        'noHp',
        'sebagai',

        // Informasi & Detail Izin
        'dokter',
        'petugas',
        'alasan',
        'waktuKembali',

        // Kolom yang kamu minta untuk dibiarkan saja
        'tglinput',
        'ttdWali',
    ];
}
