<?php

namespace App\Models;

use CodeIgniter\Model;

class PersetujuanRajalModel extends Model
{
    protected $table      = 'persetujuanrajal';
    protected $primaryKey = 'id';
    protected $allowedFields = ['noRm', 'nama', 'noHp', 'alamat', 'sebagai', 'petugas', 'saksi', 'keluarga', 'pembayaran', 'selesai', 'ttdWali', 'ttdSaksi'];
}
