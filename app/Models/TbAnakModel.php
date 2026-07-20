<?php

namespace App\Models;

use CodeIgniter\Model;

class TbAnakModel extends Model
{
    protected $table         = 'tb_anak';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        // Dipertahankan sesuai request awal
        'noRawat',

        // Data Petugas
        'petugas',

        // --- PEMERIKSAAN BERAT BADAN & TINGGI BADAN ---
        'beratBadan',
        'tinggiBadan',
        'statusGizi',

        // --- PEMERIKSAAN RIWAYAT KONTAK TBC ---
        'kontakTbc',
        'jenisKontak',
        'indeksTbc',
        'jenisTbc',

        // --- FAKTOR RISIKO ---
        'berobatTbc',
        'tglBerobatTbc',
        'berobatTbcTakTuntas',
        'kurangGizi',
        'merokok',
        'perokokPasif',
        'kencingManis',
        'odhiv',
        'lansia',
        'ibuhamil',
        'wbp',
        'tglWbp',
        'statusWbp',
        'kumuh',

        // --- DATA TES & SKRINING GEJALA ---
        'tglSkrining',
        'tempatSkrining',
        'batuk',
        'durasiBatuk',
        'demam',
        'bb',
        'lesu',
        'getahBening',
        'positif',

        // --- PEMERIKSAAN RADIOGRAFI TORAKS ---
        'radiografi',
        'skorRadiologi',
        'kesanRadiologi',
        'kesimpulan',

        // --- HASIL TES TBC & RUJUKAN ---
        'terduga',
        'laten',
        'fasyankes',

        // Kolom wajib yang diminta untuk dibiarkan saja
        'ttdWali',
    ];
}
