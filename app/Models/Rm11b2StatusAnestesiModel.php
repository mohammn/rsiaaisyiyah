<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm11b2StatusAnestesiModel extends Model
{
    protected $table         = 'rm11b2_status_anestesi';
    protected $primaryKey    = 'id';

    protected $allowedFields = [
        // Primary Key / Relasi Pasien
        'noRawat',

        // ==========================================
        // TAB: DOKTER / PERAWAT (LOKASI & PETUGAS)
        // ==========================================
        'ruang',
        'diagnosisPraAnestesi',
        'rencanaTindakan',
        'tgl',
        'tempat',
        'petugas',
        'spesialisBedah',
        'asistenBedah',
        'spesialisAnestesiologi',
        'asistenAnestesi',

        // ==========================================
        // TAB I: ASSESMENT
        // ==========================================
        // Riwayat & Anamnesa
        'anamnesaDari',
        'anamnesaLainnya',
        'riwayatAnestesi',
        'keteranganAnestesi',
        'riwayatKomplikasi',
        'keteranganKomplikasi',
        'obatDikonsumsi',
        'riwayatAlergi',
        'keteranganAlergi',

        // Keadaan & Tanda Vital
        'beratBadan',
        'tinggiBadan',
        'bmi',
        'tensiDarah',
        'nadi',
        'rr',
        'suhu',
        'skorNyeri',

        // Evaluasi Jalan Nafas
        'bebas',
        'alatBantuNafas',
        'bukaMulut',
        'leher',
        'gerakLeher',
        'mallampathy',
        'obesitas',
        'massa',

        // Pemeriksaan Laboratorium
        'hbHet',
        'fungsiGinjal',
        'fungsiHati',
        'serumElektrolit',
        'faalBT',
        'faalCT',
        'lainLainLab',

        // Pemeriksaan Penunjang
        'echocardiografi',
        'ekg',
        'fotoRadiologi',
        'evaluasiFaalParu',
        'lainLainPenunjang',

        // Simpulan Asesmen Pra-Anestesi
        'psaAsa',
        'penyulit',
        'komplikasi',
        'rencanaTindakanAnestesi',

        // Pengecekan Sistem Organ (1. Pernafasan)
        'pernafasan',
        'pernafasanLainnyaCheck',
        'pernafasanLainnyaText',
        'pernafasanDbn',
        'merokok',

        // Pengecekan Sistem Organ (2. Kardiovaskuler)
        'kardiovaskuler',
        'kardiovaskulerLainnyaCheck',
        'kardiovaskulerLainnyaText',
        'kardiovaskulerDbn',
        'alkohol',

        // Pengecekan Sistem Organ (3. Neuro/Muskuloskeletal)
        'neuroMuskuloskeletal',
        'neuroLainnyaCheck',
        'neuroLainnyaText',
        'neuroMuskuloskeletalDbn',
        'catatanNeuro',

        // Pengecekan Sistem Organ (4. Renal/Endokrin)
        'renalEndokrin',
        'renalLainnyaCheck',
        'renalLainnyaText',
        'renalEndokrinDbn',
        'catatanRenal',

        // Pengecekan Sistem Organ (5. Hepato/Gastrointestinal)
        'hepatoGastro',
        'hepatoLainnyaCheck',
        'hepatoLainnyaText',
        'hepatoGastroDbn',
        'catatanHepato',

        // Pengecekan Sistem Organ (6. Lain-lain)
        'organLainLain',
        'organLainnyaCheck',
        'organLainnyaText',
        'organLainLainDbn',
        'catatanOrganLain',

        // Petugas Pemeriksa Tab I
        'dokterI',
        'tanggalJamI',

        // ==========================================
        // TAB II: RENCANA ANESTESI
        // ==========================================
        // Obat Awal
        'obatAwal',
        'permedikasiDetail',
        'permedikasiLainnyaCheck',
        'permedikasiLainnya',
        'generalAnestesiTipe',
        'gaLainnyaCheck',
        'gaLainnyaText',

        // Obat Induksi
        'obatInduksi',
        'insufilasiText',
        'sedatifDetail',
        'sedatifLainnyaCheck',
        'sedatifLainnya',
        'analgetikDetail',
        'analgetikLainnyaCheck',
        'analgetikLainnya',
        'pelumpuhDetail',
        'pelumpuhLainnyaCheck',
        'pelumpuhLainnya',

        // Obat Maintenance
        'obatMaintenance',
        'inhalasiDetail',
        'inhalasiLainnyaCheck',
        'inhalasiLainnya',
        'intravenaDetail',
        'intravenaLainnyaCheck',
        'intravenaLainnyaNama',
        'intravenaLainnyaDosis',
        'regionalAnestesiTipe',
        'raLainnyaCheck',
        'raLainnyaText',
        'anestesiLokalDetail',
        'anestesiLokalLainnyaCheck',
        'anestesiLokalLainnya',
        'additif1Check',
        'additif1Nama',
        'additif1Dosis',
        'additif2Check',
        'additif2Nama',
        'additif2Dosis',

        // Petugas Tab II
        'catatanII',
        'dokterII',
        'tanggalJamII',

        // ==========================================
        // TAB III: ASSESMENT (INDUKSI)
        // ==========================================
        'masalahInduksiStatus',
        'masalahInduksiText',
        'perubahanRencanaStatus',
        'perubahanRencanaText',
        'tdIII',
        'hrIII',
        'rrIII',
        'tIII',
        'spo2III',
        'makanTerakhir',
        'minumTerakhir',
        'dokterIII',
        'agen',
        'diberikanOleh',
        'tanggalJamIII',

        // ==========================================
        // TAB IV: DAFTAR TILIK
        // ==========================================
        'persiapan',
        'pascaInduksi',

        // ==========================================
        // TAB V: TATA LAKSANA
        // ==========================================
        'teknikIntubasi',
        'teknikInduksi',
        'lokasiInfus',
        'tempatCvc', // Atau tempatCvc jika di database sudah diganti
        'tempatArterial',
        'kateterArteri',
        'posisi',
        'posisiLainnya',
        'airway',
        'lmaNo',
        'lmaCuff',
        'ettText',
        'ettJalur',
        'ettNo',
        'ettCuff',
        'peralatanLain',

        'ttdDokter1',
        'ttdDokter2',
        'ttdDokter3',
        'ttdDokter4',
    ];
}
