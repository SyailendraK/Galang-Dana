<?php namespace App\Controllers;
use App\Libraries\Midtrans;
use App\Models\TransaksiModel;
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Methods:GET, OPTIONS");

class Snap extends BaseController {

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
    $params = array('server_key' => '***', 'production' => false);
		$this->midtrans->config($params);
		// $this->load->helper('url');	
    }

    public function index()
    {
    	return view('payment/checkout_snap');
    }

    public function token()
    {
			$nama = ($this->request->getVar('nama')) ? $this->request->getVar('nama') : 'Anonim';
			$jumlah = (int)$this->request->getVar('jumlah');
			$email = $this->request->getVar('email');
			
			// Required
			$transaction_details = array(
				'order_id' => rand(),
				'gross_amount' => $jumlah, // no decimal allowed for creditcard
			);

			// Optional
			$item1_details = array(
				'id' => $transaction_details['order_id'],
				'price' => $jumlah,
				'quantity' => 1,
				'name' => "Donasi atas nama : ".$nama
			);

			// Optional
			// $item2_details = array(
			//   'id' => 'a2',
			//   'price' => 20000,
			//   'quantity' => 2,
			//   'name' => "Orange"
			// );

			// Optional
			$item_details = array ($item1_details);

			// Optional
			// $billing_address = array(
			//   'first_name'    => "Obet",
			//   'last_name'     => "",
			//   'address'       => $pesan,
			//   'city'          => "",
			//   'postal_code'   => "",
			//   'phone'         => "",
			//   'country_code'  => ''

			// );

			// Optional
			// $shipping_address = array(
			//   'first_name'    => "Obet",
			//   'last_name'     => "Supriadi",
			//   'address'       => $pesan,
			//   'city'          => "",
			//   'postal_code'   => "",
			//   'phone'         => "",
			//   'country_code'  => ''
			// );

			// Optional
			$customer_details = array(
				'first_name'    => $nama,
				'email'         => $email,
			);

			// Data yang akan dikirim untuk request redirect_url.
					$credit_card['secure'] = true;
					//ser save_card true to enable oneclick or 2click
					//$credit_card['save_card'] = true;

					$time = time();
					$custom_expiry = array(
							'start_time' => date("Y-m-d H:i:s O",$time),
							'unit' => 'hour', 
							'duration'  => 12
					);
					
					$transaction_data = array(
							'transaction_details'=> $transaction_details,
							'item_details'       => $item_details,
							'customer_details'   => $customer_details,
							'credit_card'        => $credit_card,
							'expiry'             => $custom_expiry
					);

			error_log(json_encode($transaction_data));
			// $midtrans = new Midtrans();
			$snapToken = $this->midtrans->getSnapToken($transaction_data);
			error_log($snapToken);
			echo $snapToken;
    }

    public function finish()
    {
			$result = json_decode($this->request->getVar('result_data'),true);
			$vaNumber = '';
			$bank = '';
			$pdf_url = '';

			if($result['va_numbers']){
				$bank = $result['va_numbers'][0]['bank'];
				$vaNumber = $result['va_numbers'][0]['va_number'];
				$pdf_url = $result['pdf_url'];
			}
			$data = [
				'order_id' => $result['order_id'],
				'id_user' => (user_id()) ? user_id() : 0,
				'gross_amount' => $result['gross_amount'],
				'payment_type' => $result['payment_type'],
				'transaction_time' => $result['transaction_time'],
				'bank' => $bank,
				'va_number' => $vaNumber,
				'keterangan' => "Donasi Umum",
				'status_code' => $result['status_code']
			];
			try {
				$this->transaksiModel->insertTransaksi($data); 
				return redirect()->to('/notification/success/'.$result['order_id']);
			} catch (\Throwable $th) {
				return redirect()->to('/notification/error');
			}
    }
}
