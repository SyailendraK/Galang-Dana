<?php namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
  protected $table = 'transaksi';
  protected $primaryKey = 'order_id';
  protected $useTimestamps = true;
  protected $allowedFields = ['order_id','id_user','gross_amount','payment_type','transaction_time','bank','va_number','keterangan','status_code'];

  public function getTransaksiAll()
  {
    return $this->where("status_code='200' OR status_code='199'")
      ->findAll();
  }

  public function getDonationCountUser()
  {
    return $this->distinct()->select('id_user')->where("status_code=200")->countAllResults();
  }

  public function getTransaksiPengeluaranUser($id)
  {
    $transaksi = $this->getTransaksiByUserID($id);
    if($transaksi != null){
      return $this->where("status_code='199' AND created_at>=".$transaksi[0]['created_at']."")
      ->findAll();
    }
  }

  public function getTransaksiByID($id)
  {
    return $this->find($id);
  }

  public function getTransaksiByUserID($id)
  {
    if($id){
      return $this->where(['id_user' => $id,'status_code' => '200'])
      ->orderBy('created_at', 'asc')->findAll();
    }
  }

  public function getTransaksiByTime($start,$end)
  {
    if($start != '' && $end != ''){
    return $this->where("(status_code=200 OR status_code=199) AND (created_at>='".$start."' AND created_at<='".$end."')")
      ->orderBy('created_at', 'desc')->findAll();
    }if($start != '' || $end != ''){
      return $this->where("(status_code=200 OR status_code=199) AND (created_at='".$start."' OR created_at='".$end."')")
      ->orderBy('created_at', 'desc')->findAll();
    }else{
      return $this->where("status_code=200 OR status_code=199")
      ->orderBy('created_at', 'desc')->findAll(20);
    }
  }

  public function insertTransaksi($data)
  {
    try {
      $this->insert($data);
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }


}