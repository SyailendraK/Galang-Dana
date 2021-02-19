<?php namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
  protected $table = 'laporan_bantuan';
  protected $primaryKey = 'id';
  protected $useTimestamps = true;
  protected $allowedFields = ['user_id','bantuan_id','cerita','jumlah','pembelian','barang'];

  public function getPengajuanLaporan($limit)
  {
      return $this->select('pengajuan_bantuan.nama AS nama,pengajuan_bantuan.nik AS nik,laporan_bantuan.cerita AS lap_cerita, pengajuan_bantuan.cerita AS ban_cerita, pengajuan_bantuan.jumlah AS ban_jumlah, laporan_bantuan.jumlah AS lap_jumlah, fotoDiri, pembelian, barang, laporan_bantuan.id AS id')->where(['status' => 2])->join('pengajuan_bantuan', 'pengajuan_bantuan.id = laporan_bantuan.bantuan_id')->findAll($limit);
  }

  public function getPengajuanLaporanByID($id)
  {
      return $this->select('laporan_bantuan.user_id AS user_id,pengajuan_bantuan.nama AS nama,pengajuan_bantuan.nik AS nik,laporan_bantuan.cerita AS cerita,   laporan_bantuan.jumlah AS jumlah, fotoDiri, barang, laporan_bantuan.id AS id')->where(['status' => 2, 'laporan_bantuan.id' => $id])->join('pengajuan_bantuan', 'pengajuan_bantuan.id = laporan_bantuan.bantuan_id')->first();
  }

  public function getLaporanByName($name)
  {
    return $this->select('pengajuan_bantuan.nama AS nama,pengajuan_bantuan.nik AS nik,laporan_bantuan.cerita AS lap_cerita, pengajuan_bantuan.cerita AS ban_cerita, pengajuan_bantuan.jumlah AS ban_jumlah, laporan_bantuan.jumlah AS lap_jumlah, fotoDiri, pembelian, barang, laporan_bantuan.id AS id')->like(['nama' => $name])->join('pengajuan_bantuan', 'pengajuan_bantuan.id = laporan_bantuan.bantuan_id')->findAll();
  }

  public function getLaporanByUserID($id)
  {
    return $this->where(['user_id' => user_id(),'bantuan_id' => $id])->orderBy('created_at', 'desc')->findAll();
  }

  public function getLaporanByID($id)
  {
    return $this->find($id);
  }

  public function tambahLaporan($data)
  {
    $this->save($data);
    return true;
  }

  public function hapusLaporan($id)
  {
    try {
      $this->delete($id);
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

}


