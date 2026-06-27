<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm27cPlebitisModel extends Model
{
    protected $table         = 'rm27c_plebitis';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        // --- Data Pasien & Petugas ---
        'noRawat',
        'bulan',
        'ruang',
        'umur',
        'diagnosa',

        'lokasiPemasangan',
        'isilokasiPemasanganLainnya',

        'golObat',
        'isigolObatLainnya',

        'ivCath',
        'isiivCath',

        'jenisCairan',
    ];

    // Auto-generate petugas, ket, dan checkbox tindakan di dalam constructor model
    public function __construct()
    {
        parent::__construct();

        // Auto-generate petugas1 sampai petugas31
        for ($i = 1; $i <= 10; $i++) {
            $this->allowedFields[] = 'petugas' . $i;
            $this->allowedFields[] = 'tgl' . $i;
        }

        // Auto-generate ket1 sampai ket17 dan c1 sampai c17
        for ($i = 1; $i <= 17; $i++) {
            $this->allowedFields[] = 'ket' . $i;
            $this->allowedFields[] = 'c' . $i; // <-- TAMBAHAN: Menyisipkan field c1 sampai c17
        }
    }
}
