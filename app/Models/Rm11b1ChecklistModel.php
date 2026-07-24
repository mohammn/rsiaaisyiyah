<?php

namespace App\Models;

use CodeIgniter\Model;

class rm11b1ChecklistModel extends Model
{
    protected $table         = 'rm11b1_checklist';
    protected $primaryKey    = 'id';

    protected $allowedFields = [
        // Dipertahankan sesuai request
        'noRawat',

        // --- HEADER / GENERAL ---
        'ruang',
        'tgl',
        'jamSignIn',
        'jamTimeOut',
        'jamSignOut',

        // --- TAB 1: SIGN IN ---
        'verifikasi', // JSON Array
        'dokterBedah',
        'dokterAnestesi',
        'namaTindakan',
        'pemberian_tanda_pilihan',
        'diagnosa',
        'kelengkapan', // JSON Array
        'perawatAnestesi',

        // Tanda Vital & Risiko
        'kesadaran',
        'tekananDarah',
        'nadi',
        'saturasiOksigen',
        'suhu',
        'skalaNyeri',
        'alergi',
        'isiAlergi',
        'aspirasi',
        'pendrahan',
        'rencanaAnestesi', // JSON Array

        // --- TAB 2: TIME OUT ---
        'verbal1', // JSON Array
        'fasilitasOperasi',
        'profilaksis',
        'profilaksisObat',
        'profilaksisJam',
        'profilaksisDosis',
        'sirkuler',
        'instrumen',
        'antisipasi1',
        'antisipasi2',
        'antisipasi31',
        'antisipasi32',
        'antisipasi33',

        // --- TAB 3: SIGN OUT ---
        'verbal2',
        'kelengkapanOperasi', // JSON Array
        'isiKelengkapanLainnya',
        'preparat',
        'jenis', // JSON Array
        'isijenisLainnya',
        'formulir',
        'lengkapiIdentitas',
        'asisten',
        'perhatianOperator',
        'perhatianDokter',
        'perhatianPerawat',
        'ruangPemulihan',
        'periksaKembali',
        'instruksiKhusus',
        'operator',
        'drAnestesi',

        'ttdPerawatAnestesi',
        'ttdDokterAnestesi1',
        'ttdSirkuler',
        'ttdInstrumen',
        'ttdAsisten',
        'ttdOperator',
        'ttdDokterAnestesi2'
    ];
}
