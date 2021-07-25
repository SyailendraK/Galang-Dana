<?php namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\VerifikasiModel;
use App\Models\TransaksiModel;
use App\Models\PengajuanModel;
use App\Models\LaporanModel;
use App\Models\GudangModel;
use App\Models\GroupModel;


class DashboardAdmin extends BaseController
{

  protected $usersModel;
  protected $verifikasiModel;
  protected $transaksiModel;
  protected $pengajuanModel;
  protected $laporanModel;
  protected $gudangModel;
  protected $groupModel;

  public function __construct()
  {
    $this->usersModel = new UsersModel();
    $this->verifikasiModel = new VerifikasiModel();
    $this->transaksiModel = new TransaksiModel();
    $this->pengajuanModel = new PengajuanModel();
    $this->laporanModel = new LaporanModel();
    $this->gudangModel = new GudangModel();
    $this->groupModel = new GroupModel();
  }

	public function index()
	{
    $data = [
      'validation' => \Config\Services::validation()
    ];
    return view('dashboard/profile',$data);
  }

  public function editProfile(){
    $data = [
      'validation' => \Config\Services::validation(),
    ];

    $rules = [
			'username'  	=> 'required|alpha_numeric_punct|min_length[3]',
			'alamat'	 	=> 'required',
			'numberTel' 	=> 'required|is_natural',
		];

    if($this->request->getVar('submit') !== null){
      if ($this->validate($rules)){
        $data['username'] = $this->request->getVar('username');
        $data['alamat'] = $this->request->getVar('alamat');
        $data['numberTel'] = $this->request->getVar('numberTel');

        if($this->usersModel->editProfile($data)){
          session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
          Profile berhasil diubah
          </div>');
          return redirect()->to('/dashboardAdmin/editprofile');
        }else{
          session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
          Profile gagal diubah
          </div>');
          return redirect()->to('/dashboardAdmin/editprofile');
        }
      }else{
        return redirect()->to('/dashboardAdmin/editprofile')->withInput();
      }
    }else{
      return view('dashboard/editProfile',$data);
    }
  }

  public function kelolaBankKebaikan()
  {
    $dataTransaksi = $this->transaksiModel->getTransaksiAll();
    $data = [
      'validation' => \Config\Services::validation(),
      'total' => $dataTransaksi
    ];
    return view('dashboard/admin/bankKebaikan',$data);
  }

