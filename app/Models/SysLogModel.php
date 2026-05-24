<?php

namespace App\Models;

use CodeIgniter\Model;

class SysLogModel extends Model
{
    protected $table      = 'sys_log';
    protected $primaryKey = 'id';
    protected $allowedFields = ['petugas', 'tindakan', 'tabel', 'noRawat', 'dataLama', 'dataBaru'];
}
