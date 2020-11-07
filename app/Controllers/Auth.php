<?php

namespace App\Controllers;

use \App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        return view('/login');
    }

    public function ceklogin()
    {
        $nis = $this->request->getVar('nis');
        $password = $this->request->getVar('password');

        $cek = $this->userModel->cek_login($nis, $password);

        // cek nis dan username
        if ($cek != null) {
            if ($cek['nis'] == $nis && $cek['password'] == $password) {
                session()->set('nama', $cek['nama']);
                session()->set('kode_alat', $cek['kode_alat']);
                session()->set('nis', $cek['nis']);
                session()->set('level', $cek['level']);
                session()->set('foto', $cek['foto']);

                return redirect()->to('/home');
            }
        } else {
            session()->setFlashdata('pesan', 'NIS atau Password salah!!!');
            return redirect()->to('/auth');
        }
    }

    //--------------------------------------------------------------------

}
