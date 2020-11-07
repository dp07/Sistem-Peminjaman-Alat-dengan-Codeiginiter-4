<?php

namespace App\Controllers;

use \App\Models\UserModel;
use \App\Models\AlatModel;

class Peminjaman extends BaseController
{
    protected $UserModel;
    protected $alatModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->alatModel = new AlatModel();
    }

    public function index()
    {

        $data = [
            'tittle' => 'Peminjaman Alat',
            'alat' => $this->alatModel->findAll()
        ];

        return view('peminjaman/index', $data);
    }

    public function create($id)
    {
        session();
        $data = [
            'tittle' => 'Peminjaman Alat',
            'alat' => $this->alatModel->where(['id' => $id])->first(),
            'validation' => \Config\Services::validation()

        ];

        return view('peminjaman/create', $data);
    }


    //--------------------------------------------------------------------

}
