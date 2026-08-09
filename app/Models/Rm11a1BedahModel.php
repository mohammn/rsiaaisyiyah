<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm11a1BedahModel extends Model
{
    protected $table         = 'rm11a1_bedah';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        'noRawat',

        // 1. Anamnesa
        'nama',
        'tempatPengkajian',
        'keluhan',
        'riwayatPenyakit',
        'isiRiwayatLainnya',
        'jenisOperasi',
        'lokasiOperasi',
        'tglOperasi',
        'riwayatAlergi',
        'isiAlergi',

        // 2. Pemeriksaan Fisik
        'td',
        'beratBadan',
        'nadi',
        'tinggiBadan',
        'suhu',
        'pernafasan',

        // 3. Hasil Pemeriksaan Penunjang
        'laboratorium',
        'radiologi',
        'penunjangLainnya',
        'rekonsiliasi',

        // 4. Diagnosa / Asesmen
        'diagnosaPreoperatif',
        'diagnosaLain',
        'isidiagnosaLain',

        // 5. Rencana Tatalaksana
        'rencanaOperasi',
        'sifatProsedur',
        'isiElektif',
        'lamaTindakan',
        'anestesia',
        'puasa',
        'isiMulaiJam',
        'konsultasiBagian',
        'isiKonsultasi',
        'peralatan',
        'isiPeralatanLain',
        'pengosonganKemih',
        'infus',
        'persiapanDarah',
        'isiWholeBlood',
        'isiPackedRed',
        'isiKomponenLain',

        // Post Op, Catatan, & Dokter
        'rencanaPostOp',
        'catatan',
        'dokter',

        // Field Sistem Bawaan
        'petugas',
        'tglinput',
        'ttdWali',

        //penandaan
        'badan',
        'kepalaSamping',
        'kepala',
        'telapakTangan',
        'kaki',
        'punggungTangan'
    ];
}
