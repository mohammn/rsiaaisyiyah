<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm9aTransferPasienModel extends Model
{
    protected $table         = 'rm9a_transfer_pasien';
    protected $primaryKey    = 'id';

    // Daftarkan semua field yang boleh diisi di sini
    protected $allowedFields = [
        'noRawat',
        'nama',
        'sebagai',
        'dariUnit',
        'keUnit',
        'dokter',
        'waktu',
        'metodePindah',
        'indikasiPindah',
        'isiIndikasiLainnya',
        'diagnosa',
        'tindakan',
        'obat',
        'pemeriksaan',
        'alatMedis',
        'setuju',
        'keadaanKU',
        'keadaanTD',
        'keadaanN',
        'keadaanS',
        'keadaanCRT',
        'keadaanRR',
        'keadaanLainLain',
        'keluhanUtama',
        'keadaanKU2',
        'keadaanTD2',
        'keadaanN2',
        'keadaanS2',
        'keadaanCRT2',
        'keadaanRR2',
        'keadaanLainLain2',
        'keluhanUtama2',
        'petugasMenyerahkan',
        'petugasMenerima',
        'petugas'
    ];
}
