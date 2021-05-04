<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'../zoom/config.php';

require_once(APPPATH."libraries/razorpay/razorpay-php/Razorpay.php");	
 
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class Payment extends CI_Controller
{


    function  __construct() {
        parent::__construct();
        $this->load->library('paypal_lib');		
		$this->load->library('session');
		$this->load->model('web/Home_view_model','home_view_model');
		 $this->load->model('admin/Venue_model','venue_model');
        //load appointment model
        $this->load->model('admin/Appointment_model','appointment_model');
        //Load Basic model
        $this->load->model('admin/basic_model','basic_model');
        //Load Schedule model
        $this->load->model('admin/Schedule_model','schedule_model');
        //Load Patient model
        $this->load->model('admin/Patient_model','patient_model');
        // Load sms setup model
        $this->load->model('admin/Sms_setup_model','sms_setup_model');
		// Load Doctor model
		$this->load->model('admin/Doctor_model','doctor_model');
		$this->load->model('admin/email/Email_model','email_model');
        $this->load->library('email');
    }
    

    public function index(){
		
        $doctor_id = $this->session->userdata('doctor_id');	
        //echo "Hello CI---".$doctor_id;	
        //echo "<pre>";print_r($_SESSION);
        
        $data['info'] = $this->db->select('*')->from('payment_account_setup')->where('doctor_id',$doctor_id)->get()->row();

        $this->load->view('admin/_header',$data);
		$meta_sql = "select * from metadata where id = '1'";
		$res_meta = $this->db->query($meta_sql);
		$data['meta_info'] = $res_meta->result_array();
		
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/view_payment_form');
        $this->load->view('admin/_footer');

    }



    public function save_setup(){

        $doctor_id = $this->session->userdata('doctor_id');
        $savedata = array(
                'doctor_id'     => $doctor_id,
                'paypal_email'  => $this->input->post('api_key',TRUE),
                'secret_key'  => $this->input->post('secret_key',TRUE),
                'amount'        => $this->input->post('amount',TRUE),
                'status'        => $this->input->post('status',TRUE)
            );

        $data = $this->db->select('*')->from('payment_account_setup')->where('doctor_id',$doctor_id)->get()->row();
        
        if($data!=NULL){
            $this->db->where('doctor_id',$doctor_id)->update('payment_account_setup',$savedata);
        }else{
            $this->db->insert('payment_account_setup',$savedata);
        }

        $this->session->set_flashdata("message","<div class='alert alert-success msg'>Setup Successfully</div>");
        redirect('admin/payment_method/Payment');
    }



    function pay_with_doctor($id){

        //Set variables for paypal form
        $returnURL = base_url().'admin/payment_method/payment/success/'.$id; //payment success url
        $cancelURL = base_url().'admin/payment_method/payment/cancel'; //payment cancel url
        $notifyURL = base_url().'admin/payment_method/payment/ipn'; //ipn url
        //get particular product data
        
        $info = $this->db->select('*')->from('appointment_tbl')->where('appointment_id',$id)->get()->row();

        @$fee = $this->db->select('*')->from('payment_account_setup')->where('doctor_id',$info->doctor_id)->get()->row();
        
		//echo "<pre>";print_r($info);die();
		
		$doctor_id = $info->doctor_id;
		$SQL2 = "select doctor_name,fees from doctor_tbl where doctor_id = '".$doctor_id."'";
		$query2 = $this->db->query($SQL2);
		$result2 = $query2->result_array();
		//echo "<pre>";print_r($result2);die();
		if(is_array($result2) && count($result2)>0){
			$fees = $result2[0]['fees'];
			$doctor_name = $result2[0]['doctor_name'];
		} 
		
		
	    $SQL3 = "select * from payment_account_setup where set_up_id = '1'";
		$query3 = $this->db->query($SQL3);
		$result3 = $query3->result_array();
		//echo "<pre>";print_r($result3);die();
		if(is_array($result3) && count($result3)>0){
			$admin_fees = $result3[0]['amount'];
			$api_key = $result3[0]['paypal_email'];
			$secret_key = $result3[0]['secret_key'];
			$p_status = $result3[0]['status'];
		}    
		if($fees==0){
		   $fees =  $admin_fees;
		}
		
		$venue_id = $info->venue_id;
		$SQL1 = "select venue_name,venue_contact,venue_address from venue_tbl where venue_id = '".$venue_id."'";
		$query1 = $this->db->query($SQL1);
		$result1 = $query1->result_array();
		if(is_array($result1) && count($result1)>0){
			$venue_name = $result1[0]['venue_name'];
			$venue_contact = $result1[0]['venue_contact'];
			$venue_address = $result1[0]['venue_address'];
		}		
		
        $logo = 'assets/images/logo.png';
        
       /*  $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);

        $this->paypal_lib->add_field('item_name', $id);
        $this->paypal_lib->add_field('custom', $id);
        $this->paypal_lib->add_field('item_number', 1);
        $this->paypal_lib->add_field('amount',  $fee->amount);
        $this->paypal_lib->paypal_auto_form(); */
		
		$itemInfo['item_name'] = $id;
		$itemInfo['item_number'] = 1;
		$itemInfo['price'] = $fees;
		$itemInfo['description'] = 'description';
		$itemInfo['product_id'] = $id;
		$itemInfo['name'] = 'name';
		$itemInfo['venue_name'] = $venue_name;
		$itemInfo['venue_contact'] = $venue_contact;
		$itemInfo['venue_address'] = $venue_address;
		$itemInfo['doctor_name'] = $doctor_name;
		
		//echo "<pre>";print_r($info);die();
		
		$data['title'] = 'Checkout payment | TechArise';  
        $data['itemInfo'] = $itemInfo; 
        $data['info'] = $info; 
        $data['return_url'] = site_url().'admin/payment_method/Razorpay/callback';
        $data['surl'] = site_url().'admin/payment_method/Razorpay/success';;
        $data['furl'] = site_url().'admin/payment_method/Razorpay/failed';;
        $data['currency_code'] = 'INR';
		
		if($api_key !="" && $secret_key != ""){
		    $RAZOR_KEY = $api_key;
		    $RAZOR_SECRET_KEY = $secret_key;
		}else{
		    $RAZOR_KEY = 'rzp_test_PLSeO0PkhIlcII';
		    $RAZOR_SECRET_KEY = 'SCiN6HoUwvkeMI1uB5VNbkWT';
		}
		$api = new Api($RAZOR_KEY, $RAZOR_SECRET_KEY);
		$_SESSION['payable_amount'] = $fees;
		$razorpayOrder = $api->order->create(array(
		  'receipt'         => rand(),
		  'amount'          => $_SESSION['payable_amount'] * 100, // 2000 rupees in paise
		  'currency'        => 'INR',
		  'payment_capture' => 1 // auto capture
		));
		$amount = $razorpayOrder['amount'];
		$razorpayOrderId = $razorpayOrder['id'];
		$_SESSION['razorpay_order_id'] = $razorpayOrderId;
		$_SESSION['merchant_order_id'] = $id;
		$data['r_data'] = $this->prepareData($amount,$razorpayOrderId,$id);
		
        $this->load->view('admin/razorpay/checkout', $data);

    }
	
	function pay_with_doctor_new(){
		
		
		
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
		
		$doctor_id = $this->input->post('doctor_id',TRUE);
		$p_name = $this->input->post('patient_name',TRUE);
		$p_email = $this->input->post('patient_email',TRUE);
		$p_phone = $this->input->post('patient_phone',TRUE);
		$p_age = $this->input->post('age',TRUE);
		$p_gender = $this->input->post('sex',TRUE);
		$create_date = date('Y-m-d h:i:s');
		$patient_id = $this->input->post('patient_id',TRUE);
		$birth_date = '';
		
		
		$patient_exist=0;
		$sql_log = "select * from log_info where email = '$p_email'";
		$res_log = $this->db->query($sql_log);
		$result_log = $res_log->result_array();
		if(is_array($result_log) && count($result_log)>0){
			$log_id = $result_log[0]['log_id'];
			$patient_exist=1;
			$sql_pat = "select * from patient_tbl where log_id = '".$log_id."'";
			$res_pat = $this->db->query($sql_pat);
			$result_pat = $res_pat->result_array();
			if(is_array($result_pat) && count($result_pat)>0){
				$patient_id = $result_pat[0]['patient_id'];
				$p_name     = $result_pat[0]['patient_name'];
				$p_phone     = $result_pat[0]['patient_phone'];
				$p_gender   = $result_pat[0]['sex'];
				$p_age      = $result_pat[0]['age'];
			}
		}else{
			//$log_id=0;
			$p_password = md5('PTele@123!');
			$pass_p = 'PTele@123!';
			$log_data = array(
				'email' => $p_email,
				'password' => $p_password,
				'user_type' => '3'
			);	
			$this->db->insert('log_info', $log_data);	
			$log_id = $this->db->insert_id();	
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
                                        <a href="https://telehealers.in/">
                                        <img src="https://telehealers.in/assets/uploads/images/telehe2.png">    
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
                                        <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Patient Account Details:</h2>
                                        <p>Name: '.$p_name.'</p>
                                        <p>ID: '.$patient_id.'</p>
										<p>Email: '.$p_email.'</p>
										<p>Password: '.$pass_p.'</p>
										
										
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
			$list = array($p_email);
			$ci->email->to($list);
			$this->email->reply_to('info@telehealers.in', 'telehealers');
			$ci->email->subject('Patient Account Details on telehealers.in');
			$ci->email->message($message);
			$ci->email->send();
		}	
		
		
		 $savedata =  array(
		'patient_id'    => $patient_id,
		'patient_name' => $p_name,
		'patient_email' => $p_email,
		'log_id' => $log_id,
		'patient_phone' => $p_phone, 
		'birth_date' => $birth_date,
		'doctor_id' => $doctor_id,
		'sex' => $p_gender,
		'age' => $p_age,
		'blood_group' => '',
		'address' => '',
		'picture' => '',
		'create_date'=>$create_date
		);
		$savedata = $this->security->xss_clean($savedata);
		if($patient_exist==0){
			$this->patient_model->save_patient($savedata);	
		}		
		
		
		$data['p_name'] = $p_name;
		$data['p_email'] = $p_email;
		$data['p_phone'] = $p_phone;
		$data['p_gender'] = $p_gender;
		$data['p_age'] = $p_age;
		
		$service1 = $this->input->post('service',TRUE);
		$service2 = $this->input->post('servicetype',TRUE);
		$date = $this->input->post('date',TRUE);
		
		$data['service1'] = $service1;
		$data['service2'] = $service2;
		
		date_default_timezone_set("Europe/Rome");
		$h = date('h')-1;
		$get_by = $this->session->userdata('log_id');

		$appointment_id = $this->input->post('appointment_id',TRUE);
		
		$venue_name = $this->input->post('venue_name',TRUE);
		$sequence = $this->input->post('sequence',TRUE);
		
		$per_patient_time = '30';
		$schedul_id = $this->input->post('schedul_id',TRUE);
		$sql_sh = "select * from schedul_setup_tbl where schedul_id = '".$schedul_id."'";
		$res_sh = $this->db->query($sql_sh);
		$result_sh = $res_sh->result_array();
		//echo "<pre>";print_r($result);die();
		if(is_array($result_sh) && count($result_sh)>0){
			$per_patient_time = $result_sh[0]['per_patient_time'];
		}
		

		$sql = "select * from doctor_tbl where doctor_id = '".$doctor_id."'";
		$res = $this->db->query($sql);
		$result = $res->result_array();
		if(is_array($result) && count($result)>0){
				$doctor_name = $result[0]['doctor_name'];
				$doc_id = $result[0]['doc_id'];
				$log_id = $result[0]['log_id'];
				$department = $result[0]['department'];
				$designation = $result[0]['designation'];
				$degrees = $result[0]['degrees'];
				$specialist = $result[0]['specialist'];
			}
		if($log_id>0){
			$sql_doc = "select * from log_info where log_id = '".$log_id."'";
			$res_doc = $this->db->query($sql_doc);
			$result_doc = $res_doc->result_array();
			if(is_array($result_doc) && count($result_doc)>0){
				$doctor_email = $result_doc[0]['email'];
			}
		}	
		
		$fees='';
		/* $coupon_code = $this->input->post('coupon_code_f',TRUE);
		$fees = $this->input->post('fees',TRUE);
	    $sql = "select * from promocode where title = '".$coupon_code."'";
		$res = $this->db->query($sql);
		$result = $res->result_array();
		$apply_coupon='';
		if(is_array($result) && count($result)>0){
			$coupon_id = $result[0]['id'];
			$price = $result[0]['price'];
			$p_limit = $result[0]['p_limit'];
			$p_used = $result[0]['p_used'];
			if($p_used==$p_limit){
				//echo "1";
			}else{
				$fees = $fees - $price;
				$p_used = $p_used + 1;	
				$sql_cc = "update promocode set p_used = '$p_used' where id = '$coupon_id'";
				$this->db->query($sql_cc);
				$apply_coupon=1;
			}
		} */
		
		/* if($apply_coupon==1){
			$coupon_code_in=$coupon_code;
		}else{
			$coupon_code_in = '';
		} */
		$appointment_id = $this->input->post('appointment_id',TRUE);
		$saveData = array(
		'date' => $this->input->post('date',TRUE),
		'patient_id' => $patient_id,
		'appointment_id' =>$appointment_id,
		'schedul_id' => $this->input->post('schedul_id',TRUE),
		'sequence' => $this->input->post('sequence',TRUE),
		'venue_id' => $this->input->post('venue_id',TRUE),
		'doctor_id' => $doctor_id,
		'problem' => $this->input->post('problem',TRUE),
		'service' => $service1,
		'servicetype' => $service2,
		'get_date_time' => date("Y-m-d h:i:s"),
		'get_by' => 'Won'
		);
		
		$this->appointment_model->SaveAppoin($saveData);
		
		
		$sql_tk = "select * from token where id = '1'";
		$res_tk = $this->db->query($sql_tk);
		$result_tk = $res_tk->result_array();
		if(is_array($result_tk) && count($result_tk)>0){
			$accessToken = $result_tk[0]['access_token'];
		}
		$client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
			
		$app_date_time = date('Y-m-d',strtotime($date)).'T'.$sequence;

		$metting_pass = '123456768';
		$response_z = $client->request('POST', '/v2/users/me/meetings', [
			"headers" => [
				"Authorization" => "Bearer $accessToken"
			],
			'json' => [
				"topic" => "Appointment Metting - $appointment_id",
				"type" => 2,
				"start_time" => $app_date_time,
				"duration" => $per_patient_time, // 30 mins
				"password" => $metting_pass
			]
		]);

		$data_zoom = json_decode($response_z->getBody());
		$zoom_meeting_url = $data_zoom->join_url;
	
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
                                        <p>Hey <strong>'.$p_name.'</strong>,</p>
                                        <p>Our staff member has confirmed you for a '.$service2.' appointment on '.date('d F Y',strtotime($date)).' with Dr. '.$doctor_name.'. If you have questions before your appointment,
                                            use the contact form with appointment ID to get in touch with us.</p>
										<h2 style="text-align:left;font-weight:600;color:#356d82">Zoom Meeting Details:</h2> 
										<p>Zoom meeting URL: '.$zoom_meeting_url.',</p>
										<p>Zoom meeting Password: '.$metting_pass.',</p>	
                                        <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Appointment ID - ('.$appointment_id.')</h2><h1></h1>
                                        <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Other Details:</h2><h1></h1>
                                        <p>Mode: '.$venue_name.'</p>
                                        <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Service Details:</h2><h1></h1>
                                        <p>Service Type: '.$service2.',</p>
										<h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Doctor Details:</h2><h1></h1>
                                        <p>Name: '.$doctor_name.'</p>
                                        <p>Designation: '.$designation.',</p>
										<p>Specialist: '.$specialist.'</p>
										<h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Patient Details:</h2>
                                        <p>Name: '.$p_name.'</p>
                                        <p>ID: '.$patient_id.'</p>
										<p>Email: '.$p_email.'</p>
										<p>Phone: '.$p_phone.'</p>
										<p>Age: '.$p_age.'</p>
										<p>Gender: '.$p_gender.',</p>
										<p>Tell us your symptom or health problem: '.$sequence.'</p>
										<p>Appointment Date: '.$date.'</p>
										<p>Appointment ID: '.$appointment_id.'</p>
										
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
		$list = array($p_email);
		$ci->email->to($list);
		$this->email->reply_to('info@telehealers.in', 'telehealers');
		$ci->email->subject('Appointment Information');
		$ci->email->message($message);
		$ci->email->send();
		
		$ci->email->from('info@telehealers.in', 'telehealers');
		$list = array($doctor_email);
		$ci->email->to($list);
		$this->email->reply_to('info@telehealers.in', 'telehealers');
		$ci->email->subject('Appointment Information');
		$ci->email->message($message);
		$ci->email->send();
				
		//echo "fees--".$fees."<br>";		
		//echo "appointment_id--".$appointment_id."<br>";		
		//die();	
		
		$id = $appointment_id;
        $returnURL = base_url().'admin/payment_method/payment/success/'.$id; //payment success 
        $cancelURL = base_url().'admin/payment_method/payment/cancel'; //payment cancel url
        $notifyURL = base_url().'admin/payment_method/payment/ipn'; //ipn url
        $info2 = $this->db->select('*')->from('appointment_tbl')->where('appointment_id',$id)->get()->row();

        @$fee = $this->db->select('*')->from('payment_account_setup')->where('doctor_id',$info2->doctor_id)->get()->row();
        
		
		
		$doctor_id = $info2->doctor_id;
		$SQL2 = "select doctor_name,fees from doctor_tbl where doctor_id = '".$doctor_id."'";
		$query2 = $this->db->query($SQL2);
		$result2 = $query2->result_array();
		
		if(is_array($result2) && count($result2)>0){
			//$fees = $result2[0]['fees'];
			$doctor_name = $result2[0]['doctor_name'];
		} 
		
		
	    $SQL3 = "select * from payment_account_setup where set_up_id = '1'";
		$query3 = $this->db->query($SQL3);
		$result3 = $query3->result_array();
		
		if(is_array($result3) && count($result3)>0){
			$admin_fees = $result3[0]['amount'];
			$api_key = $result3[0]['paypal_email'];
			$secret_key = $result3[0]['secret_key'];
			$p_status = $result3[0]['status'];
		}    
		
		
		$venue_id = $info2->venue_id;
		$SQL1 = "select venue_name,venue_contact,venue_address from venue_tbl where venue_id = '".$venue_id."'";
		$query1 = $this->db->query($SQL1);
		$result1 = $query1->result_array();
		if(is_array($result1) && count($result1)>0){
			$venue_name = $result1[0]['venue_name'];
			$venue_contact = $result1[0]['venue_contact'];
			$venue_address = $result1[0]['venue_address'];
		}		
		
        $logo = 'assets/images/logo.png';
        
        $itemInfo['item_name'] = $id;
		$itemInfo['item_number'] = 1;
		$itemInfo['price'] = $fees;
		$itemInfo['description'] = 'description';
		$itemInfo['product_id'] = $id;
		$itemInfo['name'] = 'name';
		$itemInfo['venue_name'] = $venue_name;
		$itemInfo['venue_contact'] = $venue_contact;
		$itemInfo['venue_address'] = $venue_address;
		$itemInfo['doctor_name'] = $doctor_name;
		
		$data['title'] = 'Checkout payment | TechArise';  
        $data['itemInfo'] = $itemInfo; 
        $data['info2'] = $info2; 
        $data['return_url'] = site_url().'admin/payment_method/Razorpay/callback';
        $data['surl'] = site_url().'admin/payment_method/Razorpay/success';;
        $data['furl'] = site_url().'admin/payment_method/Razorpay/failed';;
        $data['currency_code'] = 'INR';
		
		/* if($fees==0 || $fees==""){
		   $_SESSION['payable_amount'] = 0;
		   $_SESSION['razorpay_order_id'] = '';
		   $_SESSION['merchant_order_id'] = '';
		}else{
			if($api_key !="" && $secret_key != ""){
				$RAZOR_KEY = $api_key;
				$RAZOR_SECRET_KEY = $secret_key;
			}else{
				$RAZOR_KEY = 'rzp_test_PLSeO0PkhIlcII';
				$RAZOR_SECRET_KEY = 'SCiN6HoUwvkeMI1uB5VNbkWT';
			}
			$api = new Api($RAZOR_KEY, $RAZOR_SECRET_KEY);
			$_SESSION['payable_amount'] = $fees;
			$razorpayOrder = $api->order->create(array(
			  'receipt'         => rand(),
			  'amount'          => $_SESSION['payable_amount'] * 100, // 2000 rupees in paise
			  'currency'        => 'INR',
			  'payment_capture' => 1 // auto capture
			));
			$amount = $razorpayOrder['amount'];
			$razorpayOrderId = $razorpayOrder['id'];
			$_SESSION['razorpay_order_id'] = $razorpayOrderId;
			$_SESSION['merchant_order_id'] = $id;
			$data['r_data'] = $this->prepareData($amount,$razorpayOrderId,$id);
		} */
		
		
		$data['info'] = $this->home_view_model->Home_satup();
		//echo "<pre>";print_r($data['info']);die();
		
		$meta_sql = "select * from metadata where id = '1'";
		$res_meta = $this->db->query($meta_sql);
		$data['meta_info'] = $res_meta->result_array();
		
        $this->load->view('admin/razorpay/checkout', $data); 

    }


    public function success($id){

        if(!empty($id)){

            $info = $this->db->select('*')->from('action_serial')->where('appointment_id',$id)->get()->row();
            $patient = $this->db->select('*')->from('patient_tbl')->where('patient_id',$info->patient_id)->get()->row();
            $paymentamount = $this->db->select('*')->from('payment_account_setup')->where('doctor_id',$info->doctor_id)->get()->row();



            $paydata= array(

                'appointment_id'=>$info->appointment_id,
                'patient_id'=>$info->patient_id,
                'doctor_id'=>$info->doctor_id,
                'amount'=>$paymentamount->amount,
                'payer_email'=>$patient->patient_email,
                'date_time'=>date('Y-m-d H:i:s'),
                'payment_status'=>1,
                'notes'=>'test'
            );

            $this->db->insert('payment_table',$paydata);

            $id = $this->db->insert_id();

            redirect('admin/payment_method/payment/payment_receipt/'.$id);

           
        }else{
            redirect('admin/payment_manage');
        }
    }

    public function payment_receipt($payment_id){

        $payment_info = $this->db->where('payment_id',$payment_id)->get('payment_table')->row();

        $info = $this->db->select('*')->from('action_serial')->where('appointment_id',$payment_info->appointment_id)->get()->row();
        $patient = $this->db->select('*')->from('patient_tbl')->where('patient_id',$payment_info->patient_id)->get()->row();



        $data['appointment_info'] = $info;
        $data['patient'] = $patient;
        $data['info'] = $this->home_view_model->Home_satup();
        $data['payment_info'] = $payment_info;
		
		$meta_sql = "select * from metadata where id = '1'";
		$res_meta = $this->db->query($meta_sql);
		$data['meta_info'] = $res_meta->result_array();
        
        $this->load->view('public/payment_success',$data);
    }



    public function cancel(){
        $data['info'] = $this->home_view_model->Home_satup();
        $this->load->view('public/pay_error',$data);
    }

	public function prepareData($amount,$razorpayOrderId,$id)
    {
		$SQL2 = "select patient_id from appointment_tbl where appointment_id = '".$id."'";
		$query2 = $this->db->query($SQL2);
		$result2 = $query2->result_array();
		if(is_array($result2) && count($result2)>0){
			$patient_id = $result2[0]['patient_id'];
		}
		$SQL3 = "select patient_name,patient_email,patient_phone from patient_tbl where patient_id = '".$patient_id."'";
		$query3 = $this->db->query($SQL3);
		$result3 = $query3->result_array();
		if(is_array($result3) && count($result3)>0){
			$patient_name = $result3[0]['patient_name'];
			$patient_email = $result3[0]['patient_email'];
			$patient_phone = $result3[0]['patient_phone'];
		}		
		
		
    $data = array(
      "key" => 'rzp_test_PLSeO0PkhIlcII',
      "amount" => $amount,
      "name" => $patient_name,
      "merchant_order_id" => $id,
      "description" => "Appointment Fees",
      "image" => "https://demo.codingbirdsonline.com/website/img/coding-birds-online/coding-birds-online-favicon.png",
      "prefill" => array(
        "name"  => $patient_name,
        "email"  => $patient_email,
        "contact" => $patient_phone,
      ),
      "notes"  => array(
        "address"  => "From telehealers.in",
        "merchant_order_id" => $id,
      ),
      "theme"  => array(
        "color"  => "#F37254"
      ),
      "order_id" => $razorpayOrderId,
    );
    return $data;
  }


    public function ipn(){
        
       //paypal return transaction details array
        $paypalInfo    = $this->input->post();
        $id = $paypalInfo['custom'];
        $info = $this->db->select('*')->from('appointment_tbl')->where('appointment_id',$id)->get()->row();  
        $data['patient_id'] = $paypalInfo['custom'];
        $data['payer_email'] = $paypalInfo["payer_email"];
        $data['doctor_id']    = $info->doctor_id;
        $data['amount']    = $paypalInfo["amount"];
        $data['payment_status']    = $paypalInfo["payment_status"];
        $paypalURL = $this->paypal_lib->paypal_url;        
        $result    = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
        if(preg_match("/VERIFIED/i",$result)){

            $this->db->insert('payment_table',$data);
            echo "string";
             
        }

    }
}