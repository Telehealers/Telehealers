<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'../zoom/config.php';

class Doctorlogin extends CI_Controller {
/*
|--------------------------------------
|   constructor funcion
|--------------------------------------
*/ 
	public function __construct() 
	{
		parent::__construct();
		$this->load->library('email');
		
		$info= $this->db->select('*')->from('web_pages_tbl')->where('name','website_on_off')->get()->row();
    
        if($info->details=='off'){
          redirect('login');
        }
        //Load Home_view_model
        $this->load->model('web/Home_view_model','home_view_model');
        //Load Overview model
        $this->load->model('admin/Overview_model','overview_model');
        //Load venue model
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
        //
        $this->load->library('Smsgateway');
		
         $this->load->model('admin/email/Email_model','email_model');
        $this->load->library('email');
  }



/*
|--------------------------------------
|   View home page in the website
|--------------------------------------
*/
	public function index($patient_id=NULL)
	{
		$user_type = $this->session->userdata('user_type');
		$log_id = $this->session->userdata('log_id');
		
		//setup information
        $data['info'] = $this->home_view_model->Home_satup();
       
		$meta_sql = "select * from metadata where id = '6'";
		$res_meta = $this->db->query($meta_sql);
		$data['meta_info'] = $res_meta->result_array();
      

        #------view page----------
        $this->load->view('doctorlogin',$data);
	}

	/**A function to send check user via sending OTP */
	public function checkUser(){
		$phone = $this->input->post('phone',TRUE);
		
		$sql_doc = "select * from doctor_tbl where doctor_phone = '".$phone."'";
		$res_doc = $this->db->query($sql_doc);
		$result_doc = $res_doc->result_array();
		if(is_array($result_doc) && count($result_doc)>0){
			$new_otp = rand(1000,9999);
			$sql = "update doctor_tbl set opt_code = '$new_otp' where doctor_phone = '$phone'";
			$this->db->query($sql);
			$this->smsgateway->send_sms($phone, $this->smsgateway->msg_otp($new_otp));			
			echo '1';
		}else{
			echo '0';
		}	
	}
	
	public function userLogin(){
		$phone = $this->input->post('phone',TRUE);
		$otp = $this->input->post('otp',TRUE);
		$sql = "select * from doctor_tbl where doctor_phone = '".$phone."'";
		$res_doc = $this->db->query($sql);
		$result_doc = $res_doc->result_array();
		if(is_array($result_doc) && count($result_doc)>0){
			$doctor_name = $result_doc[0]['doctor_name'];
			$opt_code = $result_doc[0]['opt_code'];
			$doctor_id = $result_doc[0]['doctor_id'];
			$picture = $result_doc[0]['picture'];
			$log_id = $result_doc[0]['log_id'];
			$approve = $result_doc[0]['approve'];
			$sql_lg = "select * from log_info where log_id = '$log_id'";
			$res =  $this->db->query($sql_lg);
			$result = $res->result_array();
			$doctor_email = '';
			if(is_array($result) && count($result)>0){
				$doctor_email = $result[0]['email'];
			}
			if($opt_code!=$otp){
				echo '1';
			}else{
				$sql_em = "update doctor_tbl set opt_code = '' where doctor_phone = '$phone'";
				$this->db->query($sql_em);
				$session_data = array(
                    'log_id' => $log_id,
                    'doctor_id' => $doctor_id,
                    'doctor_name' => $doctor_name,
                    'doctor_picture' => $picture,
                    'email' => $doctor_email,
                    'user_type' => 1,
                    'session_id' => session_id(),
                    'logged_in' => TRUE
                );
				$this->session->set_userdata($session_data);
				if($approve==2){
					echo '2';	
				}else{
					echo '3';		
				}
				
			}
		}else{
			echo '0';
		}
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Doctorlogin');
	}
	
	public function approve(){
		$user_type = $this->session->userdata('user_type');
		$log_id = $this->session->userdata('log_id');
		
		$approve=0;
		$sql = "select * from doctor_tbl where log_id = '$log_id'";
		$res = $this->db->query($sql);
		$result = $res->result_array();
		if(is_array($result) && count($result)>0){
			$approve = $result[0]['approve'];
		}
		$content = '';
		$sqlC = "select * from doctor_content where id = '1'";
		$resC = $this->db->query($sqlC);
		$resultC = $resC->result_array();
		if(is_array($resultC) && count($resultC)>0){
			$content = $resultC[0]['content'];
		}
		//setup information
        $data['info'] = $this->home_view_model->Home_satup();
       
		$meta_sql = "select * from metadata where id = '6'";
		$res_meta = $this->db->query($meta_sql);
		$data['meta_info'] = $res_meta->result_array();
		$data['approve'] = $approve;
		$data['content'] = $content;
      

        #------view page----------
        $this->load->view('doctorapprove',$data);
	}
	
