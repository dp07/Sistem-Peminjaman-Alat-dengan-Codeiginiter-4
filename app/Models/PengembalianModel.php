<?php

namespace App\Models;

use CodeIgniter\Model;

class PengembalianModel extends Model
{
    protected $table = 'pengembalian';
    protected $useTimestamps = true;
    protected $allowedFields = ['nis_user', 'user_nama', 'no_hp', 'detail', 'jumlah_p', 'kode_alat_p', 'pesan', 'status'];

    // public function getAlatByNis(){
    //     $this->query('SELECT * FROM ')
    // }
}
