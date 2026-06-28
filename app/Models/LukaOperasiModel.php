<?php

namespace App\Models;

use CodeIgniter\Model;

class LukaOperasiModel extends Model
{
    protected $table         = 'luka_operasi';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        // --- Data Pasien & Petugas ---
        'noRawat',
        'unit',
        'petugasPreOperasi',
        'tglMrs',
        'tglOperasi',
        'beratBadan',
        'albumin',
        'isiGulaDarah',
        'waktuPencukuran',
        'persiapanUsusDg',
        'isiPenyakitLainnya',

        // --- Radio Buttons Bagian 1 ---
        'suhuPasien',
        'merokok',
        'mrsa',
        'hasilMrsa',
        'jenisOps',
        'trauma',
        'gulaDarah',
        'pencukuran',
        'persiapanUsus',

        // --- Checkbox Multipel Bagian 1 ---
        'penyakit',

        // --- Input Text, Time, dll Bagian 2 ---
        'diagnosaPre',
        'isiSteroid',
        'isiKualifikasiLainnya',
        'isipenyakitInfeksiLainnya',
        'profilaksisObat',
        'profilaksisJam',
        'profilaksisDosis',
        'skintestHasil',
        'ronde',
        'isiSuhuPasien',

        // --- Radio Buttons Bagian 2 ---
        'steroid',
        'mandi',
        'radioterapi',
        'profilaksis',
        'skintest',

        // --- Checkbox Multipel Bagian 2 ---
        'kualifikasi',
        'penyakitInfeksi',

        // --- Input Text Bagian 2.1 ---
        'petugasRuangOperasi',
        'sirkulasi',
        'suhuRuang',
        'kelembapan',
        'angkaKuman',
        'isiprosedurOperasiLainnya',
        'isiprosedurOperasiLainnya2',
        'drainJenis',
        'implantJenis',

        // --- Radio Buttons Bagian 2.1 ---
        'ruangOperasi',
        'tekananUdara',
        'multiProsedur',
        'jamurAc',
        'drain',
        'implant',

        // --- Checkbox Multipel Bagian 2.1 ---
        'prosedurOperasi',

        // --- Input Text Bagian 2.2 ---
        'antibiotikObat',
        'antibiotikJam',
        'antibiotikDosis',
        'jumlahStaff',
        'jamMulaiOps',
        'jamSelesaiOps',
        'isiDisinfeksiKulitLainnya',
        'diagnosaPost',

        // --- Radio Buttons Bagian 2.2 ---
        'sterilisasi',
        'asaScore',
        'antibiotik',
        'indikator',
        'klasifikasiLuka',
        'disinfeksiKulit',

        // ==========================================
        // --- POST OPERASI (DATA TABEL 1-31) -------
        // ==========================================
        'isiAntibiotik',
        'tgl',

        // Checkbox Tindakan Per Hari (Array JSON/Text di DB)
        'rawatLuka',
        'transparan',
        'thypafix',
        'drainTindakan',
        'aff',
        'angkat',
        'antibiotikTindakan',
        'krs',
        'kontrol',
        'mrs',

        // Checkbox Identifikasi ILO Per Hari (Array JSON/Text di DB)
        'nyeri',
        'demam',
        'kemerahan',
        'drainase',
        'bengkak',
        'kuman',
        'ada',
        'diagnosa',

        // Input Text Keterangan Flat (Kolom Kanan)
        'ketRawatLuka',
        'ketTransparan',
        'ketThypafix',
        'ketDrain',
        'ketAff',
        'ketAngkat',
        'ketAntibiotik',
        'ketKrs',
        'ketKontrol',
        'ketMrs',
        'ketNyeri',
        'ketDemam',
        'ketKemerahan',
        'ketDrainase',
        'ketBengkak',
        'ketKuman',
        'ketAda',
        'ketDiagnosa', // Mempertahankan typo 'ketDiagnsosa' agar sinkron

        // Radio Tambahan di bawah tabel
        'buangCairan',
        'affDrain',
        'jenisLokasi',
        'lokasiSpesifik',
        'isiLokasiSpesifikLainnya',
    ];

    // Auto-generate petugas1 sampai petugas31 di dalam constructor model
    public function __construct()
    {
        parent::__construct();
        for ($i = 1; $i <= 31; $i++) {
            $this->allowedFields[] = 'petugas' . $i;
        }
    }
}
