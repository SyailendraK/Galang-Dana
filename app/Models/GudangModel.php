<?php namespace App\Models;

use CodeIgniter\Model;

class GudangModel extends Model
{
  protected $table = 'gudang';
  protected $primaryKey = 'id';
  protected $useTimestamps = true;
  protected $allowedFields = ['nama_pj','telp_pj','alamat','deskel','kecamatan','kotkab','provinsi'];

  public function getGudangAll()
  {
    return $this->orderBy('provinsi ASC, kotkab ASC, kecamatan ASC, alamat ASC')->findAll();
  }

  public function countGudang()
  {
    return $this->countAllResults();
  }

  public function getGudangByID($id)
  {
    return $this->find($id);
  }

  public function saveGudang($data)
  {
    try {
      $this->save($data);
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function hapusGudang($id)
  {
    try {
      $this->delete($id);
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

}


