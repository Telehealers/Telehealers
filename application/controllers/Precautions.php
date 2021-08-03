<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'../zoom/config.php';

class Precautions extends CI_Controller {
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
        $this->load->model('Smsgateway', 'smsgateway');
        
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
		/* $ci = get_instance();
		$ci->load->library('email');
		$config['protocol'] = "tls";
		$config['smtp_host'] = "smtp-relay.sendinblue.com";
		$config['smtp_port'] = "587";
		$config['smtp_user'] = "ravi@wishtech.com.br"; 
		$config['smtp_pass'] = "UnW0wjEBALXxq4C5";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		$ci->email->initialize($config);
		$ci->email->from('raghuveer@ecomsolver.com', 'telehealers');
		$list = array('raghu10raj@gmail.com');
		$ci->email->to($list);
		$this->email->reply_to('raghuveer@ecomsolver.com', 'Explendid Videos');
		$ci->email->subject('This is an email test');
		$ci->email->message('It is working. Great!');
		if($ci->email->send()){
			echo "mail send...";
		}else{
			echo "mail not send...";
		} */

		

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
        //echo "<pre>";print_r($data['theraphists']);die();
        $data['commitements'] = $this->db->get('commitements')->result();
        // Post
        $data['post'] = $this->home_view_model->get_all_post();
		//get venue list
        $data['venue'] = $this->venue_model->get_venue_list();
		
		$data['precautions'] = $this->db->get('precautions_tbl')->result();
		
		//get doctor list for appointmaent
		$data['doctor_info_for_appo'] = $this->doctor_model->getDoctorListByselect();

		$meta_sql = "select * from metadata where id = '8'";
		$res_meta = $this->db->query($meta_sql);
		$data['meta_info'] = $res_meta->result_array();
      

        #------view page----------
        $this->load->view('precaution',$data);
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
#    save appointmaent 
#----------------------------------------------  

