<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm11b2MonitoringAnestesiDataModel extends Model
{
    protected $table         = 'rm11b2_monitoring_anestesi_data';
    protected $primaryKey    = 'id';

    protected $allowedFields = [
        // Relasi & Informasi Utama
        'idMonitoring',
        'waktu',

        // Tanda Vital Intra-Anestesi
        'sistolik',
        'diastolik',
        'rr',
        'spo2',
        'temp',
        'jenis'
    ];
}
