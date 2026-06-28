<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm27bKateterModel extends Model
{
    protected $table         = 'rm27b_kateter';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        // --- Data Pasien & Petugas ---
        'noRawat',
        'jumlahPengunci',

        'jenisCath',
        'isiJenisCath',

        'ivCath',
        'isiivCath',
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
        for ($i = 1; $i <= 19; $i++) {
            $this->allowedFields[] = 'ket' . $i;
            $this->allowedFields[] = 'c' . $i; // <-- TAMBAHAN: Menyisipkan field c1 sampai c17
        }
    }
}