  public function appointment()
  {
	  $ci = get_instance();
		$ci->load->library('email');
		$config['protocol'] = "tls";
		$config['smtp_host'] = "smtp-relay.sendinblue.com";
		$config['smtp_port'] = "587";
		$config['smtp_user'] = "ravi@wishtech.com.br"; 
		$config['smtp_pass'] = "UnW0wjEBALXxq4C5";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		$ci->email->initialize($config);
		
		
    $this->form_validation->set_rules('p_date', 'Date', 'trim|required');
    //$this->form_validation->set_rules('patient_id', 'Patient Id', 'trim|required');
    $this->form_validation->set_rules('venue_id', 'venue', 'trim|required'); 
    $this->form_validation->set_rules('sequence', 'sequence', 'trim|required');
	
	 if($this->input->post('doctor_id')){
		 $doctor_id = $this->input->post('doctor_id');
	 }else{
		 $doctor_id = '1';
	 }
	 if($this->input->post('service5') != ""){
		 $doctor_id = $this->input->post('service5');
	 }else{
		 $doctor_id = '1';
	 }

	$p_name = $this->input->post('p_name',TRUE);
	$p_email = $this->input->post('p_email',TRUE);
	$p_phone = $this->input->post('p_phone',TRUE);
	$p_age = $this->input->post('p_age',TRUE);
	$p_gender = $this->input->post('p_gender',TRUE);
	$create_date = date('Y-m-d h:i:s');
	$patient_id = "P".date('y').strtoupper($this->randstrGenapp(5));
	$birth_date = '';
	 $savedata =  array(
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
	$savedata = $this->security->xss_clean($savedata); 
	$this->patient_model->save_patient($savedata);
	
	$service1 = $this->input->post('service1',TRUE);
	$service2 = $this->input->post('service2',TRUE);
	$service3 = $this->input->post('service3',TRUE);
	$service4 = $this->input->post('service4',TRUE);

      if($this->form_validation->run()==true){
          
            date_default_timezone_set("Europe/Rome");
            $h = date('h')-1;
            $get_by = $this->session->userdata('log_id');

          	$appointment_id = "A".date('y').strtoupper($this->randstrGenapp(5));
          	$saveData = array(
            'date' => $this->input->post('p_date',TRUE),
            'patient_id' => $patient_id,
            'appointment_id' =>$appointment_id,
            'schedul_id' => $this->input->post('schedul_id',TRUE),
            'sequence' => $this->input->post('sequence',TRUE),
            'venue_id' => $this->input->post('venue_id',TRUE),
            'doctor_id' => $doctor_id,
            'problem' => $this->input->post('problem',TRUE),
            'service' => $this->input->post('service1',TRUE),
            'servicetype' => $this->input->post('service2',TRUE),
			'symt1' => $this->input->post('service3',TRUE),
			'symt2' => $this->input->post('service4',TRUE),
            'get_date_time' => date("Y-m-d h:i:s"),
            'get_by' => 'Won'
            );
			
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
						

           $check = $this->appointment_model->Check_appointment($this->input->post('date'),$this->input->post('patient_id',TRUE));
           if(!empty($check)){
              $this->session->set_flashdata('exception',"<div class='alert alert-danger msg'>".display('appointment_error_msg')."</div>");
              redirect('Welcome');
           }else{

            $this->appointment_model->SaveAppoin($saveData);               
        
            #-------------------------------
            // sms information save
            $info = $this->basic_model->get_appointment_print_result($appointment_id);
            $start = $info->start_time;
            $appointment_date = $info->date.' '.date('h:i:s', strtotime($start));
            $save_sms_info_details = array(
                'patient_id'        =>  $info->patient_id,
                'doctor_id'         =>  $info->doctor_id,
                'phone_no'          =>  $info->patient_phone,
                'appointment_date'  =>  $appointment_date,
                'appointment_id'    =>  $appointment_id
                ); 
            $this->appointment_model->Save_sms_info($save_sms_info_details);
            #------------------------------- 
            #-------------------------------
            $sms_gateway_info = $this->db->select("*")->from('sms_gateway')->where('default_status',1)->get()->row();
            // messate teamplate
            $teamplate_info = $this->db->select("*")->from('sms_teamplate')->where('default_status',1)->get()->row();
            // doctor
            $dData = $this->db->get_where('doctor_tbl', ['doctor_id =' => 1])->row();
            #---------------------------
            // sms_setting    
                if(!empty($teamplate_info) && !empty($sms_gateway_info)) {

                    $template = $this->smsgateway->template([
                         'doctor_name'      => $dData->doctor_name,
                         'appointment_id'   => $appointment_id,
                         'patient_name'     => $info->patient_name,
                         'patient_id'       => $info->patient_id,
                         'sequence'         => $info->sequence, 
                         'appointment_date' => date('d F Y',strtotime($info->date)),
                         'message'          => $teamplate_info->teamplate

                    ]); 
                      
                    $this->smsgateway->send([
                         'apiProvider' => $sms_gateway_info->provider_name,
                         'username'    => $sms_gateway_info->user,
                         'password'    => $sms_gateway_info->password,
                         'from'        => $sms_gateway_info->authentication,
                         'to'          => $info->patient_phone,
                         'message'     => $template
                    ]);

                    #------------------------------
                    // save delivary data
                    $save_coustom = array(
                        'gateway'     => $sms_gateway_info->provider_name,
                        'reciver'     => $info->patient_phone,
                        'message'     => $template       
                    );
                    $this->db->insert('custom_sms_info',$save_coustom);
                }
                #------------------------------ 
				
				

				
                #-----------------------------------------
                  # email sending option
                #-----------------------------------------
                $email_config = $this->email_model->email_config();
                // Email information save in email_info table
                $start = $info->start_time;
                $appointment_date = $info->date.' '.date('h:i:s', strtotime($start));
              
                $save_email_info = array(
                'patient_id'                => $info->patient_id,
                'doctor_id'                 => $info->doctor_id,
                'patient_phone'             => $info->patient_phone,
                'patient_email'             => $info->patient_email,
                'appointment_date'          => $appointment_date,
                'appointment_id'            => $appointment_id
                ); 
                $this->appointment_model->Save_email_info($save_email_info);
                #-------------------------------
                if($email_config->at_appointment==1){
                 // gate email template
                $email_temp_info = $this->db->select("*")->from('email_template')->where('default_status',1)->get()->row();
              
                if(!empty($email_temp_info) && !empty($info->patient_email)) {     
              
                    $message = $this->template([
                         'doctor_name'      => $dData->doctor_name,
                         'appointment_id'   => $appointment_id,
                         'patient_name'     => $info->patient_name,
                         'patient_id'       => $info->patient_id,
                         'sequence'         => $info->sequence, 
                         'appointment_date' => date('d F Y',strtotime($info->date)),
                         'message'          => $email_temp_info->email_template
                    ]); 

                #----------------------------
                    //$config = array();

					
				
				$sql_tk = "select * from token where id = '1'";
				$res_tk = $this->db->query($sql_tk);
				$result_tk = $res_tk->result_array();
				if(is_array($result_tk) && count($result_tk)>0){
					$accessToken = $result_tk[0]['access_token'];
				}
				
			
			$client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
			
			$app_date_time = date('Y-m-d',strtotime($info->date)).'T'.$info->sequence;

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
        
		
		


					
					/* $config['protocol'] = $email_config->protocol;
                    $config['mailpath'] = 'smtp-relay.sendinblue.com';
                    $config['charset'] = 'utf-8';
                    $config['wordwrap'] = TRUE;
                    $config['mailtype'] = $email_config->mailtype; 
                    $this->email->initialize($config);*/
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
                                        <p>Hey <strong>'.$info->patient_name.'</strong>,</p>
                                        <p>Our staff member has confirmed you for a '.$service1.' ('.$service2.') appointment on '.date('d F Y',strtotime($info->date)).' with Dr. '.$dData->doctor_name.' at '.$venue_address.'. If you have questions before your appointment,
                                            use the contact details below to get in touch with us.</p>
										<h2 style="text-align:center;font-weight:600;color:#356d82">Zoom Meeting Details:</h2>
										<p>Zoom meeting URL: '.$zoom_meeting_url.',</p>
										<p>Zoom meeting Password: '.$metting_pass.',</p>	
                                        <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Appointment ID - ('.$appointment_id.')</h2><h1></h1>
                                        <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Other Details:</h2><h1></h1>
                                        <p>Location Name: '.$venue_name.'</p>
                                        <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Service Details:</h2><h1></h1>
                                        <p>Service Name: '.$service1.'</p>
                                        <p>Service Type: '.$service2.',</p>
										<h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Covid Consultancy Details:</h2><h1></h1>
                                        <p>Symptoms: '.$service3.'</p>
                                        <p>Comorbidity Present: '.$service4.',</p>
										<h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Doctor Details:</h2><h1></h1>
                                        <p>Name: '.$doctor_name.'</p>
                                        <p>Designation: '.$designation.',</p>
										<p>Specialist: '.$specialist.',</p>
										<h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Patient Details:</h2>
                                        <p>Name: '.$info->patient_name.'</p>
                                        <p>ID: '.$info->patient_id.',</p>
										<p>Email: '.$info->patient_email.',</p>
										<p>Phone: '.$info->patient_phone.',</p>
										<p>Age: '.$info->age.',</p>
										<p>Gender: '.$info->sex.',</p>
										<p>Patient Complaint: '.$info->sequence.',</p>
										<p>Appointment Date: '.$appointment_date.',</p>
										<p>Appointment ID: '.$appointment_id.',</p>
										
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
					$list = array($info->patient_email);
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
					
					
                #-----------------------------
                    // save email delivary data
                    $save_email = array(
                      'delivery_date_time '=> date("Y-m-d h:i:s"),
                      'reciver_email '=> $info->patient_email,
                      'message'     => $message       
                    );
                    $this->db->insert('email_delivery',$save_email);
                    }

                }   
            #------------------------------
            # End Email Sending option
            #-------------------------------  
            }
           
            $sdata = array();
            $sdata['patient_id'] = $this->input->post('p_id',TRUE);
            $sdata['date'] = $this->input->post('date',TRUE);
            $sdata['appointment_id'] = $appointment_id;
            $this->session->set_userdata($sdata);
            $this->session->set_flashdata('message','<div class="alert alert-success msg">'.display('get_appointment_msg').'</div>');
            redirect('Welcome/print_appointment_info');

         }else{
        	   redirect('Welcome');
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
                     //$this->email->send();
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
		$ci = get_instance();
		$ci->load->library('email');
		$config['protocol'] = "tls";
		$config['smtp_host'] = "smtp-relay.sendinblue.com";
		$config['smtp_port'] = "587";
		$config['smtp_user'] = "ravi@wishtech.com.br"; 
		$config['smtp_pass'] = "UnW0wjEBALXxq4C5";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		$ci->email->initialize($config);
		
		
		//echo "test...here...";die();
		$full_name = $this->input->post('full_name',TRUE);
		$email_id = $this->input->post('email_id',TRUE);
		$subject = $this->input->post('subject',TRUE);
		$message2 = $this->input->post('message',TRUE);
		//$full_name = 'raghuveer singh';
		//$to = $info->email->details;
		$to = 'info@telehealers.in';
		
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
                                        <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Contact Information:</h2>
                                        <p>Full Name: '.$full_name.'</p>
                                        <p>Email ID: '.$email_id.',</p>
										<p>Subject: '.$subject.',</p>
										<p>Message: '.$message2.',</p>
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
			$list = array($email_id);
			$ci->email->to('info@telehealers.in');
			$this->email->reply_to('info@telehealers.in', 'telehealers');
			$ci->email->subject('Contact Us Information from telehealers.in');
			$ci->email->message($message);
			$ci->email->send();
			echo 'Your details has been submited successfully.';
		
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
				$sql_doc = "select doc_id,doctor_name,designation,picture from doctor_tbl where doctor_id = '".$doc."'";
				//echo $sql_doc;
				$res_doc = $this->db->query($sql_doc);
				$result_doc = $res_doc->result_array();
				if(is_array($result_doc) && count($result_doc)>0){
					$doc_id = $result_doc[0]['doc_id'];
					$doctor_name    = $result_doc[0]['doctor_name'];
					$designation    = $result_doc[0]['designation'];
					$picture    = $result_doc[0]['picture'];
					if($picture==""){
					    $picture = 'https://telehealers.in/web_assets2/appointment/images/doctor.jpg';
					}
					if($i==1){
						$con .= '<div class="col-md-6"><div class="doc_box"><span class="image_dr"><img src="'.$picture.'" alt="#"></span><span class="content"><h5> '.$doctor_name.' </h5><p>'.$designation.'</p><div class="select_dr"><input type="radio" checked="checked" name="doctor_id" value="'.$doc.'">Take an Appointment</div></span></div></div>';
					}else{
						$con .= '<div class="col-md-6"><div class="doc_box"><span class="image_dr"><img src="'.$picture.'" alt="#"></span><span class="content"><h5> '.$doctor_name.' </h5><p>'.$designation.'</p><div class="select_dr"><input type="radio" name="doctor_id" value="'.$doc.'">Take an Appointment</div></span></div></div>';
					}
					
				} 
			}
		}
		$con .= "</div>";
		echo $con;
	}
}
