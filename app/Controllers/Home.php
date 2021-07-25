<?php namespace App\Controllers;
use App\Models\TransaksiModel;
use App\Models\GudangModel;
use App\Models\PengajuanModel;
use App\Models\LaporanModel;



class Home extends BaseController
{
	protected $transaksiModel;
	protected $gudangModel;
	protected $pengajuanModel;
	protected $laporanModel;
	
	public function __construct()
  {
    $this->pengajuanModel = new PengajuanModel();
    $this->gudangModel = new GudangModel();
    $this->transaksiModel = new TransaksiModel();
    $this->laporanModel = new LaporanModel();
  }

	public function index()
	{
		$data = [
			'transaksi' => $this->transaksiModel->getTransaksiAll(),
			'orang' => $this->transaksiModel->getDonationCountUser(),
			'gudang' => $this->gudangModel->countGudang(),
			'pengajuan' => $this->laporanModel->getPengajuanLaporan(6)
		];
		return view('index',$data);
	}

	public function daftarKabar()
	{
		$data = [
			'laporan' => $this->laporanModel->getPengajuanLaporanPaginate(6,'laporan'),
			'pengajuan' => $this->pengajuanModel->getPengajuanTerbayarAllPaginate(6,'pengajuan'),
			'pager' => $this->laporanModel->pager,
			'pager2' => $this->pengajuanModel->pager,
		];

		// $data = [
		// 	'laporan' => $this->laporanModel->getPengajuanLaporan(100),
		// 	'pengajuan' => $this->pengajuanModel->getPengajuanTerbayarAll(100),
		// ];

		return view('pages/daftarKabar',$data);
	}

	public function detailKabar($jenis,$id)
	{
		if($jenis == 1){
			$data = [
				'kabar' => $this->laporanModel->getPengajuanLaporanByID($id),
				'jenis' => $jenis
			];
		}else{
			$data = [
				'kabar' => $this->pengajuanModel->getPengajuan($id),
				'jenis' => $jenis
			];
		}
		
		return view('pages/detailKabar',$data);
	}

	//--------------------------------------------------------------------

}
