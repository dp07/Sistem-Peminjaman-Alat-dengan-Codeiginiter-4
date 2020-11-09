<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $useTimestamps = true;
    protected $allowedFields = ['nis', 'nama', 'username', 'password', 'kelas', 'hp', 'level', 'status', 'foto'];

    public function cek_login($nis, $password)
    {
        return $this->where(['nis' => $nis, 'password' => $password])->first();
    }

    public function search($keyword)
    {
        return  $this->table('user')->like('nama', $keyword)->orLike('nis', $keyword);
    }
}
