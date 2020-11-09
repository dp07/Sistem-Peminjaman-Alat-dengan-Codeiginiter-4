<?php

namespace App\Controllers;

use \App\Models\UserModel;
use \App\Models\AlatModel;
use \App\Models\PeminjamanModel;
use \App\Models\PengembalianModel;
use CodeIgniter\Database\Query;

class Pengembalian extends BaseController
{
    protected $userModel;
    protected $alatModel;
    protected $pModel;
    protected $pengembalianModel;
    protected $db;
    protected $builder;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->alatModel = new AlatModel();
        $this->pModel = new PeminjamanModel();
        $this->pengembalianModel = new PengembalianModel();
        $this->db = \Config\Database::connect();
        $this->builder = $this->pengembalianModel->builder();
    }

    public function index()
    {
        // cek level 
        if (session('level') == 1) {
            $data = [
                'tittle' => 'Pengembalian Alat',
                'alat' => $this->builder->select('nis_user , user_nama ,no_hp')->distinct()->findAll()
                // 'k_alat' => $this->pengembalianModel->where(['user_nis' => session('nis')])->findAll()
            ];
            // dd($data);
            return view('/pengembalian/index', $data);
        } else {
            $data = [
                'tittle' => 'Pengembalian Alat',
                // 'alat' => $this->pengembalianModel->findAll()
                'alat' => $this->pengembalianModel->where(['nis_user' => session('nis')])->findAll()
            ];
            return view('/pengembalian/detailpinjam', $data);
        }
    }

    public function detailpinjam($nis)
    {
        $data = [
            'tittle' => 'Pengembalian Alat',
            // 'alat' => $this->builder->select('nis_user , user_nama ,no_hp')->distinct()->findAll()
            'alat' => $this->pengembalianModel->where(['nis_user' => $nis])->findAll()
        ];

        return view('/pengembalian/detailpinjam', $data);
    }

    public function save($id)
    {
        $alat = $this->pModel->asArray()->where(['id' => $id])->findAll();
        $user = $this->userModel->asArray()->where(['nis' => session('nis')])->findAll();

        // dd($user[0]['hp']);
        $data = [
            'nis_user' => $alat[0]['user_nis'],
            'user_nama' => session('nama'),
            'no_hp' => $user[0]['hp'],
            'detail' => $alat[0]['pn_alat'],
            'jumlah_p' => $alat[0]['p_jumlah'],
            'kode_alat_p' => $alat[0]['pk_alat'],
            'pesan' => 'ambil alat yang dipesan',
            'status' => 'sedang dipinjam'

        ];
        // cek jumlah stok
        $jAlat = $this->alatModel->where('kode_alat', $alat[0]['pk_alat'])->findAll();
        // dd($jAlat);

        if ($alat[0]['p_jumlah'] > $jAlat[0]['jumlah']) {
            session()->setFlashdata('pesan', 'Jumlah stok barang tersedia tidak mencukupi!!!');
            return redirect()->to('/peminjaman/create/' . $id);
        }

        // dd($data['nis_user']);

        $this->pengembalianModel->save($data);

        // update jumlah stok
        $jumlah = $jAlat[0]['jumlah'] - $alat[0]['p_jumlah'];
        // dd($jumlah);
        $data = [
            'jumlah' => $jumlah
        ];

        $jid = ($jAlat[0]['id']);
        $this->alatModel->update($jid, $data);
        // dd($jumlah);
        session()->setFlashdata('p_pesan', 'Proses berhasil, silahkan ambil alat yang dipesan');
        // hapus data pada keranjang
        $this->pModel->delete($id);

        return redirect()->to('/pengembalian/index');
    }

    public function proses($id)
    {
        $status = $this->pengembalianModel->where(['id' => $id])->first();
        // dd($status['status']);
        $data = [
            'status' => 'proses pengembalian',
            'pesan' => 'menunggu validasi operator'
        ];
        $this->pengembalianModel->update($id, $data);
        session()->setFlashdata('p_pesan', 'Proses berhasil, menunggu validasi operator');
        return redirect()->to('/pengembalian/index');
    }

    public function tolak($id)
    {
        $data = [
            'status' => 'proses ditolak',
            'pesan' => 'alat tidak lengkap, alat rusak, dll.'
        ];
        $this->pengembalianModel->update($id, $data);
        session()->setFlashdata('p_pesan', 'Proses berhasil');
        return redirect()->to('/pengembalian/index');
    }

    public function getJumlah($id, $data)
    {

        $this->alatModel->update($id, $data);
    }

    public function validasi($id, $jumlah)
    {
        $jPinjam = $this->pengembalianModel->where(['id' => $id])->first();
        $alat = $this->alatModel->where(['kode_alat' => $jPinjam['kode_alat_p']])->first();
        $jAlat = $this->alatModel->where(['kode_alat' => $alat['kode_alat']])->first();

        $query = $this->db->query(" SELECT kode_alat, jumlah, jumlah_p FROM alat INNER JOIN pengembalian ON pengembalian.kode_alat_p = alat.kode_alat")->getResultArray($id);
        // dd($jumlah);
        // tambahkan jumlah
        $j = $query[0]['jumlah'];
        $p = $query[0]['jumlah_p'];
        $jumlah =  $j + $jumlah;

        // dd($jumlah);

        $data = [
            'jumlah' => $jumlah
        ];

        // dd($data);

        $this->getJumlah($jAlat['id'], $data);

        $this->pengembalianModel->delete($id);
        session()->setFlashdata('p_pesan', 'Proses validasi berhasil');
        return redirect()->to('/pengembalian/index');
    }
}
