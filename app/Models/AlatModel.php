<?php

namespace App\Models;

use CodeIgniter\Model;

class AlatModel extends Model
{
    protected $table = 'alat';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_alat', 'nama_alat', 'jumlah'];
}
