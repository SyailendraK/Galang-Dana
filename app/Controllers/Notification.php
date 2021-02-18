<?php namespace App\Controllers;
use App\Libraries\Midtrans;
use App\Models\TransaksiModel;
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Methods:GET, OPTIONS");

class Notification extends BaseController {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	protected $midtrans;
	protected $transaksiModel;

	public function __construct()
    {
		$this->transaksiModel = new TransaksiModel();
		$this->midtrans = new Midtrans();
    $params = array('server_key' => 'SB-Mid-server-V9MgRs54SbZqZGoIR6bRynbB', 'production' => false);
		$this->midtrans->config($params);
		// $this->load->helper('url');	
    }

	public function index()
	{
		echo 'test notification handler';
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result,true);

		$data = [
			'status_code'    => $result['status_code']
		];

		if($result['status_code'] == 200){		
		$this->transaksiModel->update($result['order_id'], $data);
		}

		error_log(print_r($result,TRUE));
		
		//notification handler sample

		/*
		$transaction = $notif->transaction_status;
		$type = $notif->payment_type;
		$order_id = $notif->order_id;
		$fraud = $notif->fraud_status;

		if ($transaction == 'capture') {
		  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
		  if ($type == 'credit_card'){
		    if($fraud == 'challenge'){
		      // TODO set payment status in merchant's database to 'Challenge by FDS'
		      // TODO merchant should decide whether this transaction is authorized or not in MAP
		      echo "Transaction order_id: " . $order_id ." is challenged by FDS";
		      } 
		      else {
		      // TODO set payment status in merchant's database to 'Success'
		      echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
		      }
		    }
		  }
		else if ($transaction == 'settlement'){
		  // TODO set payment status in merchant's database to 'Settlement'
		  echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
		  } 
		  else if($transaction == 'pending'){
		  // TODO set payment status in merchant's database to 'Pending'
		  echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
		  } 
		  else if ($transaction == 'deny') {
		  // TODO set payment status in merchant's database to 'Denied'
		  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
		}*/

	}

	public function success($id)
	{
		$data = [
			'data' => $this->transaksiModel->getTransaksiByID($id)
		];
		return view('payment/success_payment',$data);
	}

	public function error()
	{
		return view('payment/error_payment');
	}
}