	public function approverequest(){
		$user_type = $this->session->userdata('user_type');
		$log_id = $this->session->userdata('log_id');
		$approve=0;
		$doctor_email='';
		$doctor_name='';
		$sql = "select * from doctor_tbl where log_id = '$log_id'";
		$res = $this->db->query($sql);
		$result = $res->result_array();
		if(is_array($result) && count($result)>0){
			$approve = $result[0]['approve'];
			$doctor_name = $result[0]['doctor_name'];
			$doctor_phone = $result[0]['doctor_phone'];
		}
		$sqld = "select * from log_info where log_id = '$log_id'";
		$resd = $this->db->query($sqld);
		$resultd = $resd->result_array();
		if(is_array($resultd) && count($resultd)>0){
			$doctor_email = $resultd[0]['email'];
		}
		if($approve==0){
			$sql_ud = "update doctor_tbl set approve = '1' where log_id = '$log_id'";
			$this->db->query($sql_ud);
			$ci = get_instance();
		$ci->load->library('email');
		
		$email_config = $this->email_model->email_config();
		//Necessary Initialization
		$protocol = NULL;
		$smtp_host = NULL;
		$smtp_port = NULL;
		$smtp_user = NULL;
		$smtp_pass = NULL;
		if(is_array($email_config) && count($email_config)>0){
			$protocol = $email_config->protocol;
			$smtp_host = $email_config->mailpath;
			$smtp_port = $email_config->port;
			$smtp_user = $email_config->sender;
			$smtp_pass = $email_config->mailtype;
		}
        $config['protocol'] = $protocol;
        $config['smtp_host'] = $smtp_host;
        $config['smtp_port'] = $smtp_port;
        $config['smtp_user'] = $smtp_user; 
        $config['smtp_pass'] = $smtp_pass;
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
		$ci->email->initialize($config);
		
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
                                        <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Hello, </h2>
										<p>'.$doctor_name.' has joined our Platform! </p>
										<p>Email -	'.$doctor_name.'</p>
										<p>Phone -	'.$doctor_phone.'</p>
										<p>&nbsp;</p>
										<p>Kindly verify the details and activate the account.</p>
										<p>&nbsp;</p>
										<p>Regards: telehealers.in</p>
										<p>&nbsp;</p>
								    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody></table>
                
            
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tbody><tr>
                    <td class="bg_white" style="text-align: center;">
                    </td>
                </tr>
            </tbody></table>

        </div>
    </center>


</body></html>';
			
			//admin email
			//$to_email = 'raghuveer@ecomsolver.com';
			$to_email = 'info@telehealers.in';
			$ci->email->from('info@telehealers.in', 'telehealers');
			$list = array($to_email);
			$ci->email->to($list);
			$this->email->reply_to('info@telehealers.in', 'telehealers');
			$ci->email->subject('Doctor accept term & condition on telehealers.in');
			$ci->email->message($message);
			$ci->email->send();
		
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
                                        <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Hi '.$doctor_name.',</h2>
										<p>Welcome to Telehealers. We’re super happy to see you on board!</p>
										<p>We’re sure that Telehealers platforms will help to overcome the crisis in the healthsector.</p>
										<p>Your account will be activated very soon and You’ll be guided</p>
										<p>through Telehealers`s experts, </p>
										<p>to ensure that you get familiar with the platform to use it.</p>
										<p>&nbsp;</p>
										<p>Take care!</p>
										<p>Telehealers Team</p>
										<p>&nbsp;</p>
								    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody></table>
                
            
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tbody><tr>
                    <td class="bg_white" style="text-align: center;">
                    </td>
                </tr>
            </tbody></table>

        </div>
    </center>


</body></html>';

			//doctor_email
			//$to_email = 'raghuveer@ecomsolver.com';
			$ci->email->from('info@telehealers.in', 'telehealers');
			$list = array($doctor_email);
			$ci->email->to($list);
			$this->email->reply_to('info@telehealers.in', 'telehealers');
			$ci->email->subject('Doctor accept term & condition on telehealers.in');
			$ci->email->message($message);
			$ci->email->send();
				
			
		}
		
		
		
		
       redirect('Doctorlogin/approve');
	}

}
