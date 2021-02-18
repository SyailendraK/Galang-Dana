<?php namespace App\Models;

use CodeIgniter\Model;

class VerifikasiModel extends Model
{
  protected $table = 'verifikasi';
  protected $primaryKey = 'nik';
  protected $useTimestamps = true;
  protected $allowedFields = ['id_user','nik','nama','ktp','ktpdiri','status'];

  public function verifikasi($data,$stat)
  {
    try {
      
      if($stat){
        $dataBaru = [
          'nik' => $data['nik'],
          'nama' => $data['nama'],
          'ktp' => $data['ktp'],
          'ktpdiri' => $data['ktpDiri'],
          'status' => 0
        ];
        $this->update(user_id(), $dataBaru);
      }else{
        $dataBaru = [
          'id_user' => user_id(),
          'nik' => $data['nik'],
          'nama' => $data['nama'],
          'ktp' => $data['ktp'],
          'ktpdiri' => $data['ktpDiri'],
          'status' => 0
        ];
        $this->insert($dataBaru);
      }
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function getVerifikasiAll()
  {
    return $this->where(['status' => 0])->orderBy('created_at', 'DESC')->orderBy('nik', 'RANDOM')->findAll(6);
  }
  
  public function getVerifikasiByID($id)
  {
    return $this->find($id);
  }

  public function verifikasiMember($id)
  {
    try {
      $this->update($id, ['status' => 2]);
      return true;
    } catch (\Throwable $th) {
      dd($th);
      return false;
    }
  }

  public function tolakVerifikasiMember($id)
  {
    try {
      $this->update($id, ['status' => 3]);
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function unVerifikasiMember($id)
  {
    try {
      $this->delete($id);
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function cariVerifikasi($nik)
  {
    return $this->where(['nik' => $nik,'status' => 2])->findAll();
  }


}