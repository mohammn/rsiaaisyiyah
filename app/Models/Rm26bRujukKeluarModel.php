<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm26bRujukKeluarModel extends Model
{
    protected $table         = 'rm26b_rujuk_keluar';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        // Dipertahankan sesuai request awal
        'noRawat',
        'petugas',

        // --- DATA RUJUKAN (Form Kiri) ---
        'unit',
        'rs',
        'waktuMenghubungi',
        'petugasDihubungi',
        'noPetugasDihubungi',
        'jamBerangkat',
        'jamTiba',
        'alasanRujuk',
        'isiKlinikal',
        'isiNonKlinikal',
        'diagnosa',
        'dokter',
        'alergi',
        'isiAlergi',
        'riwayatPenyakit',
        'riwayatObat',
        'penyakit',
        'isiPenyakit',

        // --- CATATAN KLINIS / TANDA VITAL (Form Kanan) ---
        'kesadaran',
        'gcs_e',
        'gcs_v',
        'gcs_m',
        'pupil_kanan',
        'pupil_kiri',
        'reflek_cahaya_kanan',
        'reflek_cahaya_kiri',
        'td_sistole',
        'td_diastole',
        'nadi',
        'spo2',
        'rr',
        'suhu',
        'bb',
        'tb',
        'waktuIntake',
        'pemeriksaanPenunjang',
        'peralatan',
        'alat', // Kolom penampung data JSON checkbox
        'isiAlatLainnya',
        'perawatanLanjutan',

        // Kolom wajib yang diminta untuk dibiarkan saja
        'tglinput',
    ];
}
