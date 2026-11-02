<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm11b2MonitoringAnestesiModel extends Model
{
    protected $table         = 'rm11b2_monitoring_anestesi';
    protected $primaryKey    = 'id';

    protected $allowedFields = [
        // Primary Key / Relasi Pasien
        'noRawat',

        // Bagian 1: Intra Anestesi (Obat, Ventilasi, Waktu, Cairan, Petugas 1)
        'obatObatan',
        'ventilasi',
        'tv',
        'rate',
        'peep',
        'gasFlow',
        'n2o_value',
        'o2_value',
        'inhalasi_value',
        'waktuMasukOk',
        'waktuPembiusan',
        'waktuInsisi',
        'waktuSelesaiOp',
        'waktuSelesaiAnestesi',
        'waktuKeluarOk',
        'waktuBayiLahir',
        'apgarScore',
        'bb',
        'tb',


        'wbPra',
        'ffpPra',
        'prcPra',
        'tcPra',
        'kristaloidPra',
        'kolloidPra',
        'cairanLainPra',
        'urinPra',
        's_iPra',
        'darahPra',
        'ebvPra',


        'wbIntra',
        'ffpIntra',
        'prcIntra',
        'tcIntra',
        'kristaloidIntra',
        'kolloidIntra',
        'cairanLainIntra',
        'urinIntra',
        's_iIntra',
        'darahIntra',
        'ebvIntra',


        'teknik',
        'anestesi_lokal_obat',
        'tipe',
        'jumlah_volume',
        'masalah_keterangan',
        'catatanIntra',
        'waktuTtd1',
        'dokter1',

        // Bagian 2: Skor Bromage Pasca Anestesi
        'bromage_t',
        'bromage_keluar',

        // Bagian 3 & 4: Skor Aldrette Pasca Anestesi & Catatan Aldrete
        'td_pra_anestesi',
        'sirkulasi_t',
        'sirkulasi_keluar',
        'kesadaran_t',
        'kesadaran_keluar',
        'oksigenasi_t',
        'oksigenasi_keluar',
        'pernafasan_t',
        'pernafasan_keluar',
        'aktivitas_t',
        'aktivitas_keluar',
        'catatanAldrete',

        // Bagian 5: Kendala, Ruang Pulih, & Pesanan Pasca Anestesi
        'pendarahan',
        'kontraksi_uterus',
        'kompartemen_syndrom',
        'masalah_komentar',
        'perasanTindakan',
        'pindahKe',
        'waktuPindah',
        'disetujuiOleh',
        'tt',
        'infus',
        'puasaSampai',
        'puasaMinum',
        'puasaMakan',
        'bisingUsus',
        'observasi',
        'tensi',
        'tensi_bila',
        'nadi',
        'nadi_bila',
        'kesadaran',
        'produksi_urine',
        'perfusi',
        'terapi',
        'mobilisasi',
        'pascaOpLain',
        'perawat',
        'perawatRr',
        'perawatAnestesi',
        'ttdDokter',
        'ttdPerawat',
        'ttdPerawatRr',
        'ttdAnestesi'
    ];
}
