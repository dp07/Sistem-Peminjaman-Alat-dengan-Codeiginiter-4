<?php

namespace App\Controllers;

use App\Models\AlatModel;
// use \App\Models\UserModel;

class Alat extends BaseController
{
    protected $alatModel;
    protected $builder;
    public function __construct()
    {
        $this->alatModel = new AlatModel();
        $this->builder = $this->alatModel->builder();
    }

    public function index()

    {
        $data = [
            'tittle' => 'Alat',
            'alat' => $this->alatModel->orderBy('id', 'DESC')->findAll()
        ];

        return view('alat/index', $data);
    }

    public function create()
    {
        session();
        $data = [
            'tittle' => 'Tambah Data Alat',
            'validation' => \Config\Services::validation()
        ];

        return view('alat/create', $data);
    }

    public function save()
    {
        // dd('hhh');

        if (!$this->validate([
            'kalat' => 'required|is_unique[alat.kode_alat]',
            'nalat' => 'required',
            'jumlah' => 'required'
        ])) {
            $validation =  \Config\Services::validation();
            return redirect()->to('/alat/create')->withInput()->with('validation', $validation);
        }

        $data = [
            'kode_alat' => $this->request->getVar('kalat'),
            'nama_alat' => $this->request->getVar('nalat'),
            'jumlah' => $this->request->getVar('jumlah')
        ];


        $this->alatModel->save($data);
        session()->setFlashdata('pesan', 'Data Alat Berhasil Ditambahkan');
        return redirect()->to('/alat/index');
    }

    public function delete($id)
    {
        $this->alatModel->delete($id);
        session()->setFlashdata('pesan', 'Data Alat Berhasil Dihapus');
        return redirect()->to('/alat/index');
    }
}
