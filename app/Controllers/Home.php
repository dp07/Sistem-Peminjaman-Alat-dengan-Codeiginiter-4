<?php

namespace App\Controllers;

use \App\Models\UserModel;
use \App\Models\AlatModel;

class Home extends BaseController
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

		$jalat = $this->alatModel->countAllResults();
		$juser = $this->userModel->countAllResults();
		$data = [
			'tittle' => 'Dashboard',
			'juser' => $juser,
			'jalat' => $jalat
		];
		return view('/home', $data);
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to('\auth');
	}

	//--------------------------------------------------------------------

}
