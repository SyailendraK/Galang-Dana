<?php namespace App\Controllers;
use App\Models\GudangModel;


class Donasi extends BaseController
{

	protected $gudangModel;	

	public function __construct()
  {
    $this->gudangModel = new GudangModel();
	}
	
	public function index()
	{
		return view('pages/donasi');
	}

	public function donasiBarang()
	{
		$data = [
			'gudang' => $this->gudangModel->getGudangAll()
		];
		return view('pages/donasiBarang',$data);
	}

	//--------------------------------------------------------------------

}
