<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'../zoom/config.php';

class Appointment extends CI_Controller {
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
		$this->load->library('session');
        //
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
	    
		$email_config = $this->email_model->email_config();
		
        //get_schedule_list
        $data['schedule'] = $this->schedule_model->get_schedule_list();
        //setup information
        $data['info'] = $this->home_view_model->Home_satup();
        //get doctor_info
        $data['doctor_info'] = $this->home_view_model->doctor_info();
        //load slider
        $data['slider'] = $this->home_view_model->Slider(); 
        //total_appointment
        $data['total_appointment'] = $this->overview_model->total_appointment();
        //total_patient
        $data['total_patient'] = $this->overview_model->total_patient();
        //to_day_appointment
        $data['to_day_appointment'] = $this->overview_model->to_day_appointment();
        //to_day_get_appointment
        $data['to_day_get_appointment'] = $this->overview_model->to_day_get_appointment();
        // testimonial
        $data['testimonial'] = $this->db->get('testimonial')->result();
		$data['faq'] = $this->db->get('faq')->result();
        $data['theraphists'] = $this->db->get('theraphists')->result();
        $data['commitements'] = $this->db->get('commitements')->result();
        // Post
        $data['post'] = $this->home_view_model->get_all_post();
		//get venue list
        $data['venue'] = $this->venue_model->get_venue_list();
		
		$data['service'] = $this->db->get('service')->result();
		
		//get doctor list for appointmaent
		$data['doctor_info_for_appo'] = $this->doctor_model->getDoctorListByselect();
		
		$language_arr = array();
		$language_str = $this->doctor_model->getDoctorListByselect();
		if(is_array($language_str) && count($language_str)>0){
			foreach($language_str as $val){
				$lan_str = trim($val['language']);
				if($lan_str!=""){
					$lan_arr = explode(',',$lan_str);
					foreach($lan_arr as $lang){
						$language_arr[] = trim($lang);
					}	
				}				
			}
		}
		$language_arr = array_unique($language_arr);
		//echo "<pre>";print_r($language_arr);die();	
		
		$data['language_arr'] = $language_arr;

        $meta_sql = "select * from metadata where id = '4'";
		$res_meta = $this->db->query($meta_sql);
		$data['meta_info'] = $res_meta->result_array();

        #------view page----------
        $this->load->view('appointment',$data);
	}

/*
|--------------------------------------
|   patient id genaretor
|--------------------------------------
*/
  function randstrGen($mode=null,$len=null)
  {
        $result = "";
        if($mode == 1):
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 2):
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        elseif($mode == 3):
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 4):
        $chars = "0123456789";
        endif;
        $charArray = str_split($chars);
        for($i = 0; $i < $len; $i++) {
        $randItem = array_rand($charArray);
        $result .="".$charArray[$randItem];
        }
        return $result;
  }


#-----------------------------------------------
#    random coad genaretor of appointmaent id
#----------------------------------------------  
function randstrGenapp($len) 
{
    $result = "";
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    $charArray = str_split($chars);
    for($i = 0; $i < $len; $i++) {
            $randItem = array_rand($charArray);
            $result .="".$charArray[$randItem];
    }
    return $result;
}

#-----------------------------------------------
#   Superpro API: Create call room.
#	Returns Video call link.
#-----------------------------------------------
function createVideoCallRoom($doctor_name, $doctor_email, $patient_name, $patient_email) {
	$curl_session = curl_init();
	curl_setopt_array($curl_session, array(
		CURLOPT_URL => getenv('SUPERPRO_CREATE_VIDEOCALL_API_ENDPOINT'),
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
		"usersAdd":[
			{
				"name":"'.$doctor_name.'",
				"email":"'.$doctor_email.'",
				"role":"host"
			},
			{
				"name":"'.$patient_name.'",
				"email":"'.$patient_email.'",
				"role":"aud"
			}
		]
	}
	',
		CURLOPT_HTTPHEADER => array(
		'Authorization: Bearer '.getenv('SUPERPRO_AUTH_TOKEN'),
		'Content-Type: application/json'
		),
	));
	try{
		$superpro_response = curl_exec($curl_session);
		if (!$superpro_response) {
			throw new Exception("Video call api not working", 1);
	}}			
	catch(\Exception $e){
			log_message('error',$e->getMessage());
			show_404();
	}


	
	curl_close($curl_session);
	$superpro_data = json_decode($superpro_response);
	return $superpro_data->videoCallUrl ;
	
}
#-----------------------------------------------
#   Input: Client & Dr. Details in HTML in <p>...</p> format.
#	Returns: Email msg for a video-call.
#-----------------------------------------------
function createVideoCallInformationMail($participantInfoHTML) {
	return '<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
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
											'.$participantInfoHTML.'
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
	</body></html>' ;
}

