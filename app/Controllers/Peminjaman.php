<?php

namespace App\Controllers;

use \App\Models\UserModel;
use \App\Models\AlatModel;
use \App\Models\PeminjamanModel;

class Peminjaman extends BaseController
{
    protected $userModel;
    protected $alatModel;
    protected $pModel;
    protected $builder;


    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->alatModel = new AlatModel();
        $this->pModel = new PeminjamanModel();
        $this->builder = $this->pModel->builder();
    }

    public function index()
    {

        $data = [
            'tittle' => 'Peminjaman Alat',
            'alat' => $this->alatModel->findAll(),
            'k_alat' => $this->pModel->where(['user_nis' => session('nis')])->orderBy('id', 'DESC')->findAll()
        ];

        // dd($data['k_alat']);

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

    public function save()
    {
        // dd('hhh');
        $id = $this->request->getVar('id');

        if (!$this->validate([
            'p_jumlah' => 'required'

        ])) {
            $validation =  \Config\Services::validation();

            return redirect()->to('/peminjaman/create/' . $id)->withInput()->with('validation', $validation);
        }

        // cek jumlah alat tersedia
        $js = $this->request->getVar('j_sebelum');
        $ij = $this->request->getVar('p_jumlah');
        if ($js < $ij) {
            session()->setFlashdata('pesan', 'Stok barang tersedia tidak mencukupi');
            return redirect()->to('/peminjaman/create/' . $id);
        }

        // cek input jumlah
        if ($ij <= 0) {
            session()->setFlashdata('pesan', 'Tidak boleh memasukan jumlah barang kurang dari 1');
            return redirect()->to('/peminjaman/create/' . $id);
        }

        $data = [
            'user_nis' => $this->request->getVar('user_nis'),
            'pk_alat' => $this->request->getVar('pk_alat'),
            'pn_alat' => $this->request->getVar('pn_alat'),
            'p_jumlah' => $this->request->getVar('p_jumlah')
        ];

        // dd($this->request->getVar('user_nis'));

        $this->pModel->save($data);
        session()->setFlashdata('p_pesan', 'Alat Berhasil Ditambahkan ke Keranjang');
        return redirect()->to('/peminjaman/index');
    }

    public function delete($id)
    {
        // $data = [
        //     'tittle'
        // ]

        $this->pModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/peminjaman/index');
    }



    //--------------------------------------------------------------------

}
