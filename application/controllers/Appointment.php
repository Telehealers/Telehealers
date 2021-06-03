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
        // $this->load->model('admin/Overview_model','overview_model');
        // Load venue model
        $this->load->model('admin/Venue_model','venue_model');
        // load appointment model
        $this->load->model('admin/Appointment_model','appointment_model');
     //   Load Basic model
        $this->load->model('admin/basic_model','basic_model');
      //  Load Schedule model
        $this->load->model('admin/Schedule_model','schedule_model');
      //  Load Patient model
        $this->load->model('admin/Patient_model','patient_model');
      //  Load sms setup model
        $this->load->model('admin/Sms_setup_model','sms_setup_model');
	//	Load Doctor model
		$this->load->model('admin/Doctor_model','doctor_model');
       	$this->load->model('admin/Ajax_model','ajax_model');

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

		// $email_config = $this->email_model->email_config();

    //     //get_schedule_list
        $data['schedule'] = $this->schedule_model->get_schedule_list();
    //     //setup information
        $data['info'] = $this->home_view_model->Home_satup();
    //     //get doctor_info
        $data['doctor_info'] = $this->home_view_model->doctor_info();
    //     //load slider
        $data['slider'] = $this->home_view_model->Slider();
    //     //total_appointment
        // $data['total_appointment'] = $this->overview_model->total_appointment();
    //     //total_patient
    //     $data['total_patient'] = $this->overview_model->total_patient();
    //     //to_day_appointment
        // $data['to_day_appointment'] = $this->overview_model->to_day_appointment();
    //     //to_day_get_appointment
        // $data['to_day_get_appointment'] = $this->overview_model->to_day_get_appointment();
    //     // testimonial
        $data['testimonial'] = $this->db->get('testimonial')->result();
		$data['faq'] = $this->db->get('faq')->result();
        $data['theraphists'] = $this->db->get('theraphists')->result();
        $data['commitements'] = $this->db->get('commitements')->result();
    //     // Post
        $data['post'] = $this->home_view_model->get_all_post();
		// //get venue list
        $data['venue'] = $this->venue_model->get_venue_list();

		//$data['service'] = $this->db->get('service')->result();

		// get doctor list for appointmaent
		$data['doctor_info_for_appo'] = $this->doctor_model->getDoctorListByselect();
		//get departments
		 $data['services']=$this->getservicetype();


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
        // $data= null;
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
			},
			{
				"name":"assistant",
				"email":"support@telehealers.in",
				"role":"cohost"
			}
		]
	}
	',
		CURLOPT_HTTPHEADER => array(
		'Authorization: Bearer '.getenv('SUPERPRO_AUTH_TOKEN'),
		'Content-Type: application/json'
		),
	));
	$superpro_response = curl_exec($curl_session);

	if (!$superpro_response) {
		log_message('error',$superpro_response);
		show_404();
	}

	curl_close($curl_session);
	$superpro_data = json_decode($superpro_response);

	if (isset($superpro_data->message)) {
		log_message('error', $superpro_data->message);
		show_404();
	}
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
	/** A function to confirm appointment ie Fill all DB entries and
	 * provide information to participants and assistants.
	 * Check function flow for functional bugs.
	 * Current Function Flow: Email-client init
	 * 	-> Fetch patient and doctor
	 * 	-> Save appointment
	 * 	-> Create Video call and inform paticipant
	 *  -> Save session data (userdata)
	 *  -> redirect to Patient
	 * Original Function Flow: Email-client init
	 * 	-> get-patient-log-id
	 * 	-> Register unregistered patient in patient_tbl and log_info
	 * 	-> Get patient and doctor data
	 *  -> Save Appointment
	 *  -> Create video-call and inform participant
	 * 	-> Save session data (userdata)
	 * 	-> redirect to Patient
	 * Post input used: p_date(YYYY-MM-DD), servicetype_id(INT), sequence(HH:MM:SS AM|PM), doctor_id(INT)
	 *  p_id {patient_id} (INT)
	 */
	public function confirmation(){
		if ( !$this->session->userdata("logged_in")) {
			log_message("error", "Confirmation access without login");
			redirect("welcome");
		}

		$ci = get_instance();
		$ci->load->library('email');
		/* Mail client intialization */
		$email_config = $this->email_model->email_config();
		if (!$email_config->protocol) {
			/** Bad email table */
			log_message('error',"Bad email config, fill email-sql-table correctly.");
			show_404();
		}
		$config['protocol'] = $email_config->protocol;
		$config['smtp_host'] = $email_config->mailpath;
		$config['smtp_port'] = $email_config->port;
		$config['smtp_user'] = $email_config->sender;
		$config['smtp_pass'] = $email_config->mailtype;
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
		$ci->email->initialize($config);

		/**Variable Validation */
		$this->form_validation->set_rules('p_date', 'Date', 'trim|required');
		/**TODO: Check if patient_id is coming in post request*/
		$this->form_validation->set_rules('p_id', 'Patient Id', 'trim|required');
		$this->form_validation->set_rules('sequence', 'sequence', 'trim|required');
		$this->form_validation->set_rules('doctor_id', 'doctor', 'required' );
		$this->form_validation->set_rules('servicetype_id', 'service', 'required');

		
		if (!$this->form_validation->run()) {
			log_message("error", "Bad post-inputs");
			redirect("appointment");
		}

		/**Application vars
		 * TODO: Match name and fetch vars which are not coming from request.
		 */
		$booking_date = $this->input->post('p_date', TRUE);
		$sequence = $this->input->post("sequence",TRUE);
		$sequence = date("H:i:s", strtotime($sequence));
		$servicetype_id = $this->input->post('servicetype_id',TRUE);
		$doctor_id = $this->input->post('doctor_id');
		/**TODO: Bad schedule_id, use sql auto-increment column*/
		$schedul_id = "A".date('y').strtoupper($this->randstrGenapp(5));
		$patient_id = "";
		if ($this->session->userdata("user_type") == "3")
			$patient_id = $this->session->userdata("user_id");
		else {
			/**Bad user type: Only implemented for patient*/
			log_message('error',"Bad user_type(".$this->session->userdata("user_type").
				") coming from request. Only allowed user type is of patient('3')");
			show_404();
		}
		$venue_id = 3; /**NOTE: venue = Online */

		/** Fetching service */
		$servicetype_query = "select service, servicetype FROM servicetype where id = ".$servicetype_id;
		$servicetype_entry = $this->db->query($servicetype_query)->result()[0];
		if (!$servicetype_entry) {
			/** Bad service from input */
			log_message('error', "Bad service query: ".$servicetype_query." ");
			show_404();
		}
		$service = $servicetype_entry->service;
		$servicetype = $servicetype_entry->servicetype;
		/**Fetching patient data from DB*/
		$get_patient_query = "select patient_name, patient_email,".
			" patient_phone, age, sex, log_id from patient_tbl".
			" where patient_id = '".$patient_id."'";

		$patient_entry = $this->db->query($get_patient_query);
		$patient_entry=$patient_entry ? $patient_entry->result()[0]:null;
		$p_name = $patient_entry->patient_name;
		$p_email = $patient_entry->patient_email;
		$p_age = $patient_entry->age;
		$p_phone = $patient_entry->patient_phone;
		$p_gender = $patient_entry->sex;
		$p_log_id = $patient_entry->log_id;

		$data['service1'] = $service;
		$data['service2'] = $servicetype;
		/**Fetch venue data */
		$venue_info_query = "select * from venue_tbl where venue_id = '".$venue_id."'";
		$venue_data = $this->db->query($venue_info_query)->result()[0];
		if (!$venue_data) {
			/**Bad venue fetch */
			log_message('error',"Bad venue_id(".$venue_id.") coming from request.");
			show_404();
		}
		$venue_name = $venue_data->venue_name;

		$doctor_info_query = "select doctor_name, log_id from doctor_tbl where doctor_id = '".$doctor_id;
		$doctor_entry = $this->db->query($doctor_info_query)->result()[0];
		if (!$doctor_entry) {
			/** Bad doctor_id from input */
			log_message('error', "Bad doctor_id(".$doctor_id.") in ");
			show_404();
		}
		$doctor_name = $doctor_entry->doctor_name;
		$log_id = $doctor_entry->log_id;
		/** Bad way to generate ID
		 * TODO: Use auto-increment.
		 */
		$appointment_id = "A".date('y').strtoupper($this->randstrGenapp(5));

		$appointmentData = array(
			'date' => $booking_date,
			'patient_id' => $patient_id,
			'appointment_id' =>$appointment_id,
			'schedul_id' => $schedul_id,
			'sequence' => $sequence,
			'venue_id' => $venue_id,
			'doctor_id' => $doctor_id,
			'problem' => "",
			'service' => $service,
			'servicetype' => $servicetype,
			'get_date_time' => date("Y-m-d h:i:s"),
			'get_by' => 'Won'
		);

		$this->appointment_model->SaveAppoin($appointmentData);

		$log_info_query = "select email from log_info where log_id = '".$log_id."'";
		$log_entry = $this->db->query($log_info_query)->result()[0];
		if (!$log_entry) {
			/** Bad log_info table management.*/
			log_message('error',"Bad log_id (".$log_id.")");
			show_404();
		}
		$doctor_email = $log_entry->email;

		/** Video call room creation
		 * TODO: Add assistants to videocall members**/
		$superpro_meeting_url = $this->createVideoCallRoom(
			$doctor_name, $doctor_email,
			$p_name, $p_email);
		$meeting_pass = '';

		$symt1 = $superpro_meeting_url;
		$symt2 = $meeting_pass;
		/** Updating appointment with video call link */
		$sql_m = "update appointment_tbl set symt1 = '".$symt1."',symt2 = '".$symt2."' where appointment_id = '$appointment_id'";
		$this->db->query($sql_m);

		/** Informing participants */
		$message = $this->createVideoCallInformationMail('
			<p>Hey <strong>'.$p_name.'</strong>,</p>
			<p>Our staff member has confirmed you for a '.$service.
				' appointment on '.$booking_date.' with Dr. '.$doctor_name.
				'. If you have questions before your appointment,'.
				'use the contact form with appointment ID to get in touch with us.</p>
			<h2 style="text-align:left;font-weight:600;color:#356d82">Videocall Details:</h2>
			<p>Superpro video call link: '.$superpro_meeting_url.',</p>
			<h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Appointment ID - ('.$appointment_id.')</h2><h1></h1>
			<h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Doctor Details:</h2><h1></h1>
			<p>Name: '.$doctor_name.'</p>
			<h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Patient Details:</h2>
			<p>Name: '.$p_name.'</p>
			<p>ID: '.$patient_id.'</p>
			<p>Email: '.$p_email.'.Enter this in videocall link to join.</p>
			<p>Phone: '.$p_phone.'</p>
			<p>Age: '.$p_age.'</p>
			<p>Gender: '.$p_gender.',</p>
			<p>Appointment Date: '.$booking_date.'</p>
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
			'date' => $booking_date,
			'patient_id' => $patient_id,
			'doctor_name' => $doctor_name,
			'appointment_id' =>$appointment_id,
			'schedul_id' => $schedul_id,
			'sequence' => $sequence,
			'venue_id' => $venue_id,
			'venue_name' => $venue_name,
			'doctor_id' => $doctor_id,
			'problem' => "",
			'service' => $service,
			'servicetype' => $servicetype,
			'get_date_time' => date("Y-m-d h:i:s"),
			'get_by' => 'Won',
			'fees' => '0'
		);

		$data['appointmentData'] = $appointmentData;

		$data['info'] = $this->home_view_model->Home_satup();

		$app_time = date('h:i A', strtotime($sequence));
		$app_date = date('jS F Y',strtotime($booking_date));

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
	}

	public function patientAppointment(){

		$ci = get_instance();
		$ci->load->library('email');
		//Necessary variable initialization
		$protocol = NULL;
		$smtp_host = NULL;
		$smtp_port = NULL;
		$smtp_user = NULL;
		$smtp_pass = NULL;
        $email_config = NULL;
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
		// Intialization of doctor info variable
		// Necessary, do not remove.
		$doctor_name = NULL;
		$doc_id = NULL;
		$log_id = NULL;
		$department = NULL;
		$designation = NULL;
		$degrees = NULL;
		$specialist = NULL;
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
		$superpro_meeting_url = $this->createVideoCallRoom(
			$doctor_name, $doctor_email,
			$p_name, $p_email);
		$meeting_pass = '';

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
			<p>Email: '.$p_email.'.Enter this in videocall link to join.</p>
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
		
		$user_type = $this->session->userdata('user_type');

		if($user_type==1){
			$mes='successfully created appointment';
			$this->session->set_flashdata('message',$mes);
		redirect("admin/Appointment_controller/appointment_list");
		}		
		else{
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
          $this->session->set_flashdata('exception',"<div class='alert alert-danger'>Some field are messiong, Please Try again.</div>");
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
		$sql = "select id,servicetype from servicetype ";
		$res = $this->db->query($sql);
		$result = $res->result_array();
		return $result;
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
	/* 	Get available doctors
	*	Post input used: servicetype_id(INT), preferred_language(STRING), booking_hour (HH),
			 booking_minute (MM), booking_am_pm (AM|PM), booking_date(YYYY-MM-DD)
    *  	returns: HTML doctor list with pictures and all-unselected radio buttons.
        TODO: rows with bias_reduction < 0, are rows with other languages,
			handle this case.
        REMARKS: We can also add bias which sort rows according to preferred,
          common(like English) and other(like other state's language/boli) languages,
		  a 3-categorized language set.
    */
	public function getdoctorforappointment(){
		//NOTE: Input can also be mapped to post input, uncomment below comments
		// to use them.
		$servicetype_id = $this->input->post('servicetype_id',TRUE);
		$servicetype_filter = ($servicetype_id)? 'stdm.servicetype_id = '.$servicetype_id.' AND ':"";
		$preferred_language = $this->input->post('preferred_language', TRUE);
		$preferred_language_filter = '(language LIKE "%'.$preferred_language.'%")';
		$sequence =$this->input->post("booking_hour",TRUE).":".
		$this->input->post("booking_minute", TRUE).":00 ".
		$this->input->post("booking_am_pm", TRUE);
		$sequence = date("H:i:s", strtotime($sequence));
		$booking_time = $this->input->post('booking_date', TRUE)." ".$sequence;

		$booking_time = urldecode($booking_time);
		/** SQL-Query: 
		 * Incldes aggregation on doctor_id: A contigency mechanism so that no
		 * 	bad logic emits multiple doctors e.g. by joining unconditionally on n-row table.
		 */
		$sql_query = 'SELECT main_docs.picture AS picture, main_docs.designation AS designation, '.
			'main_docs.doctor_name AS doctor_name, main_docs.doctor_id AS doctor_id, '.
			'(IF('.$preferred_language_filter.', RAND(), -RAND())) as bias_reduction_score '. //Doctor selection bias reduction logic
			'FROM doctor_tbl main_docs, servicetype_to_doctor_map stdm WHERE '.
			' stdm.doctor_id = main_docs.doctor_id AND '.$servicetype_filter.
			'main_docs.doctor_id IN ('.
			'SELECT sched.doctor_id FROM schedul_setup_tbl sched WHERE '.
			'sched.day = DAYOFWEEK("'.$booking_time.'") AND CAST(sched.start_time AS TIME) <= "'.
			$booking_time.'" AND CAST(sched.end_time AS TIME) >= CAST(ADDTIME("'.
			$booking_time.'", SEC_TO_TIME(sched.per_patient_time * 60)) AS TIME)) AND '.
			'main_docs.doctor_id NOT IN (SELECT bookings.doctor_id FROM '.
			'appointment_tbl bookings, doctor_tbl as docs, schedul_setup_tbl schedule '.
			'WHERE bookings.doctor_id = docs.doctor_id AND '.
			'schedule.doctor_id = bookings.doctor_id AND '.
			'CAST(bookings.sequence AS TIME) <=  "'.$booking_time.'" AND "'.$booking_time.
			'" <= ADDTIME(CAST(bookings.sequence AS TIME), SEC_TO_TIME(schedule.per_patient_time*60))) '.
			' GROUP BY main_docs.doctor_id ORDER BY bias_reduction_score DESC;';

		$available_doctors = $this->db->query($sql_query);

		foreach ($available_doctors->result() as $doc) {
			if($doc->doctor_name!='Admin'){
          $picture=$doc->picture?$doc->picture:base_url()."web_assets2/images/user_img.png";

			echo '<div class="col-sm-12 col-md-4 col-lg-3" id="'.$doc->doctor_id.'" data-value="'.$doc->doctor_id.'">
          <div class="our-team" data-value="'.$doc->doctor_id.'">
			        <div class="picture" data-value="'.$doc->doctor_id.'">
			          <img class="img-fluid" src="'.$picture.'" data-value="'.$doc->doctor_id.'">
			        </div>
			        <div class="team-content" data-value="'.$doc->doctor_id.'">
			          <h3 class="name" data-value="'.$doc->doctor_id.'"> '.$doc->doctor_name.' </h3>
			          <h4 class="title" data-value="'.$doc->doctor_id.'">'.$doc->designation.'</h4>
			        </div>

      </div></div>';
		}}
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
