<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
/**
 * @package Razorpay :  CodeIgniter Razorpay Gateway
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 *   
 * Description of Razorpay Controller
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
require_once(APPPATH."libraries/razorpay/razorpay-php/Razorpay.php");	
 
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class Razorpay extends CI_Controller {
    // construct
    public function __construct() {
        parent::__construct();   
        //$this->load->model('Site', 'site');     
        $this->load->model('web/Home_view_model','home_view_model');
         $this->load->model('admin/email/Email_model','email_model');
        $this->load->library('email');
    }
    // index page
    public function index() {
		//echo "hello...";die();
        $data['title'] = 'Razorpay | TechArise';  
        $data['productInfo'] = '';           
        $this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/razorpay/checkout');
		$this->load->view('admin/_footer');
		
    }
    
    // checkout page
    public function checkout($id) {
        $data['title'] = 'Payment | Checkout';  
        $this->site->setProductID($id);
        $data['itemInfo'] = $this->site->getProductDetails(); 
        $data['return_url'] = site_url().'admin/razorpay/callback';
        $data['surl'] = site_url().'admin/razorpay/success';;
        $data['furl'] = site_url().'admin/razorpay/failed';;
        $data['currency_code'] = 'INR';
		
		
		$meta_sql = "select * from metadata where id = '4'";
		$res_meta = $this->db->query($meta_sql);
		$data['meta_info'] = $res_meta->result_array();
        $this->load->view('razorpay/checkout', $data);
    }
	
	public function success(){
		$data['title'] = 'Payment | Success';  
		$meta_sql = "select * from metadata where id = '4'";
		$res_meta = $this->db->query($meta_sql);
		$data['meta_info'] = $res_meta->result_array();
        $this->load->view('admin/razorpay/checkout', $data);
	}
	
	public function paymentfailed(){
		$data['title'] = 'Payment | Failed';  
		$meta_sql = "select * from metadata where id = '4'";
		$res_meta = $this->db->query($meta_sql);
		$data['meta_info'] = $res_meta->result_array();
        $this->load->view('admin/razorpay/checkout', $data);
	}
 
	public function prepareData($amount,$razorpayOrderId)
  {
    $data = array(
      "key" => '$rzp_test_PLSeO0PkhIlcII',
      "amount" => $amount,
      "name" => "Coding Birds Online",
      "description" => "Learn To Code",
      "image" => "https://demo.codingbirdsonline.com/website/img/coding-birds-online/coding-birds-online-favicon.png",
      "prefill" => array(
        "name"  => $this->input->post('name'),
        "email"  => $this->input->post('email'),
        "contact" => $this->input->post('contact'),
      ),
      "notes"  => array(
        "address"  => "Hello World",
        "merchant_order_id" => rand(),
      ),
      "theme"  => array(
        "color"  => "#F37254"
      ),
      "order_id" => $razorpayOrderId,
    );
    return $data;
  }

    // initialized cURL Request
    private function get_curl_handle($payment_id, $amount)  {
        $url = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
        $key_id = 'rzp_test_PLSeO0PkhIlcII';
        $key_secret = 'SCiN6HoUwvkeMI1uB5VNbkWT';
        $fields_string = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'/ca-bundle.crt');
        return $ch;
    }   
        
    // callback method
    public function callback() {      
        
        	$ci = get_instance();
		$ci->load->library('email');
        $config['protocol'] = "tls";
        $config['smtp_host'] = "inpro8.fcomet.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "info@telehealers.in"; 
        $config['smtp_pass'] = "Ajay@1234%";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
		$ci->email->initialize($config);
		
		$meta_sql = "select * from metadata where id = '4'";
		$res_meta = $this->db->query($meta_sql);
		$data['meta_info'] = $res_meta->result_array();
		
		//echo "<pre>";print_r($data['meta_info']);die();
	
	//echo "pay--".$this->input->post('razorpay_payment_id');die();
	 //$data['info'] = $this->home_view_model->Home_satup();
	
        if (!empty($this->input->post('razorpay_payment_id'))) {
            $razorpay_payment_id = $this->input->post('razorpay_payment_id');
            //$merchant_order_id = $this->input->post('merchant_order_id');
            $currency_code = 'INR';
            //$amount = $this->input->post('merchant_total');
            //$success = false;
            //$error = '';
			//echo "razorpay_payment_id--".$razorpay_payment_id."<br>";
			//echo "merchant_order_id--".$merchant_order_id."<br>";
			//echo "amount--".$amount."<br>";
			
			$RAZOR_KEY = 'rzp_test_PLSeO0PkhIlcII';
			$RAZOR_SECRET_KEY = 'SCiN6HoUwvkeMI1uB5VNbkWT';
		
			$success = true;
			$error = "payment_failed";
			if (empty($_POST['razorpay_payment_id']) === false) {
			  $api = new Api($RAZOR_KEY, $RAZOR_SECRET_KEY);
			try {
				$attributes = array(
				  'razorpay_order_id' => $_SESSION['razorpay_order_id'],
				  'razorpay_payment_id' => $_POST['razorpay_payment_id'],
				  'razorpay_signature' => $_POST['razorpay_signature']
				);
				$api->utility->verifyPaymentSignature($attributes);
			  } catch(SignatureVerificationError $e) {
				$success = false;
				$error = 'Razorpay_Error : ' . $e->getMessage();
			  }
			}
			if ($success === true) {
			  /**
			   * Call this function from where ever you want
			   * to save save data before of after the payment
			   */
			   $merchant_order_id = $_SESSION['merchant_order_id'];
			   
				$SQL5 = "select * from payment_table where appointment_id = '".$merchant_order_id."'";
				$query5 = $this->db->query($SQL5);
				$result5 = $query5->result_array();
				if(is_array($result5) && count($result5)>0){
					$data['alreaty'] = '1';
				}else{
					
					$SQL2 = "select patient_id,venue_id,date,sequence,problem from appointment_tbl where appointment_id = '".$merchant_order_id."'";
					$query2 = $this->db->query($SQL2);
					$result2 = $query2->result_array();
					if(is_array($result2) && count($result2)>0){
						$patient_id = $result2[0]['patient_id'];
						$venue_id = $result2[0]['venue_id'];
						$date = $result2[0]['date'];
						$sequence = $result2[0]['sequence'];
						$problem = $result2[0]['problem'];
					}
					
					$SQL4 = "select venue_name,venue_contact,venue_address from venue_tbl where venue_id = '".$venue_id."'";
					$query4 = $this->db->query($SQL4);
					$result4 = $query4->result_array();
					if(is_array($result4) && count($result4)>0){
						$venue_name = $result4[0]['venue_name'];
						$venue_contact = $result4[0]['venue_contact'];
						$venue_address = $result4[0]['venue_address'];
					}
					
					$SQL3 = "select patient_name,patient_email,patient_phone from patient_tbl where patient_id = '".$patient_id."'";
					$query3 = $this->db->query($SQL3);
					$result3 = $query3->result_array();
					if(is_array($result3) && count($result3)>0){
						$patient_name = $result3[0]['patient_name'];
						$patient_email = $result3[0]['patient_email'];
						$patient_phone = $result3[0]['patient_phone'];
					}
					$name = $patient_name;
					$email = $patient_email;
					$contact = $patient_phone;
					$amount = $_SESSION['payable_amount'];
					$order_id =  $_SESSION['razorpay_order_id'];
					
					$SQL1 = "select * from appointment_tbl where appointment_id = '".$merchant_order_id."'";
					$query1 = $this->db->query($SQL1);
					$result1 = $query1->result_array();
					if(is_array($result1) && count($result1)>0){
						$patient_id = $result1[0]['patient_id'];
						$doctor_id = $result1[0]['doctor_id'];
					}
					$f_amount = $amount;
					$appointment_id = $merchant_order_id;
					$date_time = date('Y-m-d h:i:s'); 
					$payment_status = 1;
					$sql2 = "insert into payment_table (appointment_id,razorpay_payment_id,patient_id,doctor_id,amount,date_time,payment_status) values ('$appointment_id','$razorpay_payment_id','$patient_id','$doctor_id','$f_amount','$date_time','$payment_status')";
					$this->db->query($sql2);
					
					$SQL2 = "select doctor_name,fees,log_id from doctor_tbl where doctor_id = '".$doctor_id."'";
					$query2 = $this->db->query($SQL2);
					$result2 = $query2->result_array();
					if(is_array($result2) && count($result2)>0){
						$fees = $result2[0]['fees'];
						$doctor_name = $result2[0]['doctor_name'];
						$log_id = $result2[0]['log_id'];
					} 
					if($log_id>0){
						$sql_doc = "select * from log_info where log_id = '".$log_id."'";
						$res_doc = $this->db->query($sql_doc);
						$result_doc = $res_doc->result_array();
						if(is_array($result_doc) && count($result_doc)>0){
							$doctor_email = $result_doc[0]['email'];
						}
					}
					
					$data['title'] = 'Payment Success | Razorpay';  
					$data['patient_name'] = $patient_name;  
					$data['patient_id'] = $patient_id;  
					$data['patient_email'] = $patient_email;  
					$data['patient_phone'] = $patient_phone;  
					$data['appointment_id'] = $merchant_order_id;  
					$data['payment_date'] = $date_time;  
					$data['f_amount'] = $f_amount;  
					$data['order_id'] = $order_id;  
					$data['doctor_name'] = $doctor_name;  
					$data['venue_name'] = $venue_name;  
					$data['venue_contact'] = $venue_contact;  
					$data['venue_address'] = $venue_address;  
					$data['date'] = $date;  
					$data['sequence'] = $sequence;  
					$data['problem'] = $problem;  
					$data['razorpay_order_id'] = $_SESSION['razorpay_order_id'];  
					$data['razorpay_payment_id'] = $_POST['razorpay_payment_id'];  
					$data['status'] = 'Paid';  
					//echo "<pre>";print_r($data);
					$to = $patient_email;
					$subject = 'Payment Information from telehealers.in';
					
					$message = '<html lang="en-US"><head><meta charset="UTF-8" /></head><body>';
					$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
					$message .= "<tr><td><strong>Patient Name:</strong> </td><td>" . strip_tags($patient_name) . "</td></tr>";
					$message .= "<tr><td><strong>Patient ID:</strong> </td><td>" . strip_tags($patient_id) . "</td></tr>";
					$message .= "<tr><td><strong>Patient Email ID:</strong> </td><td>" . strip_tags($patient_email) . "</td></tr>";
					$message .= "<tr><td><strong>Patient Phone:</strong> </td><td>" . strip_tags($patient_phone) . "</td></tr>";
					$message .= "<tr><td><strong>Appointment ID:</strong> </td><td>" . strip_tags($appointment_id) . "</td></tr>";
					$message .= "<tr><td><strong>Payment Date:</strong> </td><td>" . strip_tags($date_time) . "</td></tr>";
					$message .= "<tr><td><strong>Fees:</strong> </td><td>" . strip_tags($f_amount) . " INR</td></tr>";
					$message .= "<tr><td><strong>Doctor Name:</strong> </td><td>" . strip_tags($doctor_name) . "</td></tr>";
					$message .= "<tr><td><strong>Venue Name:</strong> </td><td>" . strip_tags($venue_name) . "</td></tr>";
					//$message .= "<tr><td><strong>Venue Contact:</strong> </td><td>" . strip_tags($venue_contact) . "</td></tr>";
					//$message .= "<tr><td><strong>Venue Address:</strong> </td><td>" . strip_tags($venue_address) . "</td></tr>";
					$message .= "<tr><td><strong>Appointment Date:</strong> </td><td>" . strip_tags($date) . "</td></tr>";
					$message .= "<tr><td><strong>Appointment Time:</strong> </td><td>" . strip_tags($sequence) . "</td></tr>";
					$message .= "<tr><td><strong>Patient CC:</strong> </td><td>" . strip_tags($problem) . "</td></tr>";
					$message .= "<tr><td><strong>Razorpay Order ID:</strong> </td><td>" . strip_tags($_SESSION['razorpay_order_id']) . "</td></tr>";
					$message .= "<tr><td><strong>Razorpay Payment ID:</strong> </td><td>" . strip_tags($_POST['razorpay_payment_id']) . "</td></tr>";
					$message .= "<tr><td><strong>Status:</strong> </td><td> Paid </td></tr>";
					$message .= "<tr><td>&nbsp;</td></tr>";
					$message .= "</table>";
					$message .= "</body></html>";
					$from_email = 'sales@ecomsolver.com';

					$headers = "From: " . strip_tags($from_email) . "\r\n";
					$headers .= "Reply-To: ". strip_tags($from_email) . "\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					//mail($to, $subject, $message, $headers);
					
					$message = '<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
    <center style="width: 100%; background-color: #f1f1f1;">
        <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
            &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <div style="max-width: 600px; margin: 0 auto;" class="email-container">
            <!-- BEGIN BODY -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tbody><tr>
                    <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody><tr>
                                <td class="logo" style="text-align: left;">
                                    <h1>
                                        <a href="http://telehealers.in/">
                                        <img src="http://telehealers.in/assets/uploads/images/telehe2.png">    
                                        </a>
                                    </h1>
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
                <tr>
                    </tr></tbody></table><table class="bg_white" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody><tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
                            <td valign="middle" width="100%" style="text-align:left; padding: 0 2.5em;">
                                <div class="product-entry">
                                    <div class="text">
                                        <p>Hey <strong>'.$patient_name.'</strong>,</p>
                                        <h2>Your payment details show below:</h2>
                                        <p>Patient Name: '.$patient_name.'</p>
                                        <p>Patient ID: '.$patient_id.',</p>
										<p>Patient Email ID: '.$patient_email.',</p>
										<p>Patient Phone: '.$patient_phone.',</p>
										<p>Appointment ID: '.$appointment_id.',</p>
										<p>Payment Date: '.$date_time.',</p>
										<p>Fees: Rs.'.$f_amount.',</p>
										<p>Doctor Name: '.$doctor_name.',</p>
										<p>Venue Name: '.$venue_name.',</p>
										<p>Appointment Date: '.$date.',</p>
										<p>Appointment Time: '.$sequence.',</p>
										<p>Patient CC: '.$problem.',</p>
										<p>Razorpay Order ID: '.strip_tags($_SESSION['razorpay_order_id']).',</p>
										<p>Razorpay Payment ID: '.strip_tags($_POST['razorpay_payment_id']).',</p>
										<p>Status: Paid,</p>
								    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody></table>
                
            
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tbody><tr>
                    <td class="bg_white" style="text-align: center;">
                        <p>Receive these email? You can <a href="#" style="color: rgba(0,0,0,.8);">Unsubscribe here</a></p>
                    </td>
                </tr>
            </tbody></table>

        </div>
    </center>


</body></html>';

                    $ci->email->from('info@telehealers.in', 'telehealers');
					$list = array($patient_email);
					$ci->email->to($list);
					$this->email->reply_to('info@telehealers.in', 'telehealers');
					$ci->email->subject('Appointment Payment Information');
					$ci->email->message($message);
					$ci->email->send();
					
					$ci->email->from('info@telehealers.in', 'telehealers');
					$list = array($doctor_email);
					$ci->email->to($list);
					$this->email->reply_to('info@telehealers.in', 'telehealers');
					$ci->email->subject('Appointment Payment Information');
					$ci->email->message($message);
					$ci->email->send();
					
					
				}
				
			   
				$succ_arr['data'] = $data;
				$succ_arr['info'] = $this->home_view_model->Home_satup();
				
				$this->load->view('admin/razorpay/success', $succ_arr);
			}
			else {
				
				$merchant_order_id = $_SESSION['merchant_order_id'];
				
				$SQL5 = "select * from payment_table where appointment_id = '".$merchant_order_id."'";
				$query5 = $this->db->query($SQL5);
				$result5 = $query5->result_array();
				if(is_array($result5) && count($result5)>0){
					$data['alreaty'] = '1';
				}else{
					
			   $SQL2 = "select patient_id,venue_id,date,sequence,problem from appointment_tbl where appointment_id = '".$merchant_order_id."'";
				$query2 = $this->db->query($SQL2);
				$result2 = $query2->result_array();
				if(is_array($result2) && count($result2)>0){
					$patient_id = $result2[0]['patient_id'];
					$venue_id = $result2[0]['venue_id'];
					$date = $result2[0]['date'];
					$sequence = $result2[0]['sequence'];
					$problem = $result2[0]['problem'];
				}
				
				$SQL4 = "select venue_name,venue_contact,venue_address from venue_tbl where venue_id = '".$venue_id."'";
				$query4 = $this->db->query($SQL4);
				$result4 = $query4->result_array();
				if(is_array($result4) && count($result4)>0){
					$venue_name = $result4[0]['venue_name'];
					$venue_contact = $result4[0]['venue_contact'];
					$venue_address = $result4[0]['venue_address'];
				}
				
				$SQL3 = "select patient_name,patient_email,patient_phone from patient_tbl where patient_id = '".$patient_id."'";
				$query3 = $this->db->query($SQL3);
				$result3 = $query3->result_array();
				if(is_array($result3) && count($result3)>0){
					$patient_name = $result3[0]['patient_name'];
					$patient_email = $result3[0]['patient_email'];
					$patient_phone = $result3[0]['patient_phone'];
				}
				$name = $patient_name;
				$email = $patient_email;
				$contact = $patient_phone;
				$amount = $_SESSION['payable_amount'];
				$order_id =  $_SESSION['razorpay_order_id'];
				
				$SQL1 = "select * from appointment_tbl where appointment_id = '".$merchant_order_id."'";
				$query1 = $this->db->query($SQL1);
				$result1 = $query1->result_array();
				if(is_array($result1) && count($result1)>0){
					$patient_id = $result1[0]['patient_id'];
					$doctor_id = $result1[0]['doctor_id'];
				}
				$f_amount = $amount;
				$appointment_id = $merchant_order_id;
				$date_time = date('Y-m-d h:i:s'); 
				$payment_status = 1;
				$sql2 = "insert into payment_table (appointment_id,razorpay_payment_id,patient_id,doctor_id,amount,date_time,payment_status) values ('$appointment_id','$razorpay_payment_id','$patient_id','$doctor_id','$f_amount','$date_time','$payment_status')";
				$this->db->query($sql2);
				
				$SQL2 = "select doctor_name,fees from doctor_tbl where doctor_id = '".$doctor_id."'";
				$query2 = $this->db->query($SQL2);
				$result2 = $query2->result_array();
				if(is_array($result2) && count($result2)>0){
					$fees = $result2[0]['fees'];
					$doctor_name = $result2[0]['doctor_name'];
				} 
				
				$data['title'] = 'Payment Success | Razorpay';  
				$data['patient_name'] = $patient_name;  
				$data['patient_id'] = $patient_id;  
				$data['patient_email'] = $patient_email;  
				$data['patient_phone'] = $patient_phone;  
				$data['appointment_id'] = $merchant_order_id;  
				$data['payment_date'] = $date_time;  
				$data['f_amount'] = $f_amount;  
				$data['order_id'] = $order_id;  
				$data['doctor_name'] = $doctor_name;  
				$data['venue_name'] = $venue_name;  
				$data['venue_contact'] = $venue_contact;  
				$data['venue_address'] = $venue_address;  
				$data['date'] = $date;  
				$data['sequence'] = $sequence;  
				$data['problem'] = $problem;  
				$data['razorpay_order_id'] = $_SESSION['razorpay_order_id'];  
				$data['razorpay_payment_id'] = $_POST['razorpay_payment_id'];  
				$data['status'] = 'Fail';  
				//echo "<pre>";print_r($data);
				$to = $patient_email;
					$subject = 'Payment Information from telehealers.in';
					
					$message = '<html lang="en-US"><head><meta charset="UTF-8" /></head><body>';
					$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
					$message .= "<tr><td><strong>Patient Name:</strong> </td><td>" . strip_tags($patient_name) . "</td></tr>";
					$message .= "<tr><td><strong>Patient ID:</strong> </td><td>" . strip_tags($patient_id) . "</td></tr>";
					$message .= "<tr><td><strong>Patient Email ID:</strong> </td><td>" . strip_tags($patient_email) . "</td></tr>";
					$message .= "<tr><td><strong>Patient Phone:</strong> </td><td>" . strip_tags($patient_phone) . "</td></tr>";
					$message .= "<tr><td><strong>Appointment ID:</strong> </td><td>" . strip_tags($appointment_id) . "</td></tr>";
					$message .= "<tr><td><strong>Payment Date:</strong> </td><td>" . strip_tags($date_time) . "</td></tr>";
					$message .= "<tr><td><strong>Fees:</strong> </td><td>" . strip_tags($f_amount) . " INR</td></tr>";
					$message .= "<tr><td><strong>Doctor Name:</strong> </td><td>" . strip_tags($doctor_name) . "</td></tr>";
					$message .= "<tr><td><strong>Venue Name:</strong> </td><td>" . strip_tags($venue_name) . "</td></tr>";
					$message .= "<tr><td><strong>Venue Contact:</strong> </td><td>" . strip_tags($venue_contact) . "</td></tr>";
					$message .= "<tr><td><strong>Venue Address:</strong> </td><td>" . strip_tags($venue_address) . "</td></tr>";
					$message .= "<tr><td><strong>Appointment Date:</strong> </td><td>" . strip_tags($date) . "</td></tr>";
					$message .= "<tr><td><strong>Appointment Time:</strong> </td><td>" . strip_tags($sequence) . "</td></tr>";
					$message .= "<tr><td><strong>Patient CC:</strong> </td><td>" . strip_tags($problem) . "</td></tr>";
					$message .= "<tr><td><strong>Razorpay Order ID:</strong> </td><td>" . strip_tags($_SESSION['razorpay_order_id']) . "</td></tr>";
					$message .= "<tr><td><strong>Razorpay Payment ID:</strong> </td><td>" . strip_tags($_POST['razorpay_payment_id']) . "</td></tr>";
					$message .= "<tr><td><strong>Status:</strong> </td><td> Failed </td></tr>";
					$message .= "<tr><td>&nbsp;</td></tr>";
					$message .= "</table>";
					$message .= "</body></html>";
					$from_email = 'sales@ecomsolver.com';

					$headers = "From: " . strip_tags($from_email) . "\r\n";
					$headers .= "Reply-To: ". strip_tags($from_email) . "\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					//mail($to, $subject, $message, $headers);
					
						$message = '<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
    <center style="width: 100%; background-color: #f1f1f1;">
        <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
            &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <div style="max-width: 600px; margin: 0 auto;" class="email-container">
            <!-- BEGIN BODY -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tbody><tr>
                    <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody><tr>
                                <td class="logo" style="text-align: left;">
                                    <h1>
                                        <a href="http://telehealers.in/">
                                        <img src="http://telehealers.in/assets/uploads/images/telehe2.png">    
                                        </a>
                                    </h1>
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
                <tr>
                    </tr></tbody></table><table class="bg_white" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody><tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
                            <td valign="middle" width="100%" style="text-align:left; padding: 0 2.5em;">
                                <div class="product-entry">
                                    <div class="text">
                                        <p>Hey <strong>'.$patient_name.'</strong>,</p>
                                        <h2>Your payment details show below:</h2>
                                        <p>Patient Name: '.$patient_name.'</p>
                                        <p>Patient ID: '.$patient_id.',</p>
										<p>Patient Email ID: '.$patient_email.',</p>
										<p>Patient Phone: '.$patient_phone.',</p>
										<p>Appointment ID: '.$appointment_id.',</p>
										<p>Payment Date: '.$date_time.',</p>
										<p>Fees: Rs.'.$f_amount.',</p>
										<p>Doctor Name: '.$doctor_name.',</p>
										<p>Venue Name: '.$venue_name.',</p>
										<p>Appointment Date: '.$date.',</p>
										<p>Appointment Time: '.$sequence.',</p>
										<p>Patient CC: '.$problem.',</p>
										<p>Razorpay Order ID: '.strip_tags($_SESSION['razorpay_order_id']).',</p>
										<p>Razorpay Payment ID: '.strip_tags($_POST['razorpay_payment_id']).',</p>
										<p>Status: Failed,</p>
								    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody></table>
                
            
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tbody><tr>
                    <td class="bg_white" style="text-align: center;">
                        <p>Receive these email? You can <a href="#" style="color: rgba(0,0,0,.8);">Unsubscribe here</a></p>
                    </td>
                </tr>
            </tbody></table>

        </div>
    </center>


</body></html>';

                    $ci->email->from('info@telehealers.in', 'telehealers');
					$list = array($patient_email);
					$ci->email->to($list);
					$this->email->reply_to('info@telehealers.in', 'telehealers');
					$ci->email->subject('Appointment Payment Information');
					$ci->email->message($message);
					$ci->email->send();
					
					$ci->email->from('info@telehealers.in', 'telehealers');
					$list = array($doctor_email);
					$ci->email->to($list);
					$this->email->reply_to('info@telehealers.in', 'telehealers');
					$ci->email->subject('Appointment Payment Information');
					$ci->email->message($message);
					$ci->email->send();
					
					
				}
				$succ_arr['data'] = $data;
				redirect(base_url().'admin/razorpay/paymentfailed',$succ_arr);
			}
			
			
		
			/* $data['title'] = 'Payment | Response';  
			$this->site->setProductID($id);
			$data['itemInfo'] = $this->site->getProductDetails(); 
			$this->load->view('razorpay/checkout', $data); */
			/* try {                
                $ch = $this->get_curl_handle($razorpay_payment_id, $amount);
                //execute post
				
                $result = curl_exec($ch);
				
				$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($result === false) {
                    $success = false;
                    $error = 'Curl error: '.curl_error($ch);
                } else {
                    $response_array = json_decode($result, true);
                    echo "<pre>";print_r($response_array);exit;
                        //Check success response
                        if ($http_status === 200 and isset($response_array['error']) === false) {
                            $success = true;
                        } else {
                            $success = false;
                            if (!empty($response_array['error']['code'])) {
                                $error = $response_array['error']['code'].':'.$response_array['error']['description'];
                            } else {
                                $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                            }
                        }
                }
                //close connection
                curl_close($ch);
            } catch (Exception $e) {
                $success = false;
                $error = 'OPENCART_ERROR:Request to Razorpay Failed';
            } */
            /* if ($success === true) {
                if(!empty($this->session->userdata('ci_subscription_keys'))) {
                    $this->session->unset_userdata('ci_subscription_keys');
                 }
                if (!$order_info['order_status_id']) {
                    redirect($this->input->post('merchant_surl_id'));
                } else {
                    redirect($this->input->post('merchant_surl_id'));
                }
 
            } else {
                redirect($this->input->post('merchant_furl_id'));
            } */
			
			
        } else {
            echo 'An error occured. Contact site administrator, please!';
        }
    } 
    public function success1() {
        $data['title'] = 'Razorpay Success | TechArise';  
        //echo "<pre>";print_r($data);die();
		$this->load->view('razorpay/success', $data);
    }  
    public function failed1() {
        $data['title'] = 'Razorpay Failed | TechArise';  
		echo "<pre>";print_r($data);die();	
        $this->load->view('razorpay/failed', $data);
    } 
}
?>