#-----------------------------------------------
#    save appointmaent 
#----------------------------------------------  

 public function appointment(){ 
		$this->form_validation->set_rules('p_date', 'Date', 'trim|required');
		//$this->form_validation->set_rules('patient_id', 'Patient Id', 'trim|required');
		$this->form_validation->set_rules('venue_id', 'venue', 'trim|required'); 
		$this->form_validation->set_rules('sequence', 'sequence', 'trim|required');
		
		$sequence = $this->input->post('sequence',TRUE);
		
		$app_type_val = $this->input->post('app_type_val',TRUE);
		$service1 = $this->input->post('service1',TRUE);
		$service2 = $this->input->post('service2',TRUE);
		if($app_type_val==1){
			$doctor_id = $this->input->post('doc_idd',TRUE);
			$sequence = $this->input->post('slot_idd',TRUE);
		}else{
			$doctor_id = $this->input->post('doctor_id');
		}
		//echo $doctor_id.'/'.$sequence;die(); 
		/* if($this->input->post('doctor_id')){
			$doctor_id = $this->input->post('doctor_id');
		}else{
			$doctor_id = '1';
		}
		if($this->input->post('service5') != ""){
			$doctor_id = $this->input->post('service5');
		}else{
			$doctor_id = '1';
		} */
		

		$p_name = $this->input->post('p_name',TRUE);
		$p_email = $this->input->post('p_email',TRUE);
		$p_phone = $this->input->post('p_phone',TRUE);
		$p_age = $this->input->post('p_age',TRUE);
		$p_gender = $this->input->post('p_gender',TRUE);
		$existing_user = $this->input->post('existing_user',TRUE);
		if($existing_user==1){
			$sql_p = "select * from patient_tbl where patient_email = '$p_email'";
			$res_p = $this->db->query($sql_p);
			$result_p = $res_p->result_array();
			//echo "<pre>";print_r($result);die();
			if(is_array($result_p) && count($result_p)>0){
				$patient_id = $result_p[0]['patient_id'];
				$patient_name = $result_p[0]['patient_name'];
				$patient_phone = $result_p[0]['patient_phone'];
				$sex = $result_p[0]['sex'];
				$age = $result_p[0]['age'];
				if($p_name==""){
					$p_name = $patient_name;
				}
				if($p_phone==""){
					$p_phone = $patient_phone;
				}
				if($p_age==""){
					$p_age = $age;
				}
				if($p_gender==""){
					$p_gender = $sex;
				}
				$sql_u = "update patient_tbl set patient_name = '$p_name', patient_phone = '$p_phone', sex = '$p_gender', age = '$p_age' where patient_email = '$p_email'";	
				$this->db->query($sql_u);
			}
		
		}else{
			$patient_id = "P".date('y').strtoupper($this->randstrGenapp(5));
		}
		
		$create_date = date('Y-m-d h:i:s');
		
		$birth_date = '';
		 $patient_info =  array(
		'patient_id'    => $patient_id,
		'patient_name' => $p_name,
		'patient_email' => $p_email,
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
		
		
	
		$data['patient_info'] = $patient_info;
		$data['service1'] = $service1;
		$data['service2'] = $service2;
		$venue_id = $this->input->post('venue_id',TRUE);
		$sql = "select * from venue_tbl where venue_id = '".$venue_id."'";
		$res = $this->db->query($sql);
		$result = $res->result_array();
		//echo "<pre>";print_r($result);die();
		if(is_array($result) && count($result)>0){
			$venue_name = $result[0]['venue_name'];
			$venue_contact = $result[0]['venue_contact'];
			$venue_address = $result[0]['venue_address'];
		}
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
			$fees = $result[0]['fees'];
		}
				
		$appointment_id = "A".date('y').strtoupper($this->randstrGenapp(5));
		$appointmentData = array(
            'doctor_name' => $doctor_name,
            'fees' => $fees, 
            'date' => $this->input->post('p_date',TRUE),
            'patient_id' => $patient_id,
            'appointment_id' =>$appointment_id,
            'schedul_id' => $this->input->post('schedul_id',TRUE),
            'sequence' => $sequence,
            'venue_id' => $this->input->post('venue_id',TRUE),
            'venue_name' => $venue_name,
            'doctor_id' => $doctor_id,
            'problem' => $this->input->post('problem',TRUE),
            'service' => $this->input->post('service1',TRUE),
            'servicetype' => $this->input->post('service2',TRUE),
			'get_date_time' => date("Y-m-d h:i:s"),
			'per_patient_time' => $per_patient_time,
            'get_by' => 'Won'
        );
		$data['appointmentData'] = $appointmentData;	
		
		//echo "<pre>";print_r($data);die();
		$data['info'] = $this->home_view_model->Home_satup();
		
		$this->load->view('public/process_appointment_info',$data); 
		
	}
	
	public function confirmation(){
		
		$ci = get_instance();
		$ci->load->library('email');
		
		$email_config = $this->email_model->email_config();
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
		
		$this->form_validation->set_rules('p_date', 'Date', 'trim|required');
		//$this->form_validation->set_rules('patient_id', 'Patient Id', 'trim|required');
		$this->form_validation->set_rules('venue_id', 'venue', 'trim|required'); 
		$this->form_validation->set_rules('sequence', 'sequence', 'trim|required');
		
		$sequence = $this->input->post('sequence',TRUE);
		
		$app_type_val = $this->input->post('app_type_val',TRUE);
		$service1 = $this->input->post('service1',TRUE);
		$service2 = $this->input->post('service2',TRUE);
		if($app_type_val==1){
			$doctor_id = $this->input->post('doc_idd',TRUE);
			$sequence = $this->input->post('slot_idd',TRUE);
			$schedul_id = $this->input->post('sh_idd',TRUE);
			
		}else{
			$doctor_id = $this->input->post('doctor_id');
			$schedul_id = $this->input->post('schedul_id',TRUE);
		}
		
		
		//echo $doctor_id."/".$sequence."/".$schedul_id;die(); 
		//echo $schedul_id;die(); 
		/* if($this->input->post('doctor_id')){
			$doctor_id = $this->input->post('doctor_id');
		}else{
			$doctor_id = '1';
		}
		if($this->input->post('service5') != ""){
			$doctor_id = $this->input->post('service5');
		}else{
			$doctor_id = '1';
		} */
		
		$p_name = $this->input->post('p_name',TRUE);
		$p_email = $this->input->post('p_email',TRUE);
		$p_phone = $this->input->post('p_phone',TRUE);
		$p_age = $this->input->post('p_age',TRUE);
		$p_gender = $this->input->post('p_gender',TRUE);
		//$existing_user = $this->input->post('existing_user',TRUE);
		$existing_user = 0;
		$patient_id = "P".date('y').strtoupper($this->randstrGenapp(5));
		
		$patient_exist=0;
		$sql_log = "select * from log_info where email = '$p_email'";
		$res_log = $this->db->query($sql_log);
		$result_log = $res_log->result_array();
		if(is_array($result_log) && count($result_log)>0){
			$log_id = $result_log[0]['log_id'];
			$p_log_id = $result_log[0]['log_id'];
			$patient_exist=1;
			$sql_pat = "select * from patient_tbl where log_id = '".$log_id."'";
			$res_pat = $this->db->query($sql_pat);
			$result_pat = $res_pat->result_array();
			if(is_array($result_pat) && count($result_pat)>0){
				$patient_id = $result_pat[0]['patient_id'];
				$existing_user=1;
			}else{
				$patient_data = array(
					'patient_id' => $patient_id,
					'log_id' => $log_id,
					'patient_name' => $p_name,
					'patient_email' => $p_email,
					'patient_phone' => $p_phone,
					'sex' => $p_age,
					'age' => $p_gender,
					'doctor_id' => $doctor_id
				);	
				$this->db->insert('patient_tbl', $patient_data);
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
			$p_log_id = $log_id;
			$message = $this->createVideoCallInformationMail('
				<h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Dear '.$p_name.':</h2>
				<p>Thanks for choosing telehealers.in</p>
				<p>Kindly visit Your dashboard using registered mobile number.</p>
				<p>Url:  https://telehealers.in/Userlogin</p>
				<p>Name: '.$p_name.'</p>
				<p>ID: '.$patient_id.'</p>
				<p>Email: '.$p_email.'</p>
				<p>&nbsp;</p>
				<p>Keep in touch during this tough time! </p>
				<p>Kindly write us back without any hasitation if you find any issues at support@telehealers.in</p>');

			$ci->email->from('info@telehealers.in', 'telehealers');
			$list = array($p_email);
			$ci->email->to($list);
			$this->email->reply_to('info@telehealers.in', 'telehealers');
			$ci->email->subject('Patient Account Details on telehealers.in');
			$ci->email->message($message);
			$ci->email->send();
		}
		
		
		if($existing_user==1){
			$sql_p = "select * from patient_tbl where patient_email = '$p_email'";
			$res_p = $this->db->query($sql_p);
			$result_p = $res_p->result_array();
			//echo "<pre>";print_r($result);die();
			if(is_array($result_p) && count($result_p)>0){
				$patient_id = $result_p[0]['patient_id'];
				//$patient_name = $result_p[0]['patient_name'];
				//$patient_phone = $result_p[0]['patient_phone'];
				//$sex = $result_p[0]['sex'];
				//$age = $result_p[0]['age'];
				/* if($p_name==""){
					$p_name = $patient_name;
				}
				if($p_phone==""){
					$p_phone = $patient_phone;
				}
				if($p_age==""){
					$p_age = $age;
				}
				if($p_gender==""){
					$p_gender = $sex;
				} */
				//$sql_u = "update patient_tbl set patient_name = '$p_name', patient_phone = '$p_phone', sex = '$p_gender', age = '$p_age' where patient_email = '$p_email'";	
				//$this->db->query($sql_u);
			}
		
		}else{
			
		}
		
		$create_date = date('Y-m-d h:i:s');
		$birth_date='';
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
		
		
		//echo 'schedul_id--'.$schedul_id;die();
	
		$data['patient_info'] = $savedata;
		$data['service1'] = $service1;
		$data['service2'] = $service2;
		$venue_id = $this->input->post('venue_id',TRUE);
		$sql = "select * from venue_tbl where venue_id = '".$venue_id."'";
		$res = $this->db->query($sql);
		$result = $res->result_array();
		//echo "<pre>";print_r($result);die();
		if(is_array($result) && count($result)>0){
			$venue_name = $result[0]['venue_name'];
			$venue_contact = $result[0]['venue_contact'];
			$venue_address = $result[0]['venue_address'];
		}
		$per_patient_time = '30';
		
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
			$fees = $result[0]['fees'];
		}
				
		$appointment_id = "A".date('y').strtoupper($this->randstrGenapp(5));
		
		$date = $this->input->post('p_date',TRUE);
		
		$appointmentData = array(
		'date' => $this->input->post('p_date',TRUE),
		'patient_id' => $patient_id,
		'appointment_id' =>$appointment_id,
		'schedul_id' => $schedul_id,
		'sequence' => $sequence,
		'venue_id' => $this->input->post('venue_id',TRUE),
		'doctor_id' => $doctor_id,
		'problem' => $this->input->post('problem',TRUE),
		'service' => $service1,
		'servicetype' => $service2,
		'get_date_time' => date("Y-m-d h:i:s"),
		'get_by' => 'Won'
		);
		
		$p_cc = $this->input->post('problem',TRUE);

		$this->appointment_model->SaveAppoin($appointmentData);
		
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
		
		$sql_tk = "select * from token where id = '1'";
		$res_tk = $this->db->query($sql_tk);
		$result_tk = $res_tk->result_array();
		if(is_array($result_tk) && count($result_tk)>0){
			$accessToken = $result_tk[0]['access_token'];
			$refershToken = $result_tk[0]['refersh_token'];
		}
		
		if($refershToken!="" && $accessToken!=""){
<<<<<<< HEAD
			/** Video call room creation **/				
			$superpro_meeting_url = $this->createVideoCallRoom(
				$doctor_name, $doctor_email,
				$p_name, $p_email);
			$meeting_pass = '';
=======
			
			try {
				$client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
				$date_g = '12-07-2021';
				$sequence_g = '6:15 PM';
				$app_date_time = date('Y-m-d',strtotime($date)).'T'.$sequence.":00";
				$meeting_pass = '123456768';
				
				$response_z = $client->request('POST', '/v2/users/me/meetings', [
					"headers" => [
						"Authorization" => "Bearer $accessToken"
					],
					'json' => [
						"topic" => "Appointment Meeting - $appointment_id",
						"type" => 2,
						"start_time" => $app_date_time,
						"duration" => $per_patient_time, // 30 mins
						"timezone" => 'Asia/Calcutta', // 30 mins
						"password" => $meeting_pass
					]
				]);

				$data_zoom = json_decode($response_z->getBody());
				$zoom_meeting_url = $data_zoom->join_url;
			} catch(Exception $e) {
				$meeting_pass = '';
				$zoom_meeting_url = '';
			}
>>>>>>> 9df9bc55152fe8f093c70e9a4af075c2e041d4cf
		}else{
			$meeting_pass = '';
			$superpro_meeting_url = '';
		}

		$symt1 = $superpro_meeting_url;
		$symt2 = $meeting_pass;
		
		$sql_m = "update appointment_tbl set symt1 = '".$symt1."',symt2 = '".$symt2."' where appointment_id = '$appointment_id'";
		$this->db->query($sql_m);
		
		
		
		$message = $this->createVideoCallInformationMail('
			<p>Hey <strong>'.$p_name.'</strong>,</p>
			<p>Our staff member has confirmed you for a '.$service2.' appointment on '.date('jS F Y',strtotime($date)).' with Dr. '.$doctor_name.'. If you have questions before your appointment,
				use the contact form with appointment ID to get in touch with us.</p>
			<h2 style="text-align:left;font-weight:600;color:#356d82">Videocall Details:</h2> 
			<p>Superpro video call link: '.$superpro_meeting_url.',</p>
			<h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Appointment ID - ('.$appointment_id.')</h2><h1></h1>
			<h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Doctor Details:</h2><h1></h1>
			<p>Name: '.$doctor_name.'</p>
			<h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Patient Details:</h2>
			<p>Name: '.$p_name.'</p>
			<p>ID: '.$patient_id.'</p>
			<p>Email: '.$p_email.'</p>
			<p>Phone: '.$p_phone.'</p>
			<p>Age: '.$p_age.'</p>
			<p>Gender: '.$p_gender.',</p>
			<p>Tell us your symptom or health problem: '.$p_cc.'</p>
			<p>Appointment Date: '.date('jS F Y',strtotime($date)).'</p>
			<p>Appointment Time: '.date('h:i A', strtotime($sequence)).'</p>
			<p>Appointment ID: '.$appointment_id.'</p>');

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
		
		
		$appointmentData = array(
		'date' => $this->input->post('p_date',TRUE),
		'patient_id' => $patient_id,
		'doctor_name' => $doctor_name,
		'appointment_id' =>$appointment_id,
		'schedul_id' => $schedul_id,
		'sequence' => $sequence,
		'venue_id' => $this->input->post('venue_id',TRUE),
		'venue_name' => $venue_name,
		'doctor_id' => $doctor_id,
		'problem' => $this->input->post('problem',TRUE),
		'service' => $service1,
		'servicetype' => $service2,
		'get_date_time' => date("Y-m-d h:i:s"),
		'get_by' => 'Won',
		'fees' => '0'
		);

		$data['appointmentData'] = $appointmentData; 	
		
		//echo "<pre>";print_r($data);die();
		$data['info'] = $this->home_view_model->Home_satup();
		
		$app_time = date('h:i A', strtotime($sequence));
		$app_date = date('jS F Y',strtotime($this->input->post('p_date',TRUE)));
		
		$mes = 'You have successfully registered and made an appointment with '.$doctor_name.' on '.$app_date.'-'.$app_time.'<br>Welcome to your patient dashboard here you can see all your appointments, prescriptions and tests that you upload to the portal. You can always login back using the registered mobile number - '.$p_phone;
		$session_data = array(
			'log_id' => $p_log_id,
			'user_id' => $patient_id,
			'user_name' => $p_name,
			'user_picture' => '',
			'user_email' => $p_email,
			'user_type' => '3',
			'session_id' => session_id(),
			'logged_in' => TRUE
		);
		$this->session->set_userdata($session_data);
		$this->session->set_flashdata('message',"<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$mes."</div>");
        redirect('Patient');
		//$this->load->view('public/process_appointment_info',$data); 
	}
	
	public function patientAppointment(){
		
		$ci = get_instance();
		$ci->load->library('email');
		
        $email_config = $this->email_model->email_config();
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
		
		$p_date = $this->input->post('p_date',TRUE);
		$patient_id = $this->input->post('patient_id',TRUE);
		$schedul_id = $this->input->post('schedul_id',TRUE);
		$sequence = $this->input->post('sequence',TRUE);
		$doctor_id = $this->input->post('doctor_id',TRUE);
		$problem = $this->input->post('problem',TRUE);
		$venue_id = '3';
		$venue_name = 'Online';
		
		$app_type_val = $this->input->post('app_type_val',TRUE);
		$service1 = 'Consultation for COVID-19';
		
		$sql_pat = "select * from patient_tbl where patient_id = '".$patient_id."'";
		$res_pat = $this->db->query($sql_pat);
		$result_pat = $res_pat->result_array();
		if(is_array($result_pat) && count($result_pat)>0){
			$p_name = $result_pat[0]['patient_name'];
			$p_email = $result_pat[0]['patient_email'];
			$p_phone = $result_pat[0]['patient_phone'];
			$p_gender = $result_pat[0]['sex'];
			$p_age = $result_pat[0]['age'];
			$p_log_id = $result_pat[0]['log_id'];
		}	
		
		$per_patient_time = '15';
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
			$fees = $result[0]['fees'];
		}
				
		$appointment_id = "A".date('y').strtoupper($this->randstrGenapp(5));
		
		$date = $this->input->post('p_date',TRUE);
		
		$appointmentData = array(
		'date' => $this->input->post('p_date',TRUE),
		'patient_id' => $patient_id,
		'appointment_id' =>$appointment_id,
		'schedul_id' => $schedul_id,
		'sequence' => $sequence,
		'venue_id' => $venue_id,
		'doctor_id' => $doctor_id,
		'problem' => $problem,
		'service' => $service1,
		'servicetype' => '',
		'get_date_time' => date("Y-m-d h:i:s"),
		'get_by' => 'Won'
		);
		
		$p_cc = $problem;

		$this->appointment_model->SaveAppoin($appointmentData);
		
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
		
		$sql_rk = "select * from token2 where id = '1'";
		$res_rk = $this->db->query($sql_rk);
		$result_rk = $res_rk->result_array();
		if(is_array($result_rk) && count($result_rk)>0){
			$refershToken = $result_rk[0]['refersh_token'];
		}
		
		$sql_tk = "select * from token where id = '1'";
		$res_tk = $this->db->query($sql_tk);
		$result_tk = $res_tk->result_array();
		if(is_array($result_tk) && count($result_tk)>0){
			$accessToken = $result_tk[0]['access_token'];
		}
		
		if($refershToken!="" && $accessToken!=""){
			/** Video call room creation **/				
			$superpro_meeting_url = $this->createVideoCallRoom(
				$doctor_name, $doctor_email,
				$p_name, $p_email);
			$meeting_pass = '';
		}else{
			$meeting_pass = '';
			$superpro_meeting_url = '';
		}
		
		
		
		$symt1 = $superpro_meeting_url;
		$symt2 = $meeting_pass;
		
		$sql_m = "update appointment_tbl set symt1 = '".$symt1."',symt2 = '".$symt2."' where appointment_id = '$appointment_id'";
		$this->db->query($sql_m);
		
		
		
		$message = $this->createVideoCallInformationMail('
			<p>Hey <strong>'.$p_name.'</strong>,</p>
			<p>Our staff member has confirmed you for a '.$service1.' appointment on '.date('jS F Y',strtotime($date)).' with Dr. '.$doctor_name.'. If you have questions before your appointment,
				use the contact form with appointment ID to get in touch with us.</p>
			<h2 style="text-align:left;font-weight:600;color:#356d82">Videocall Details:</h2> 
			<p>Superpro video call link: '.$superpro_meeting_url.',</p>
			<h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Appointment ID - ('.$appointment_id.')</h2><h1></h1>
			<h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Doctor Details:</h2><h1></h1>
			<p>Name: '.$doctor_name.'</p>
			<h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Patient Details:</h2>
			<p>Name: '.$p_name.'</p>
			<p>ID: '.$patient_id.'</p>
			<p>Email: '.$p_email.'</p>
			<p>Phone: '.$p_phone.'</p>
			<p>Age: '.$p_age.'</p>
			<p>Gender: '.$p_gender.',</p>
			<p>Tell us your symptom or health problem: '.$problem.'</p>
			<p>Appointment Date: '.date('jS F Y',strtotime($date)).'</p>
			<p>Appointment Time: '.date('h:i A', strtotime($sequence)).'</p>
			<p>Appointment ID: '.$appointment_id.'</p>');

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
		
		
		$appointmentData = array(
		'date' => $this->input->post('p_date',TRUE),
		'patient_id' => $patient_id,
		'doctor_name' => $doctor_name,
		'appointment_id' =>$appointment_id,
		'schedul_id' => $schedul_id,
		'sequence' => $sequence,
		'venue_id' => $venue_id,
		'venue_name' => $venue_name,
		'doctor_id' => $doctor_id,
		'problem' => $problem,
		'service' => $service1,
		'servicetype' => '',
		'get_date_time' => date("Y-m-d h:i:s"),
		'get_by' => 'Won',
		'fees' => '0'
		);

		$data['appointmentData'] = $appointmentData; 	
		
		//echo "<pre>";print_r($data);die();
		$data['info'] = $this->home_view_model->Home_satup();
		
		$app_time = date('h:i A', strtotime($sequence));
		$app_date = date('jS F Y',strtotime($this->input->post('p_date',TRUE)));
		
		$mes = 'You have made an appointment with '.$doctor_name.' on '.$app_date.'-'.$app_time.'<br>Welcome to your patient dashboard here you can see all your appointments, prescriptions and tests that you upload to the portal. You can always login back using the registered mobile number - '.$p_phone;
		$session_data = array(
			'log_id' => $p_log_id,
			'user_id' => $patient_id,
			'user_name' => $p_name,
			'user_picture' => '',
			'user_email' => $p_email,
			'user_type' => '3',
			'session_id' => session_id(),
			'logged_in' => TRUE
		);
		$this->session->set_userdata($session_data);
		$this->session->set_flashdata('message',"<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$mes."</div>");
        redirect('Patient');
		//$this->load->view('public/process_appointment_info',$data); 
	}
	
 
/* 
|--------------------------------------
|     view  print_appointment_info
|--------------------------------------
*/ 
    public function print_appointment_info()
    {
        $data['info'] = $this->home_view_model->Home_satup();
        $appointment_id = $this->session->userdata('appointment_id');

        $data['print'] = $this->basic_model->get_appointment_print_result($appointment_id);

    	
    		if($data){
             	 $this->load->view('public/patient_appointment_info',$data); 
            }else{
                redirect('Welcome');
            } 
    }
	
	public function save_appointment_info()
    {
        $data['info'] = $this->home_view_model->Home_satup();
        $appointment_id = $this->session->userdata('appointment_id');

        $data['print'] = $this->basic_model->get_appointment_print_result($appointment_id);

    	
    		if($data){
             	 $this->load->view('public/save_appointment_info',$data); 
            }else{
                redirect('Welcome');
            } 
    }
/*
|--------------------------------------
|     print registration save
|--------------------------------------
*/   

public function registration()
{
      $this->form_validation->set_rules('name', 'Name', 'trim|required');
      $this->form_validation->set_rules('pat_id', 'Patient Id', 'trim|required|is_unique[patient_tbl.patient_id]');
      $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|min_length[6]|max_length[15]');

      if ($this->form_validation->run()==true) {
          // get picture data
          if (@$_FILES['picture']['name']){

              $config['upload_path']   = './assets/uploads/patient/';
              $config['allowed_types'] = 'gif|jpg|jpeg|png';
              $config['overwrite']     = false;
              $config['max_size']      = 1024;
              $config['remove_spaces'] = true;
              $config['max_filename']   = 10;
              $config['file_ext_tolower'] = true;
              
              $this->load->library('upload', $config);
              if (!$this->upload->do_upload('picture')){
                  $this->session->set_flashdata('exception',"<div class='alert alert-danger msg'>".$this->upload->display_errors()."</div>");
                  redirect('Welcome');
              } else {
              $data = $this->upload->data();
              $image = base_url($config['upload_path'].$data['file_name']);
                
                #------------resize image------------#
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = $config['upload_path'].$data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['width']     = 250;
                $config['height']   = 200;

                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                #-------------resize image----------#
               }
            } else {
              $image = "";
            }
        #------------------------------------------------#
          $exists_user = $this->patient_model->exists_user(
              $this->input->post('phone',true),
              date('Y-m-d',strtotime($this->input->post('birth_date',true)))
          ); 
          if($exists_user == true){
              $this->session->set_flashdata('exception','<div class="alert alert-danger">'.display('exist_error_msg').'</div>');  
              redirect('Welcome');
          }

            $patient_id = $this->input->post('pat_id',TRUE); 
            $create_date = date('Y-m-d h:i:s');
            $birth_date = date('Y-m-d',strtotime($this->input->post('birth_date',TRUE)));

            $savedata =  array(
            'patient_id'    => $this->input->post('pat_id',TRUE),
            'patient_name' => $this->input->post('name',TRUE),
            'patient_email' => $this->input->post('email',true),
            'patient_phone' => $this->input->post('phone',TRUE), 
            'birth_date' =>$birth_date,
            'sex' => $this->input->post('gender',TRUE),
            'blood_group' => $this->input->post('blood_group',TRUE),
            'address' => $this->input->post('address',TRUE),
            'picture' => $image,
            'create_date'=>$create_date
            );
        #--------------------------------------
        # send email
        #-------------------------------------- 
          $email_config1 = $this->email_model->email_config();
            #-------------------------------
            if($email_config1->at_registration==1){
              // gate email template
              $email_temp_info = $this->db->select("*")->from('email_template')->where('default_status',1)->where('template_type',1)->get()->row();
               if(!empty($email_temp_info)) {     
              
                      $message = $this->template([
                         'patient_name'     => $this->input->post('name',TRUE),
                         'patient_id'       => $this->input->post('pat_id',TRUE), 
                         'date' => date("Y-m-d h:i:s"),
                         'message'          => $email_temp_info->email_template
                     ]); 

                #----------------------------
                    $config['protocol'] = $email_config1->protocol;
                    $config['mailpath'] = $email_config1->mailpath;
                    $config['charset'] = 'utf-8';
                    $config['wordwrap'] = TRUE;
                    $config['mailtype'] = $email_config1->mailtype;
                    $this->email->initialize($config);

                     $this->email->from($email_config1->sender, "Doctor");
                     $this->email->to($this->input->post('email',TRUE));
                     $this->email->subject("Registration");
                     $this->email->message($message);
                     $this->email->send();
                #-----------------------------
                    // save email delivary data
                    $save_email = array(
                      'delivery_date_time '=> date("Y-m-d h:i:s"),
                      'reciver_email '=> $this->input->post('email',TRUE),
                      'message'     => $message       
                    );
                    $this->db->insert('email_delivery',$save_email);
               } 
            }           
            
            $savedata = $this->security->xss_clean($savedata); 
            $this->patient_model->save_patient($savedata);
            $this->session->set_flashdata('patient_id',$patient_id);
            $this->session->set_flashdata('exception',"<div class='alert alert-success'>".display('register_msg')." <strong>Patient Id : ".$patient_id."</strong></div>");
            redirect('Welcome');
        } else {
          $this->session->set_flashdata('exception',"<div class='alert alert-danger'>Some fild are messiong, Please Try again.</div>");
          redirect('Welcome');
        }
}


 function template($config1 = null){
        $newStr = $config1['message'];
        foreach ($config1 as $key => $value) {
            $newStr = str_replace("%$key%", $value, $newStr);
        } 
        return $newStr; 
    }
/*
|---------------------------------
| GET POST BY ID
|---------------------------------
*/
	public function post_by_id($id)
	{
		$result = $this->db->select('*')
        ->from('blog_tbl')
        ->where('id',$id)
        ->get()
        ->row();
		echo json_encode($result);
	}
/*
|---------------------------------
| GET SLIDER BY ID
|---------------------------------
*/
	public function slider_by_id($id)
	{
		$result = $this->db->select('*')
        ->from('slider')
        ->where('id',$id)
        ->get()
        ->row();
		echo json_encode($result);
	}
	
	public function contactEmail(){
		//echo "test...here...";die();
		$full_name = $this->input->post('full_name',TRUE);
		$email_id = $this->input->post('email_id',TRUE);
		$subject = $this->input->post('subject',TRUE);
		$message = $this->input->post('message',TRUE);
		//$full_name = 'raghuveer singh';
		//$to = $info->email->details;
		$to = 'dev3@ecomsolver.com';
		$from = $email_id;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$from."\r\n".
		'Reply-To: '.$from."\r\n" .
		'X-Mailer: PHP/' . phpversion();
		
		$messagef = '<html><body>';
		$messagef .= '<h1>telehealers.in from '.$full_name.'</h1>';
		$messagef .= '<p style="font-size:18px;">Full Name: '.$full_name.'</p>';
		$messagef .= '<p style="font-size:18px;">Email ID: '.$email_id.'</p>';
		$messagef .= '<p style="font-size:18px;">Subject: '.$subject.'</p>';
		$messagef .= '<p style="font-size:18px;">Message: '.$message.'</p>';
		$messagef .= '</body></html>';
		
		/* $config['protocol'] = $email_config1->protocol;
		$config['mailpath'] = $email_config1->mailpath;
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = $email_config1->mailtype;
		$this->email->initialize($config);
		$this->email->from($email_id, $full_name);
		$this->email->to('raghuveer@ecomsolver.com');
		$this->email->subject($subject);
		$this->email->message($messagef);
		$this->email->send(); */
		
		// Sending email
		if(mail($to, $subject, $messagef, $headers)){
			echo 'Your details has been submited successfully.';
		}else{
			echo 'Mail send fail.';
		}
		
		//echo $full_name.' '.$email_id.' '.$subject.' '.$message;
	}
	
	public function getservicetype(){
		
		$services = $this->input->post('services',TRUE);
		$sql = "select id from service where title = '".$services."'";
		$res = $this->db->query($sql);
		$result = $res->result_array();
		if(is_array($result) && count($result)>0){
			$service_id = $result[0]['id'];
		}
		$con = '';
		if($service_id>0){
			$sql_st = "select * from servicetype where service = '".$service_id."'";
			$res_st = $this->db->query($sql_st);
			$result_st = $res_st->result_array();
			$i=0;
			if(is_array($result_st) && count($result_st)>0){
				foreach($result_st as $res){
					$i++;
					$service_id = $res['id'];
					$servicetype = $res['servicetype'];
					$doctors = $res['doctors'];
					if($i==1){
						$con .= '<li><button type="button" class="btn_choose_sent bg_btn_chose_1"><input type="radio" value="'.$servicetype.'" name="servicetype" checked="checked" />'.$servicetype.'</button></li>';
					}else{
						$con .= '<li><button type="button" class="btn_choose_sent bg_btn_chose_1"><input type="radio" value="'.$servicetype.'" name="servicetype" />'.$servicetype.'</button></li>';	
					}
					
				}
			}	
		}
		echo $con;
	}
	public function getservicetypedoctor(){
		
		$servicestype = $this->input->post('servicestype',TRUE);
		$sql = "select id,doctors from servicetype where title = '".$servicestype."'";
		$res = $this->db->query($sql);
		$result = $res->result_array();
		if(is_array($result) && count($result)>0){
			$service_id = $result[0]['id'];
			$doctors    = $result[0]['doctors'];
		}
		$con = '';
		if($service_id>0){
			$sql_st = "select * from servicetype where service = '".$service_id."'";
			$res_st = $this->db->query($sql_st);
			$result_st = $res_st->result_array();
			if(is_array($result_st) && count($result_st)>0){
				foreach($result_st as $res){
					$service_id = $res['id'];
					$servicetype = $res['servicetype'];
					$doctors = $res['doctors'];
					$con .= '<li><button type="button" class="btn_choose_sent bg_btn_chose_1"><input type="radio" name="servicetype" value="'.$servicetype.'" checked />'.$servicetype.'</button></li>';
				}
			}	
		}
		echo $con;
	}
	public function getdoctorforappointment(){
		$servicestype = $this->input->post('servicestype',TRUE);
		$sql = "select id,doctors from servicetype where servicetype = '".$servicestype."'";
		$res = $this->db->query($sql);
		$result = $res->result_array();
		if(is_array($result) && count($result)>0){
			$service_id = $result[0]['id'];
			$doctors    = $result[0]['doctors'];
		}
		//echo "<pre>";print_r($doctors);die();
		$doctors_arr = explode(',',$doctors);
		$con = '<div class="row">';
		//echo "<pre>";print_r($doctors_arr);die();
		$i=0;
		if(is_array($doctors_arr) && count($doctors_arr)>0){
			foreach($doctors_arr as $doc){
				$i++;
				$sql_doc = "select doc_id,doctor_name,designation from doctor_tbl where doctor_id = '".$doc."'";
				//echo $sql_doc;
				$res_doc = $this->db->query($sql_doc);
				$result_doc = $res_doc->result_array();
				if(is_array($result_doc) && count($result_doc)>0){
					$doc_id = $result_doc[0]['doc_id'];
					$doctor_name    = $result_doc[0]['doctor_name'];
					$designation    = $result_doc[0]['designation'];
					if($i==1){
						$con .= '<div class="col-md-6"><div class="doc_box"><span class="image_dr"><img src="https://telehealers.in/web_assets2/appointment/images/doctor.jpg" alt="#"></span><span class="content"><h5>Dr. '.$doctor_name.' </h5><p>'.$designation.'</p><div class="select_dr"><input type="radio" checked="checked" name="doctor_id" value="'.$doc.'">Take an Appointment</div></span></div></div>';
					}else{
						$con .= '<div class="col-md-6"><div class="doc_box"><span class="image_dr"><img src="https://telehealers.in/web_assets2/appointment/images/doctor.jpg" alt="#"></span><span class="content"><h5>Dr. '.$doctor_name.' </h5><p>'.$designation.'</p><div class="select_dr"><input type="radio" name="doctor_id" value="'.$doc.'">Take an Appointment</div></span></div></div>';
					}
					
				} 
			}
		}
		$con .= "</div>";
		echo $con;
	}
	
	public function getpromocodeprice(){
		$coupon_code = $this->input->post('coupon_code',TRUE);
		$sql = "select * from promocode where title = '".$coupon_code."'";
		$res = $this->db->query($sql);
		$result = $res->result_array();
		if(is_array($result) && count($result)>0){
			$service_id = $result[0]['id'];
			$price = $result[0]['price'];
			$p_limit = $result[0]['p_limit'];
			$p_used = $result[0]['p_used'];
			if($p_used==$p_limit){
				echo "1";
			}else{
				echo $price;	
			}
		}else{
			echo "0";
		}
	}
}
