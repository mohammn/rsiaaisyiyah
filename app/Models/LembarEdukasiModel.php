<?php

namespace App\Models;

use CodeIgniter\Model;

class LembarEdukasiModel extends Model
{
    protected $table         = 'lembar_edukasi';
    protected $primaryKey    = 'id'; // Pastikan primary key sesuai dengan tabel Anda (id / no_rawat)

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [];

    public function __construct()
    {
        parent::__construct();

        // 1. Definisikan field identitas pasien terlebih dahulu
        $fields = [
            'noRawat', // Sesuaikan snake_case / camelCase dengan nama kolom DB Anda
            'petugas',
            'nama',
            'agama',
            'bahasa',
            'penerjemah',
            'pendidikan',
            'baca_tulis',
            'komunikasi',
            'hambatan_edukasi',
            'intervensi_hambatan',
            'nilai_keyakinan',
            'kesediaan_informasi',
            'ttdWali',

            'tglinput'
        ];

        // 2. Tambahkan kolom edukasi indeks 1 sampai 8 secara otomatis lewat looping
        for ($idx = 1; $idx <= 8; $idx++) {
            $fields[] = "tgl_{$idx}";
            $fields[] = "metode_{$idx}";
            $fields[] = "media_{$idx}";
            $fields[] = "evaluasi_{$idx}";
            $fields[] = "lainnya_{$idx}";
            $fields[] = "petugas_{$idx}";
            $fields[] = "wali_{$idx}";
            $fields[] = "ttd_{$idx}";
        }

        // 3. Masukkan ke property allowedFields bawaan CI4
        $this->allowedFields = $fields;
    }
}
