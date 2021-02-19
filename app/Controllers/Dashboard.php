<?php namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\VerifikasiModel;
use App\Models\TransaksiModel;
use App\Models\PengajuanModel;
use App\Models\LaporanModel;



class Dashboard extends BaseController
{

  protected $usersModel;
  protected $verifikasiModel;
  protected $transaksiModel;
  protected $pengajuanModel;
  protected $laporanModel;


  public function __construct()
  {
    $this->usersModel = new UsersModel();
    $this->verifikasiModel = new VerifikasiModel();
    $this->transaksiModel = new TransaksiModel();
    $this->pengajuanModel = new PengajuanModel();
    $this->laporanModel = new LaporanModel();
  }

	public function index()
	{
    $dataTransaksi = $this->transaksiModel->getTransaksiByUserID(user_id());
    $dataPengeluaran = $this->transaksiModel->getTransaksiPengeluaranUser(user_id());
    $count = $this->transaksiModel->getDonationCountUser();
    $data = [
      'validation' => \Config\Services::validation(),
      'total' => $dataTransaksi,
      'pengeluaran' => $dataPengeluaran,
      'count' => $count
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
          return redirect()->to('/dashboard/editprofile');
        }else{
          session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
          Profile gagal diubah
          </div>');
          return redirect()->to('/dashboard/editprofile');
        }
      }else{
        return redirect()->to('/dashboard/editprofile')->withInput();
      }
    }else{
      return view('dashboard/editProfile',$data);
    }
  }

  public function ubahPassword()
  {
      // 'email'			=> [
			// 	'rules'=>'required|valid_email|is_unique[users.email]',
			// 	'errors' => ['is_unique' => '{field} already taken']
			// ],
    $rules = [
			'passLama'  	=> 'required',
			'passBaru'	 	=> 'required|strong_password',
			'passBaruRe' 	=> 'required|matches[passBaru]',
		];

		if ($this->validate($rules)){
      $data['passBaru'] = $this->request->getVar('passBaru');
      $data['passBaruRe'] = $this->request->getVar('passBaruRe');
      $data['passLama'] = $this->request->getVar('passLama');
      
      if($this->usersModel->ubahPassword($data)){
        session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
        Password berhasil diubah
        </div>');
        return redirect()->to('/dashboard');
      }else{
        session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
        Password gagal diubah
        </div>');
        return redirect()->to('/dashboard');
      }
		}else{
      return redirect()->to('/dashboard')->withInput();
    }
  }

  private function _cekNIK($nik,$nama)
  {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,'https://api.binderbyte.com/v1/validation/ktp?api_key=d31fccc0a925755e8627dba1e158382f31f4357769bbfc599abcb62c61820e1a');
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl, CURLOPT_POST, true);
    $data = [
      'nik' => $nik,
      'name' => $nama
    ];
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $result = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($result,true);
    if($result['status'] == 'FOUND' && $result['name_match'] == 'true'){
      return true;
    }else{
      return true;
    }
  }

  public function verifikasi()
  {
    if(user()->status != 0 || user()->address == null || user()->telephone == null){
      echo "Access Denied";
      die;
    }else{
      $data = [
        'validation' => \Config\Services::validation(),
      ];
      
      $rules = [
        'nama' => 'required',
        'nik' => [
          'rules' => 'required|is_unique[verifikasi.nik]|is_natural',
          'errors' => [
            'is_unique' => 'NIK ini sudah terdaftar untuk akun lain',
          ]
        ],
        'ktp' => [
          'rules' => 'max_size[ktp,1024]|is_image[ktp]|mime_in[ktp,image/jpg,image/jpeg,image/png]',
          'errors' => [
            'max_size' => 'Ukuran gambar terlalu besar max 1MB',
            'is_image' => 'yang anda pilih bukan gambar',
            'mime_in' => 'yang anda pilih bukan gambar'
          ]
        ],
        'ktpdiri' => [
          'rules' => 'max_size[ktpdiri,1024]|is_image[ktpdiri]|mime_in[ktpdiri,image/jpg,image/jpeg,image/png]',
          'errors' => [
            'max_size' => 'Ukuran gambar terlalu besar max 1MB',
            'is_image' => 'yang anda pilih bukan gambar',
            'mime_in' => 'yang anda pilih bukan gambar'
          ]
        ]
      ];

      if($this->request->getVar('submit') !== null){
        if ($this->validate($rules)){
          
          $fileKtp = $this->request->getFile('ktp');
          $fileKtpDiri = $this->request->getFile('ktpdiri');

          $data['nama'] = $this->request->getPost('nama');
          $data['nik'] = $this->request->getPost('nik');
          $data['ktp'] = $fileKtp->getRandomName();
          $data['ktpDiri'] = $fileKtpDiri->getRandomName();

          $cekData = $this->verifikasiModel->getVerifikasiByID(user()->id);
          $stat=false;
          if($cekData != null){
            $stat=true;
          }


          // if($this->_cekNIK($data['nik'],$data['nama'])){
            if($this->verifikasiModel->verifikasi($data,$stat) && $this->usersModel->updateStatus(user()->id, 1)){
              if($stat){
                $fileKtp->move('img/ktp', $data['ktp']);
                $fileKtpDiri->move('img/ktp', $data['ktpDiri']);
                unlink('img/ktp/'.$cekData['ktp']);
                unlink('img/ktp/'.$cekData['ktpdiri']);
              }else{
                $fileKtp->move('img/ktp', $data['ktp']);
                $fileKtpDiri->move('img/ktp', $data['ktpDiri']);
              }
              
              session()->setFlashdata('ktp', '<div class="alert alert-success" role="alert">
              Data berhasil dikirim, harap menunggu proses verifikasi
              </div>');
              return redirect()->to('/dashboard');
            }else{
              session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
              Data gagal dikirim
              </div>');
              return redirect()->to('/dashboard/verifikasi');
            }
          // }else{
          //   session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
          //     Data NIK tersebut tidak ditemukan
          //     </div>');
          //     return redirect()->to('/dashboard/verifikasi');
          // }
        }else{
          return redirect()->to('/dashboard/verifikasi')->withInput();
        }
      }else{
        return view('dashboard/member/verifikasi',$data);
      }
    }
  }

  public function pengajuanBantuan()
  {
    $data = [
      'bank' => json_decode($this->pengajuanModel::$bank,true),
      'validation' => \Config\Services::validation(),
    ];

    $rules = [
      'cerita' => 'required',
      'siapa' => 'required',
      'nama' => 'required',
      'nik' => 'required',
      'nomorHP' => 'required|is_natural',
      'email' => 'required|valid_email',
      'alamat' => 'required',
      'bank' => 'required',
      'rekening' => 'required|is_natural',
      'jumlah' => 'required|is_natural',
      'fotoDiri' => [
        'rules' => 'max_size[fotoDiri,1024]|is_image[fotoDiri]|mime_in[fotoDiri,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'Ukuran gambar terlalu besar max 1MB',
          'is_image' => 'yang anda pilih bukan gambar',
          'mime_in' => 'yang anda pilih bukan gambar'
        ]
      ],
    ];

    if($this->request->getVar('submit') !== null){
      if ($this->validate($rules)){
        $fileFoto = $this->request->getFile('fotoDiri');

        $dataBantuan['user_id'] = user_id();
        $dataBantuan['cerita'] = $this->request->getPost('cerita');
        $dataBantuan['siapa'] = $this->request->getPost('siapa');
        $dataBantuan['nama'] = $this->request->getPost('nama');
        $dataBantuan['nik'] = $this->request->getPost('nik');
        $dataBantuan['nomorHP'] = $this->request->getPost('nomorHP');
        $dataBantuan['email'] = $this->request->getPost('email');
        $dataBantuan['alamat'] = $this->request->getPost('alamat');
        $dataBantuan['bank'] = $this->request->getPost('bank');
        $dataBantuan['rekening'] = $this->request->getPost('rekening');
        $dataBantuan['jumlah'] = $this->request->getPost('jumlah');
        $dataBantuan['fotoDiri'] = $fileFoto->getRandomName();

        if($this->pengajuanModel->pengajuanBantuan($dataBantuan)){

          $fileFoto->move('img/fotodiri', $dataBantuan['fotoDiri']);

          session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
          Data berhasil dikirim, harap menunggu proses pengajuan
          </div>');
          return redirect()->to('/dashboard/statusPengajuan');
        }else{
          session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
          Data gagal dikirim
          </div>');
          return redirect()->to('/dashboard/statusPengajuan');
        }
      }else{
        return redirect()->to('/dashboard/pengajuanBantuan')->withInput();
      }
    }else{
      return view('dashboard/member/pengajuanBantuan',$data);
    }
  }

  public function perbaruiPengajuan($id)
  {
    $dataLama = $this->pengajuanModel->getPengajuan($id);

    if($dataLama['user_id'] != user_id() || $dataLama['status'] != 0){
      echo "Access Denied";
      die;
    }else{

      $data = [
        'validation' => \Config\Services::validation(),
        'pengajuan' => $dataLama,
        'bank' => json_decode($this->pengajuanModel::$bank,true),
      ];

      $rules = [
        'cerita' => 'required',
        'siapa' => 'required',
        'nama' => 'required',
        'nik' => 'required',
        'nomorHP' => 'required|is_natural',
        'email' => 'required|valid_email',
        'alamat' => 'required',
        'bank' => 'required',
        'rekening' => 'required|is_natural',
        'jumlah' => 'required|is_natural',
        'fotoDiri' => [
          'rules' => 'max_size[fotoDiri,1024]|is_image[fotoDiri]|mime_in[fotoDiri,image/jpg,image/jpeg,image/png]',
          'errors' => [
            'max_size' => 'Ukuran gambar terlalu besar max 1MB',
            'is_image' => 'yang anda pilih bukan gambar',
            'mime_in' => 'yang anda pilih bukan gambar'
          ]
        ],
      ];

      if($this->request->getVar('submit') !== null){
        if ($this->validate($rules)){
          $fileFoto = $this->request->getFile('fotoDiri');

          $dataBantuan['id'] = $id;
          $dataBantuan['user_id'] = user_id();
          $dataBantuan['cerita'] = $this->request->getPost('cerita');
          $dataBantuan['siapa'] = $this->request->getPost('siapa');
          $dataBantuan['nama'] = $this->request->getPost('nama');
          $dataBantuan['nik'] = $this->request->getPost('nik');
          $dataBantuan['nomorHP'] = $this->request->getPost('nomorHP');
          $dataBantuan['email'] = $this->request->getPost('email');
          $dataBantuan['alamat'] = $this->request->getPost('alamat');
          $dataBantuan['bank'] = $this->request->getPost('bank');
          $dataBantuan['rekening'] = $this->request->getPost('rekening');
          $dataBantuan['jumlah'] = $this->request->getPost('jumlah');
          if($fileFoto->getSize() != 0){
            $dataBantuan['fotoDiri'] = $fileFoto->getRandomName();
          }

          if($this->pengajuanModel->pengajuanBantuan($dataBantuan) && $this->pengajuanModel->updatePengajuanStatus($id,0)){
            if($fileFoto->getSize() != 0){
              $fileFoto->move('img/fotodiri', $dataBantuan['fotoDiri']);
              unlink('img/fotodiri/'.$dataLama['fotoDiri']);
            }
            session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
            Data berhasil diperbarui, harap menunggu proses pengajuan
            </div>');
            return redirect()->to('/dashboard/perbaruiPengajuan/'.$id);
          }else{
            session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
            Data gagal diperbarui
            </div>');
            return redirect()->to('/dashboard/perbaruiPengajuan/'.$id);
          }
        }else{
          return redirect()->to('/dashboard/perbaruiPengajuan/'.$id)->withInput();
        }
      }else{
        return view('dashboard/member/perbaruiPengajuan',$data);
      }
    }
  }

  public function hapusPengajuan($id,$foto)
  {

    $dataLama = $this->pengajuanModel->getPengajuan($id);

    if($dataLama['user_id'] != user_id() || $dataLama['status'] != 0){
      echo "Access Denied";
      die;
    }else{
      try {
        $this->pengajuanModel->hapusPengajuan($id);
        unlink('img/fotodiri/'.$foto);
        session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
            Pengajuan berhasil dihapus
            </div>');
        return redirect()->to('/dashboard/statusPengajuan');
      } catch (\Throwable $th) {
        session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
            Pengajuan gagal dihapus
            </div>');
        return redirect()->to('/dashboard/statusPengajuan');
      }
    }

  }

  public function statusPengajuan()
  {
    if(user()->status != 2 || user()->address == null || user()->telephone == null){
      session()->setFlashdata('pesan', '<div class="alert alert-warning" role="alert">
          Harap melengkapi detail profile terlebih dahulu, sebelum mengakses halaman Pengajuan Bantuan
          </div>');
      return redirect()->to('/dashboard/editprofile');
    }else{
      $data['status'] = $this->pengajuanModel->cariBantuanByUser();
      return view('dashboard/member/statusPengajuan',$data);
    }
  }

  public function pelaporanBantuan()
  {
    if(user()->status != 2 || user()->address == null || user()->telephone == null){
      session()->setFlashdata('pesan', '<div class="alert alert-warning" role="alert">
          Harap melengkapi detail profile terlebih dahulu, sebelum mengakses halaman Pelaporan Bantuan
          </div>');
      return redirect()->to('/dashboard/editprofile');
    }else{
      $status = $this->pengajuanModel->cariBantuanByUserTerbayar();
      $no=0;
      $laporan = [];
      foreach($status as $i){
        $temp=0;
        foreach($this->laporanModel->getLaporanByUserID($i['id']) as $j){
          $temp += $j['jumlah'];
        }
        $laporan[$no] = $temp;
        $no++;
      }
      // $laporan = $this->laporanModel->getLaporanByUserID($id)
      $data = [
        'status' => $status,
        'terlaporkan' => $laporan
      ];
      return view('dashboard/member/pelaporanBantuan',$data);
    }
  }

  public function daftarLaporan($id)
  {
    $dataLama = $this->pengajuanModel->getPengajuan($id);

    if($dataLama['user_id'] != user_id() || $dataLama['status'] == 0){
      echo "Access Denied";
      die;
    }else{
      $data =[
        'id' => $id,
        'laporan' => $this->laporanModel->getLaporanByUserID($id),
        'pengajuan' => $this->pengajuanModel->getPengajuan($id)
      ];
      return view('dashboard/member/daftarPelaporan',$data);
    }
  }

  public function tambahLaporan($id)
  {
    $data = [
      'validation' => \Config\Services::validation(),
      'id' => $id,
    ];

    $temp = 0;

    $laporan = $this->laporanModel->getLaporanByUserID($id);
    foreach($laporan as $i){
      $temp += (int) $i['jumlah'];
    }
    $pengajuan = $this->pengajuanModel->getPengajuan($id);

    $inputJumlah = $this->request->getPost('jumlah');
    $cekJumlah = (int) $pengajuan['jumlah'] - $temp;

    $rules = [
      'cerita' => 'required',
      'jumlah' => 'required|is_natural',
      'pembelian' => [
        'rules' => 'max_size[pembelian,1024]|is_image[pembelian]|mime_in[pembelian,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'Ukuran gambar terlalu besar max 1MB',
          'is_image' => 'yang anda pilih bukan gambar',
          'mime_in' => 'yang anda pilih bukan gambar'
        ]
      ],
      'barang' => [
        'rules' => 'max_size[barang,1024]|is_image[barang]|mime_in[barang,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'Ukuran gambar terlalu besar max 1MB',
          'is_image' => 'yang anda pilih bukan gambar',
          'mime_in' => 'yang anda pilih bukan gambar'
        ]
      ],
    ];

    if($this->request->getVar('submit') !== null){
      if ($this->validate($rules)){
        $filePembelian = $this->request->getFile('pembelian');
        $fileBarang = $this->request->getFile('barang');

        $dataBantuan['user_id'] = user_id();
        $dataBantuan['bantuan_id'] = $id;
        $dataBantuan['cerita'] = $this->request->getPost('cerita');
        $dataBantuan['jumlah'] = $this->request->getPost('jumlah');
        $dataBantuan['pembelian'] = $filePembelian->getRandomName();
        $dataBantuan['barang'] = $fileBarang->getRandomName();
        if($inputJumlah <= $cekJumlah){
          if($this->laporanModel->tambahLaporan($dataBantuan)){
            $filePembelian->move('img/bukti_laporan', $dataBantuan['pembelian']);
            $fileBarang->move('img/bukti_laporan', $dataBantuan['barang']);

            session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
            Laporan berhasil ditambahkan
            </div>');
            return redirect()->to('/dashboard/daftarLaporan/'.$id);
          }else{
            session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
            Laporan gagal ditambahkan
            </div>');
            return redirect()->to('/dashboard/daftarLaporan/'.$id);
          }
        }else{
          session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
            Jumlah dana melebihi pengajuan
            </div>');
            return redirect()->to('/dashboard/daftarLaporan/'.$id);
        }
      }else{
        return redirect()->to('/dashboard/daftarLaporan/'.$id)->withInput();
      }
    }else{
      return view('dashboard/member/tambahLaporan',$data);
    }
  }

  public function hapusLaporan($idLaporan,$idPengajuan,$pembelian,$barang)
  {
    $dataLama['pengajuan'] = $this->pengajuanModel->getPengajuan($idPengajuan);
    $dataLama['laporan'] = $this->laporanModel->getPengajuanLaporanByID($idLaporan);

    if($dataLama['laporan']['user_id'] != user_id() || $dataLama['pengajuan']['user_id'] != user_id() || $dataLama['pengajuan']['status'] == 0){
      echo "Access Denied";
      die;
    }else{
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
        return redirect()->to('/dashboard/daftarLaporan/'.$idPengajuan);
      } catch (\Throwable $th) {
        session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
            Laporan gagal dihapus
            </div>');
        return redirect()->to('/dashboard/daftarLaporan/'.$idPengajuan);
      }
    }
  }

  public function perbaruiLaporan($idLaporan, $idPengajuan)
  {
    $dataLama['pengajuan'] = $this->pengajuanModel->getPengajuan($idPengajuan);
    $dataLama['laporan'] = $this->laporanModel->getPengajuanLaporanByID($idLaporan);

    if($dataLama['laporan']['user_id'] != user_id() || $dataLama['pengajuan']['user_id'] != user_id() || $dataLama['pengajuan']['status'] == 0){
      echo "Access Denied";
      die;
    }else{
      $data = [
        'validation' => \Config\Services::validation(),
        'laporan' => $this->laporanModel->getLaporanByID($idLaporan),
        'id' => $idLaporan,
        'idPengajuan' => $idPengajuan
      ];

      $temp = 0;

      $laporan = $this->laporanModel->getLaporanByUserID($idPengajuan);
      foreach($laporan as $i){
        $temp += (int) $i['jumlah'];
      }
      $pengajuan = $this->pengajuanModel->getPengajuan($idPengajuan);

      $inputJumlah = $this->request->getPost('jumlah');
      $cekJumlah = (int) $pengajuan['jumlah'] - $temp + $data['laporan']['jumlah'];

      $rules = [
        'cerita' => 'required',
        'jumlah' => 'required|is_natural',
        'pembelian' => [
          'rules' => 'max_size[pembelian,1024]|is_image[pembelian]|mime_in[pembelian,image/jpg,image/jpeg,image/png]',
          'errors' => [
            'max_size' => 'Ukuran gambar terlalu besar max 1MB',
            'is_image' => 'yang anda pilih bukan gambar',
            'mime_in' => 'yang anda pilih bukan gambar'
          ]
        ],
        'barang' => [
          'rules' => 'max_size[barang,1024]|is_image[barang]|mime_in[barang,image/jpg,image/jpeg,image/png]',
          'errors' => [
            'max_size' => 'Ukuran gambar terlalu besar max 1MB',
            'is_image' => 'yang anda pilih bukan gambar',
            'mime_in' => 'yang anda pilih bukan gambar'
          ]
        ],
      ];

      if($this->request->getVar('submit') !== null){
        if($inputJumlah <= $cekJumlah){
          if ($this->validate($rules)){
            $filePembelian = $this->request->getFile('pembelian');
            $fileBarang = $this->request->getFile('barang');

            $dataBantuan['id'] = $idLaporan;
            $dataBantuan['cerita'] = $this->request->getPost('cerita');
            $dataBantuan['jumlah'] = $this->request->getPost('jumlah');
            if($filePembelian->getSize() != 0){
              $dataBantuan['pembelian'] = $filePembelian->getRandomName();
            }
            if($fileBarang->getSize() != 0){
              $dataBantuan['barang'] = $fileBarang->getRandomName();
            }

            if($this->laporanModel->tambahLaporan($dataBantuan)){

              if($filePembelian->getSize() != 0){
                $filePembelian->move('img/bukti_laporan', $dataBantuan['pembelian']);
                unlink('img/bukti_laporan/'.$data['laporan']['pembelian']);
              }

              if($fileBarang->getSize() != 0){
                $fileBarang->move('img/bukti_laporan', $dataBantuan['barang']);
                unlink('img/bukti_laporan/'.$data['laporan']['barang']);
              }
              
              session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
              Laporan berhasil diperbarui
              </div>');
              return redirect()->to('/dashboard/daftarLaporan/'.$idPengajuan);
            }else{
              session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
              Laporan gagal diperbarui
              </div>');
              return redirect()->to('/dashboard/daftarLaporan/'.$idPengajuan);
            }
          }else{
            return redirect()->to('/dashboard/daftarLaporan/'.$idPengajuan)->withInput();
          }
        }else{
          session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
              Jumlah dana melebihi pengajuan
              </div>');
              return redirect()->to('/dashboard/daftarLaporan/'.$idPengajuan);
        }
      }else{
        return view('dashboard/member/perbaruiLaporan',$data);
      }
    }
  }
	//--------------------------------------------------------------------

}
