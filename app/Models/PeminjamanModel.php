<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $useTimestamps = true;
    protected $allowedFields = ['user_nis', 'pk_alat', 'pn_alat', 'p_jumlah'];

    // public function getAlatByNis(){
    //     $this->query('SELECT * FROM ')
    // }
}
