<?php

namespace App\Models;

use CodeIgniter\Model;

class HivModel extends Model
{
    protected $table         = 'hiv';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        // Dipertahankan sesuai request awal
        'noRawat',

        // ==========================================
        // KOLOM KIRI (DATA KLIEN & KONSELING)
        // ==========================================
        'statusHamil',
        'umurAnakTerakhir',
        'jumlahAnak',
        'kelompokRisiko',
        'jenisPs',
        'lamanya',
        'statusKunjungan',
        'statusRujuk',
        'alasanTes',
        'isiAlasanTesLainnya',
        'tglKonselingPra',
        'statusKlien',
        'infoTes',
        'tglPemberianInfo',
        'pernahTes2',
        'pernahTesDmn2',
        'pernahTesTgl2',
        'hasilTesSebelumnya2',
        'penyakit',
        'isiImsLainnya',
        'isiPenyakitLainnya',
        'kesediaanTes2',
        'tglKonselingPasca',
        'jmlKondom',
        'terimaHasil',
        'gejalaTb',
        'tindakLanjutKts',
        'jenisKonselingKts',
        'jenisPetugasPendukung',
        'isiLsm',
        'statusLayanan',
        'jenisLayanan',
        'petugas',

        // ==========================================
        // KOLOM KANAN (PASANGAN & RISIKO)
        // ==========================================
        'pasanganTetap',
        'pasanganPerempuan',
        'pasanganHamil',
        'tglLahirPasangan',
        'tglTesPasangan',
        'hasilTesPasangan',
        'wbp',
        'hubVag',
        'hubVagTgl',
        'hubAnal',
        'hubAnalTgl',
        'gantianSuntik',
        'gantianSuntikTgl',
        'transfusiDarah',
        'transfusiDarahTgl',
        'transmisiIbu',
        'transmisiIbuTgl',
        'isiLainnya',
        'isiLainnyaTgl',
        'periodeJendela',
        'periodeJendelaTgl',
        'kesediaanTes',
        'pernahTes',
        'pernahTesDmn',
        'pernahTesTgl',
        'hasilTesSebelumnya',
        'tglTesHiv',
        'jenisTes',
        'hasilTesR1',
        'reagenR1',
        'hasilTesR2',
        'reagenR2',
        'hasilTesR3',
        'reagenR3',
        'kesimpulanTes',
        'noPdp',
        'tglPdp',
        'tindakLanjut',
        'isiRujukKonseling',
        'isiRujukKe',
        'isitindakLanjutLainnya',
        'hivPasangan',
    ];
}
