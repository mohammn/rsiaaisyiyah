<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm7bPengkajianDataModel extends Model
{
    protected $table         = 'rm7b_pengkajian_data';
    protected $primaryKey    = 'id';

    protected $allowedFields = [
        'id_pengkajian',
        'hamil_ke',
        'abortus',
        'prematur',
        'aterm',
        'jenis_persalinan',
        'penolong_nakes',
        'penolong_non_nakes',
        'jk',
        'bbl',
        'keadaan_normal',
        'keadaan_cacat',
        'keadaan_mati'
    ];
}
