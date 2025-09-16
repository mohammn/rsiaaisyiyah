<?php

namespace App\Models;

use CodeIgniter\Model;

class SkorModel extends Model
{
    protected $table      = 'skorpoedji';
    protected $primaryKey = 'id';
    protected $allowedFields = ['idPasien', 'i', 'ii', 'iii', 'iiii'];
}
