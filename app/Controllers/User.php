<?php

namespace App\Controllers;

use \App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // $builder = $this->userModel->builder();

        $user = $this->userModel->orderBy('id', 'asc')->findAll();
        // $user = $user->orderBy('id', "DESC");
        // dd($user);
        $data = [
            'tittle' => 'User',
            'user' => $user
        ];

        return view('user/index', $data);
    }

    public function create()
    {
        session();
        $data = [
            'tittle' => "Tambah Data User",
            'validation' => \Config\Services::validation()
        ];

        return view('user/create', $data);
    }

    public function save()
    {
        // validation
        if (!$this->validate([
            'nis' => 'required|is_unique[user.nis]',
            'nama' => 'required'
        ])) {
            $validation =  \Config\Services::validation();
            return redirect()->to('/user/create')->withInput()->with('validation', $validation);
        }

        $data = [
            'nis' => $this->request->getVar('nis'),
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'kelas' => $this->request->getVar('kelas'),
            'hp' => $this->request->getVar('hp'),
            'level' => $this->request->getVar('level'),
            'status' => $this->request->getVar('status'),
            'foto' => $this->request->getVar('foto')
        ];
        // dd($data);
        $this->userModel->save($data);
        session()->setFlashdata('pesan', 'Data User Berhasil Ditambahkan');
        return redirect()->to('/user');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        session()->setFlashdata('pesan', 'Data User Berhasil Dihapus');
        return  redirect()->to('/user');
    }

    public function ubah($id)
    {
        $data = [
            'tittle' => "Ubah Data User",
            'user' => $this->userModel->where(['id' => $id])->first(),
            'validation' => \Config\Services::validation()
        ];

        // dd($data['user']);

        return view('user/ubah', $data);
    }

    public function update($id)
    {
        $userLama = $this->userModel->where(['id' => $id])->first();
        if ($userLama['nis'] == $this->request->getVar('nis')) {
            $rule = 'required';
        } else {
            $rule = 'required|is_unique[user.nis]';
        }
        // validation
        if (!$this->validate([
            'nis' => 'required|is_unique[user.nis]',
            'nama' => 'required'
        ])) {
            $validation =  \Config\Services::validation();
            return redirect()->to('/user/create')->withInput()->with('validation', $validation);
        }

        $data = [
            'nis' => $this->request->getVar('nis'),
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'kelas' => $this->request->getVar('kelas'),
            'hp' => $this->request->getVar('hp'),
            'level' => $this->request->getVar('level'),
            'status' => $this->request->getVar('status'),
            'foto' => $this->request->getVar('foto')
        ];
        // dd($data);
        $this->userModel->save($data);
        session()->setFlashdata('pesan', 'Data User Berhasil Ditambahkan');
        return redirect()->to('/user');
    }

    public function profil()
    {
        $nis = session()->get('nis');
        // dd($nis);
        $data = [
            'tittle' => 'Profil',
            'user' =>   $this->userModel->where(['nis' => $nis])->first()
        ];

        return view('/user/profil', $data);
    }

    //--------------------------------------------------------------------

}