  public function tambahDana()
  {
    $data = [
      'validation' => \Config\Services::validation(),
    ];

    $rules = [
      'jumlah' => 'required|is_natural',
      'keteranganTambah' => 'required',
      'tgl' => 'required'
    ];

    if ($this->validate($rules)){
      $dana['order_id'] = sprintf("%09d", mt_rand(1, 999999999));
      $dana['id_user'] = user_id();
      $dana['gross_amount'] = $this->request->getPost('jumlah');
      $dana['keterangan'] = $this->request->getPost('keteranganTambah');
      $dana['transaction_time'] = $this->request->getPost('tgl');
      $dana['status_code'] = 200;

      if($this->transaksiModel->insertTransaksi($dana)){
        session()->setFlashdata('tambah', '<div class="alert alert-success" role="alert">
        Dana berhasil ditambah
        </div>');
        return redirect()->to('/dashboardAdmin/kelolaBankKebaikan');
      }else{
        session()->setFlashdata('tambah', '<div class="alert alert-danger" role="alert">
        Dana gagal ditambah
        </div>');
        return redirect()->to('/dashboardAdmin/kelolaBankKebaikan');
      }
    }else{
      return redirect()->to('/dashboardAdmin/kelolaBankKebaikan')->withInput();
    }

  }

  public function keluarDana()
  {
    $data = [
      'validation' => \Config\Services::validation(),
    ];

    $rules = [
      'jumlah' => 'required|is_natural',
      'keteranganKurang' => 'required',
      'tgl' => 'required'
    ];

    if ($this->validate($rules)){
      $dana['order_id'] = sprintf("%09d", mt_rand(1, 999999999));
      $dana['id_user'] = user_id();
      $dana['gross_amount'] = $this->request->getPost('jumlah');
      $dana['keterangan'] = $this->request->getPost('keteranganKurang');
      $dana['transaction_time'] = $this->request->getPost('tgl');
      $dana['status_code'] = 199;

      if($this->transaksiModel->insertTransaksi($dana)){
        session()->setFlashdata('keluar', '<div class="alert alert-success" role="alert">
        Dana berhasil dikeluarkan
        </div>');
        return redirect()->to('/dashboardAdmin/kelolaBankKebaikan');
      }else{
        session()->setFlashdata('keluar', '<div class="alert alert-danger" role="alert">
        Dana gagal dikeluarkan
        </div>');
        return redirect()->to('/dashboardAdmin/kelolaBankKebaikan');
      }
    }else{
      return redirect()->to('/dashboardAdmin/kelolaBankKebaikan')->withInput();
    }
  }

  public function kelolaGudangKebaikan()
  {
    $gudang = $this->gudangModel->getGudangAll();
    $data = [
      'validation' => \Config\Services::validation(),
      'gudang' => $gudang
    ];
    return view('dashboard/admin/gudangKebaikan',$data);
  }

  public function tambahGudang()
  {

    $data = [
      'validation' => \Config\Services::validation()
    ];

    $rules = [
      'nama' => 'required',
      'telp' => 'required|is_natural',
      'provinsi' => 'required',
      'kotkab' => 'required',
      'kecamatan' => 'required',
      'deskel' => 'required',
      'alamat' => 'required'
    ];

    if($this->request->getVar('submit') !== null){
      if ($this->validate($rules)){

        $gudang['nama_pj'] = $this->request->getPost('nama');
        $gudang['telp_pj'] = $this->request->getPost('telp');
        $gudang['alamat'] = $this->request->getPost('alamat');
        $gudang['deskel'] = $this->request->getPost('deskel');
        $gudang['kecamatan'] = $this->request->getPost('kecamatan');
        $gudang['kotkab'] = $this->request->getPost('kotkab');
        $gudang['provinsi'] = $this->request->getPost('provinsi');

        if($this->gudangModel->saveGudang($gudang)){
          session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
          Gudang berhasil ditambahkan
          </div>');
          return redirect()->to('/dashboardAdmin/kelolaGudangKebaikan');
        }else{
          session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
          Gudang gagal ditambahkan
          </div>');
          return redirect()->to('/dashboardAdmin/kelolaGudangKebaikan');
        }
      }else{
        return redirect()->to('/dashboardAdmin/kelolaGudangKebaikan')->withInput();
      }
    }else{
      return view('dashboard/admin/tambahGudang',$data);
    }
  }

  public function hapusGudang($id)
  {
    if($this->gudangModel->hapusGudang($id)){
      session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
          Gudang berhasil dihapus
          </div>');
      return redirect()->to('/dashboardAdmin/kelolaGudangKebaikan');
    }else{
      session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
          Gudang gagal dihapus
          </div>');
      return redirect()->to('/dashboardAdmin/kelolaGudang');
    }
  }

  public function perbaruiGudang($id)
  {
    $data = [
      'validation' => \Config\Services::validation(),
      'gudang' => $this->gudangModel->getGudangByID($id)
    ];

    $rules = [
      'nama' => 'required',
      'telp' => 'required|is_natural',
      'provinsi' => 'required',
      'kotkab' => 'required',
      'kecamatan' => 'required',
      'deskel' => 'required',
      'alamat' => 'required'
    ];

    if($this->request->getVar('submit') !== null){
      if ($this->validate($rules)){

        $gudang['id'] = $id;
        $gudang['nama_pj'] = $this->request->getPost('nama');
        $gudang['telp_pj'] = $this->request->getPost('telp');
        $gudang['alamat'] = $this->request->getPost('alamat');
        $gudang['deskel'] = $this->request->getPost('deskel');
        $gudang['kecamatan'] = $this->request->getPost('kecamatan');
        $gudang['kotkab'] = $this->request->getPost('kotkab');
        $gudang['provinsi'] = $this->request->getPost('provinsi');

        if($this->gudangModel->saveGudang($gudang)){
          session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
          Gudang berhasil diperbarui
          </div>');
          return redirect()->to('/dashboardAdmin/kelolaGudangKebaikan');
        }else{
          session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
          Gudang gagal diperbarui
          </div>');
          return redirect()->to('/dashboardAdmin/kelolaGudangKebaikan');
        }
      }else{
        return redirect()->to('/dashboardAdmin/kelolaGudangKebaikan')->withInput();
      }
    }else{
      return view('dashboard/admin/perbaruiGudang',$data);
    }
  }

  public function daftarVerifikasi()
  {
    $data=[];
    $dataPengajuanVerif = $this->request->getGet('search-pengajuanverif');
    $dataVerified = $this->request->getGet('search-verified');
    if($dataPengajuanVerif != '' && $dataVerified == ''){
      $data = [
        'validation' => \Config\Services::validation(),
        'verifikasi' => $this->verifikasiModel->cariPengajuanVerif($dataPengajuanVerif),
        'unverif' => $this->verifikasiModel->getVerified()
      ];
    }elseif($dataPengajuanVerif == '' && $dataVerified != ''){
      $data = [
        'validation' => \Config\Services::validation(),
        'verifikasi' => $this->verifikasiModel->getVerifikasiAll(),
        'unverif' => $this->verifikasiModel->cariVerified($dataVerified)
      ];
    }else{
      $data = [
        'validation' => \Config\Services::validation(),
        'verifikasi' => $this->verifikasiModel->getVerifikasiAll(),
        'unverif' => $this->verifikasiModel->getVerified()
      ];
    }
    return view('dashboard/admin/verifikasiMember',$data);
  }

  public function detailVerifikasi($id)
  {
    $data = [
      'validation' => \Config\Services::validation(),
      'verifikasi' => $this->verifikasiModel->getVerifikasiByID($id)
    ];
    return view('dashboard/admin/terverifikasi',$data);
  }

  public function verifikasi($nik,$id)
  {
    if($this->verifikasiModel->verifikasiMember($nik) && $this->usersModel->updateStatus($id,2)){
      session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
          Member berhasil terverifikasi
          </div>');
      return redirect()->to('/dashboardAdmin/daftarVerifikasi');
    }else{
      session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
          Member gagal terverifikasi
          </div>');
      return redirect()->to('/dashboardAdmin/daftarVerifikasi');
    }
  }

  public function tolakVerifikasi($nik,$id)
  {
    if($this->verifikasiModel->tolakVerifikasiMember($nik) && $this->usersModel->updateStatus($id,3)){
      session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
          Verifikasi berhasil ditolak
          </div>');
      return redirect()->to('/dashboardAdmin/daftarVerifikasi');
    }else{
      session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
          Verifikasi gagal ditolak
          </div>');
      return redirect()->to('/dashboardAdmin/daftarVerifikasi');
    }
  }

  // private function _cariVerifikasi($nik)
  // {
  //   $result = ;
  //   if($result != null){
  //     return $result;
  //   }else{
  //     return null;
  //   }
  // }

  public function unVerifikasi($nik,$id)
  {
    $dataLama = $this->verifikasiModel->getVerifikasiByID($nik);
    if($this->verifikasiModel->unVerifikasiMember($nik) && $this->usersModel->updateStatus($id,0)){
      unlink('img/ktp/'.$dataLama['ktp']);
      unlink('img/ktp/'.$dataLama['ktpdiri']);
      session()->setFlashdata('unverif', '<div class="alert alert-success" role="alert">
          Member berhasil un-verifikasi
          </div>');
      return redirect()->to('/dashboardAdmin/daftarVerifikasi');
    }else{
      session()->setFlashdata('unverif', '<div class="alert alert-danger" role="alert">
          Member gagal un-verifikasi
          </div>');
      return redirect()->to('/dashboardAdmin/daftarVerifikasi');
    }
  }

  public function kelolaPengajuan()
  {
    $pembayaran = $this->request->getVar('search-pembayaran');
    $pengajuan = $this->request->getVar('search-pengajuan');
    if($pembayaran != '' && $pengajuan == ''){
      $data = [
        'validation' => \Config\Services::validation(),
        'pengajuan' => $this->pengajuanModel->getNewPengajuan(),
        'bayar' => $this->pengajuanModel->searchPembayaran($pembayaran)
      ];
    }elseif($pembayaran == '' && $pengajuan != ''){
      $data = [
        'validation' => \Config\Services::validation(),
        'pengajuan' => $this->pengajuanModel->searchPengajuan($pengajuan),
        'bayar' =>  $this->pengajuanModel->getConfirmPengajuan()
      ];
    }else{
      $data = [
        'validation' => \Config\Services::validation(),
        'pengajuan' => $this->pengajuanModel->getNewPengajuan(),
        'bayar' => $this->pengajuanModel->getConfirmPengajuan()
      ];
    }
    return view('dashboard/admin/kelolaPengajuan',$data);
  }

  public function detailPengajuan($id)
  {
    if($this->pengajuanModel->updatePengajuanStatus($id,4)){
      $data = [
        'validation' => \Config\Services::validation(),
        'pengajuan' => $this->pengajuanModel->getPengajuan($id)
      ];
      return view('dashboard/admin/detailPengajuan',$data);
    }
  }

  public function terimaPengajuan($id)
  {
    if($this->pengajuanModel->updatePengajuanStatus($id,1)){
      session()->setFlashdata('pengajuan', '<div class="alert alert-success" role="alert">
          Pengajuan berhasil diterima
          </div>');
      return redirect()->to('/dashboardAdmin/kelolaPengajuan');
    }else{
      session()->setFlashdata('pengajuan', '<div class="alert alert-danger" role="alert">
          Pengajuan gagal diterima
          </div>');
      return redirect()->to('/dashboardAdmin/kelolaPengajuan');
    }
  }

  public function tolakPengajuan($id)
  {
    if($this->pengajuanModel->updatePengajuanStatus($id,3)){
      session()->setFlashdata('pengajuan', '<div class="alert alert-success" role="alert">
          Pengajuan berhasil ditolak
          </div>');
      return redirect()->to('/dashboardAdmin/kelolaPengajuan');
    }else{
      session()->setFlashdata('pengajuan', '<div class="alert alert-danger" role="alert">
          Pengajuan gagal ditolak
          </div>');
      return redirect()->to('/dashboardAdmin/kelolaPengajuan');
    }
  }

  public function detailPembayaran($id)
  {
    $data = [
      'validation' => \Config\Services::validation(),
      'pengajuan' => $this->pengajuanModel->getPengajuan($id)
    ];
    return view('dashboard/admin/detailPembayaran',$data);
  }

  public function konfirmasiPembayaran($id)
  {
    if($this->pengajuanModel->updatePengajuanStatus($id,2)){
      session()->setFlashdata('bayar', '<div class="alert alert-success" role="alert">
          Pembayaran berhasil dikonfirmasi
          </div>');
      return redirect()->to('/dashboardAdmin/kelolaPengajuan');
    }else{
      session()->setFlashdata('bayar', '<div class="alert alert-danger" role="alert">
          Pembayaran gagal dikonfirmasi
          </div>');
      return redirect()->to('/dashboardAdmin/kelolaPengajuan');
    }
  }

  public function laporan()
  {
    $data=[];
    $dateStart = $this->request->getVar('dateStart');
    $dateEnd = $this->request->getVar('dateEnd');

    $data = [
      'validation' => \Config\Services::validation(),
      'transaksi' => $this->transaksiModel->getTransaksiByTime($dateStart,$dateEnd),
      'start' => $dateStart,
      'end' => $dateEnd
    ];

    return view('dashboard/admin/laporan',$data);
  }

  public function printLaporan($dateStart = null,$dateEnd = null)
  {
    if($dateStart != null && $dateEnd != null){
      $data = [
        'transaksi' => $this->transaksiModel->getTransaksiByTime($dateStart,$dateEnd),
      ];
    }elseif($dateStart != null && $dateEnd == null){
      $data = [
        'transaksi' => $this->transaksiModel->getTransaksiByTime($dateStart,date("Y-m-d")),
      ];
    }elseif($dateStart == null && $dateEnd != null){
      $data = [
        'transaksi' => $this->transaksiModel->getTransaksiByTime('2000-01-01',$dateEnd),
      ];
    }else{
      $data = [
        'transaksi' => $this->transaksiModel->getTransaksiAll(),
      ];
    }
    
    return view('dashboard/admin/printLaporan',$data);
  }

  public function userList()
  {

    $data=[];
    if($this->request->getVar('submit') !== null){
      $email = $this->request->getGet('search');
      $data = [
        'validation' => \Config\Services::validation(),
        'users' => $this->usersModel->getUsersByEmail($email),
      ];
    }else{
      $data = [
        'validation' => \Config\Services::validation(),
        'users' => $this->usersModel->getUsersAll(),
      ];
    }

    return view('dashboard/admin/userList',$data);
  }

  public function matikanAkun($id)
  {
    if($this->usersModel->matikanAkun($id)){
      $pengajuan = $this->pengajuanModel->getBantuanByIDUser($id);
      if($pengajuan != null){
        foreach($pengajuan as $i){
          $this->pengajuanModel->updatePengajuanStatus($i['id'],3);
        }
        session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
        Akun berhasil nonaktifkan
        </div>');
        return redirect()->to('/dashboardAdmin/userList');
      }else{
        session()->setFlashdata('pesan', '<div class="alert alert-warning" role="alert">
        Akun berhasil dihapus, gagal menghapus atau tidak ditemukan pengajuan aktif
        </div>');
        return redirect()->to('/dashboardAdmin/userList');
      }
    }else{
      session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
          Akun gagal nonaktifkan
          </div>');
          return redirect()->to('/dashboardAdmin/userList');
    }
  }

  public function updateRole($id,$role,$upDown)
  {
    $roleNow = 0;
    if($upDown){
      if($role == 'member'){
        $roleNow = 2;
      }else{
        $roleNow = 3;
      }
    }else{
      if($role == 'admin'){
        $roleNow = 1;
      }else{
        $roleNow = 2;
      }
    }
    
    if($this->groupModel->updateRole($id,$roleNow)){
      session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
        Role akun berhasil diubah
        </div>');
        return redirect()->to('/dashboardAdmin/userList');
    }else{
      session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
        Role akun gagal diubah
        </div>');
        return redirect()->to('/dashboardAdmin/userList');
    }
  }

  public function laporanBantuan()
  {
    $data=[];
    if($this->request->getVar('submit') !== null){
      $name = $this->request->getGet('search');
      $data = [
        'validation' => \Config\Services::validation(),
        'laporan' => $this->laporanModel->searchLaporan($name)
      ];
    }else{
      $data = [
        'validation' => \Config\Services::validation(),
        'laporan' => $this->laporanModel->getPengajuanLaporan(6)
      ];
    }
    
		return view('dashboard/admin/laporanBantuan',$data);
  }

  public function hapusLaporanBantuan($idLaporan,$pembelian,$barang)
  {
    try {
      if($this->laporanModel->hapusLaporan($idLaporan)){
      unlink('img/bukti_laporan/'.$pembelian);
      unlink('img/bukti_laporan/'.$barang);
      session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
          Laporan berhasil dihapus
          </div>');
      }else{
        session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
          Laporan gagal dihapus
          </div>');
      }
      return redirect()->to('/dashboardAdmin/laporanBantuan');
    }catch (\Throwable $th) {
      session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
          Laporan gagal dihapus
          </div>');
      return redirect()->to('/dashboardAdmin/laporanBantuan');
    }
  }

}