<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Appointment_controller extends CI_Controller {

/*
|--------------------------------------
|   constructor funcion
|--------------------------------------
*/ 
	public function __construct() 
	{
		parent::__construct();
		$this->load->library('session');
		$session_id = $this->session->userdata('session_id');     
 
	    if($session_id == NULL ){
	     redirect('logout');
	    }

        $this->load->model('admin/Sms_setup_model','sms_setup_model');
        $this->load->model('admin/Basic_model','basic_model');
	       $this->load->model('admin/Appointment_model','appointment_model');
	      $this->load->model('admin/Venue_model','venue_model');
	      $this->load->library('Smsgateway');


        $this->load->model('admin/Overview_model','overview_model');
        $this->load->model('admin/email/Email_model','email_model');
		$this->load->model('admin/Doctor_model','doctor_model');
        $this->load->library('email');
       	$this->load->model('admin/Patient_model','patient_model');

		
		
  }


    #------------------------------------------------
    #       view appointment form
    #------------------------------------------------
	public function index()
	{
		//echo '<pre>'; print_r($this->session->all_userdata());exit;
		$user_type = $this->session->userdata('user_type');
		if($user_type==1){
			$doctor_id = $this->session->userdata('doctor_id');
			
			
			if($doctor_id!="1"){
				$data['patient_info'] = $this->patient_model->get_by_id_patient($doctor_id);
				$data['doctor_info'] = $this->doctor_model->getDoctorListById($doctor_id);	
			}else{
				$data['doctor_info'] = $this->doctor_model->getDoctorListByselect();
				$data['patient_info'] = $this->patient_model->get_all_patient();
			}
			
		}else{
			$data['patient_info'] = $this->patient_model->get_all_patient();
			$data['doctor_info'] = $this->doctor_model->getDoctorListByselect();
		}
        $data['title'] = "Create New Appointment";
		$data['venue_info'] = $this->venue_model->get_venue_list();
		

		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/view_create_appointment');
		$this->load->view('admin/_footer');
	}

    

    #------------------------------------------------
    #  appointment list view 
    #------------------------------------------------- 
	public function appointment_list($search=NULL)
	{
		//echo '<pre>'; print_r($this->session->all_userdata());exit;
        $data['title'] = "Appointment List";
        //gate gateway_information
        $data['gateway_list'] = $this->db->select('*')->from('sms_gateway')->where('default_status',1)->get()->row();
     
        $data['teamplate'] = $this->sms_setup_model->teamplate_list();
    
		$user_type = $this->session->userdata('user_type');
		
		
		
		
		if($user_type==1){
			echo $doctor_id = $this->session->userdata('doctor_id');
			if($doctor_id!="1"){
				$data['appointmaent_info'] = $this->appointment_model->get_appointment_list_by_id($doctor_id);
			}else{
				
				$data['appointmaent_info'] = $this->appointment_model->get_appointment_list();
				//echo "<pre>";print_r($data['appointmaent_info']);die();
			}
		}else{
			$data['appointmaent_info'] = $this->appointment_model->get_appointment_list();
		}

		//echo "<pre>";print_r($data['appointmaent_info']);die();
	
        
        
       	$this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/view_appointment_list');
        $this->load->view('admin/_footer');
	}
	
	public function appointment_list_referral($search=NULL)
	{
		//echo '<pre>'; print_r($this->session->all_userdata());exit;
        $data['title'] = "Appointment List";
        //gate gateway_information
        $data['gateway_list'] = $this->db->select('*')->from('sms_gateway')->where('default_status',1)->get()->row();
     
        $data['teamplate'] = $this->sms_setup_model->teamplate_list();
    
		$user_type = $this->session->userdata('user_type');
		
		
		
		
		if($user_type==1){
			echo $doctor_id = $this->session->userdata('doctor_id');
			if($doctor_id!="1"){
				$data['appointmaent_info'] = $this->appointment_model->get_appointment_list_by_id_referral($doctor_id);
			}else{
				
				$data['appointmaent_info'] = $this->appointment_model->get_appointment_list_referral();
				//echo "<pre>";print_r($data['appointmaent_info']);die();
			}
		}else{
			$data['appointmaent_info'] = $this->appointment_model->get_appointment_list_referral();
		}

		//echo "<pre>";print_r($data['appointmaent_info']);die();
	
        
        
       	$this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/view_appointment_list_referral');
        $this->load->view('admin/_footer');
	}

    #------------------------------------------------
    #  appointment list view 
    #------------------------------------------------- 
    public function delete_appointment($appointment_id=NULL)
    {
		$app_id = $appointment_id;
		$this->db->where('appointment_id',$appointment_id)->delete('appointment_tbl');
        $this->db->where('appointment_id',$appointment_id)->delete('email_info');
        $this->db->where('appointment_id',$appointment_id)->delete('sms_info');
		$this->db->where('appointment_id',$appointment_id)->delete('appointment_referral');
        $this->session->set_flashdata('message',display('delete_msg'));
		$user_id = $this->session->userdata('log_id');
		$action_title = 'Delete appointment ';
		$action_description = 'User Delete appointment ('.$app_id.')';
		$add_date = date('Y-m-d h:i:s');
		$sql_int = "insert into user_action_log (user_id,action_title,action_description,add_date) values ('$user_id','$action_title','$action_description','$add_date')";
		$this->db->query($sql_int);
        redirect('admin/Appointment_controller/appointment_list');
    }


    #------------------------------------------------
    #  Today appointment list view 
    #------------------------------------------------- 
    public function today_appointment_list($search=NULL)
    {
        $data['title'] = "Today Appointment List";
        //gate gateway_information
        $data['gateway_list'] = $this->db->select('*')->from('sms_gateway')->where('default_status',1)->get()->row();
        $data['teamplate'] = $this->sms_setup_model->teamplate_list();
        $user_type = $this->session->userdata('user_type');
        $doctor_id = $this->session->userdata('doctor_id');
        
		if($user_type=='1'){
			if($doctor_id=='1'){
			 $data['appointmaent_info'] = $this->overview_model->to_day_appointment();
			}
			else{
				$data['appointmaent_info'] = $this->overview_model->to_day_appointment_by_id($doctor_id);	
			}
		}else{
       		 $data['appointmaent_info'] = $this->overview_model->to_day_appointment();
		} 
        
        $this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/view_today_appointment_list');
        $this->load->view('admin/_footer');
    }



      #------------------------------------------------
      #  Today appointment list view 
      #------------------------------------------------
 
    public function today_gate_appointment_list($search=NULL)
    {
		
        $data['gateway_list'] = $this->db->select('*')->from('sms_gateway')->where('default_status',1)->get()->row();

        $data['teamplate'] = $this->sms_setup_model->teamplate_list();
        
        $data['appointmaent_info'] = $this->overview_model->to_day_get_appointment();
		
		
		$this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/view_today_get_appointment_list');
        $this->load->view('admin/_footer');
    }

      #----------------------------------------------
      #    random coad genaretor of appointmaent id
      #----------------------------------------------  
      function randstrGen($len) 
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


  #----------------------------------------------
  #    save appointmaent 
  #----------------------------------------------  

    public function save_appointment()
    { 
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
		
    	$this->form_validation->set_rules('date', 'Date', 'trim|required');
    	$this->form_validation->set_rules('p_id', 'Patient Id', 'trim|required');
      $this->form_validation->set_rules('venue', 'venue', 'trim|required'); 
      $this->form_validation->set_rules('sequence', 'sequence', 'trim|required');
	  
	  $p_cc = $this->input->post('problem',TRUE);
	  $sequence = $this->input->post('sequence',TRUE);
	  $date = $this->input->post('date',TRUE);


      if($this->form_validation->run()==true){
         $info = $this->db->where('name','timezone')->get('web_pages_tbl')->row();
          
            date_default_timezone_set(@$info->details);
            $h = date('h')-1;
            $get_by = $this->session->userdata('log_id');

        	$appointment_id = "A".date('y').strtoupper($this->randstrGen(5));
        	$saveData = array(
            'date' => $this->input->post('date',TRUE),
            'patient_id' => $this->input->post('p_id',TRUE),
            'appointment_id' =>$appointment_id,
            'schedul_id' => $this->input->post('schedul_id',TRUE),
            'sequence' => $this->input->post('sequence',TRUE),
            'venue_id' => $this->input->post('venue',TRUE),
            'doctor_id' => $this->input->post('doctor',TRUE),
            'problem' => $this->input->post('problem',TRUE),
            'get_date_time' => date("Y-m-d H:i:s"),
            'get_by' => $get_by
            );
			$doctor_id = $this->input->post('doctor',TRUE);


          $check =  $this->appointment_model->Check_appointment($this->input->post('date',TRUE),$this->input->post('p_id',TRUE));
          
          if(!empty($check)){
              $this->session->set_flashdata('exception',display('appointment_error_msg'));
              redirect('admin/Appointment_controller');
          }else{
              $this->appointment_model->SaveAppoin($saveData);
			  
				
				

				$sql_tk = "select * from token where id = '1'";
				$res_tk = $this->db->query($sql_tk);
				$result_tk = $res_tk->result_array();
				if(is_array($result_tk) && count($result_tk)>0){
					$accessToken = $result_tk[0]['access_token'];
					$refershToken = $result_tk[0]['refersh_token'];
				}

				if($refershToken!="" && $accessToken!=""){
					$p_id = $this->input->post('p_id',TRUE);
					$sql_tk = "select * from patient_tbl where patient_id = '$p_id'";
					$res_tk = $this->db->query($sql_tk);
					$result_tk = $res_tk->result_array();
					if(is_array($result_tk) && count($result_tk)>0){
						$p_name = $result_tk[0]['patient_name'];
						//$doctor_id = $result_tk[0]['doctor_id'];
						$p_email = $result_tk[0]['patient_email'];
						$p_phone = $result_tk[0]['patient_phone'];
						$p_gender = $result_tk[0]['sex'];
						$p_age = $result_tk[0]['age'];
					}
					$service2 = 'Consultation for COVID-19';
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
					
					try {
				
					$client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
					
					$date_g = '12-07-2021';
					$sequence_g = '6:15 PM';
					$app_date_time = date('Y-m-d',strtotime($date)).'T'.$sequence.":00";
			
					$meeting_pass = '123456768';
					$per_patient_time='15';
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
					
					
				}else{
					$meeting_pass = '';
					$zoom_meeting_url = '';
				}
				$symt1 = $zoom_meeting_url;
				$symt2 = $meeting_pass;

				$sql_m = "update appointment_tbl set symt1 = '".$symt1."',symt2 = '".$symt2."' where appointment_id = '$appointment_id'";
				$this->db->query($sql_m);
				
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
                                        <p>Our staff member has confirmed you for a '.$service2.' appointment on '.date('jS F Y',strtotime($date)).' with Dr. '.$doctor_name.'. If you have questions before your appointment,
                                            use the contact form with appointment ID to get in touch with us.</p>
										<h2 style="text-align:left;font-weight:600;color:#356d82">Zoom Meeting Details:</h2> 
										<p>Zoom meeting URL: '.$zoom_meeting_url.',</p>
										<p>Zoom meeting Password: '.$meeting_pass.',</p>	
                                        <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Appointment ID - ('.$appointment_id.')</h2><h1></h1>
                                        <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Doctor Details:</h2><h1></h1>
                                        <p>Name: '.$doctor_name.'</p>
                                        <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Patient Details:</h2>
                                        <p>Name: '.$p_name.'</p>
                                        <p>ID: '.$p_id.'</p>
										<p>Email: '.$p_email.'</p>
										<p>Phone: '.$p_phone.'</p>
										<p>Age: '.$p_age.'</p>
										<p>Gender: '.$p_gender.',</p>
										<p>Tell us your symptom or health problem: '.$p_cc.'</p>
										<p>Appointment Date: '.date('jS F Y',strtotime($date)).'</p>
										<p>Appointment Time: '.date('h:i A', strtotime($sequence)).'</p>
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
				
			  
              $info = $this->basic_model->get_appointment_print_result($appointment_id);
              #-----------------------------------------
              // sms information save in sms_info table

              $start = @$info->start_time;
              $patient_time = $this->input->post('date',TRUE).' '.date('h:i:s', strtotime($start));
              
              $save_sms_info = array(
                'patient_id'        => $info->patient_id,
                'doctor_id'         => $info->doctor_id,
                'phone_no'          => $info->patient_phone,
                'appointment_date'  =>$patient_time,
                'appointment_id'    =>$appointment_id
                ); 
              $this->appointment_model->Save_sms_info($save_sms_info);
              #-------------------------------

              #-------------------------------
              $sms_gateway_info = $this->db->select("*")->from('sms_gateway')->where('default_status',1)->get()->row();
              // messate teamplate
              $teamplate_info = $this->db->select("*")->from('sms_teamplate')->where('default_status',1)->get()->row();
              // doctor
              $dData = $this->db->get_where('doctor_tbl', ['doctor_id =' => 1])->row();
              

              #------------------------------------------
              # sms_setting 
              #------------------------------------------   
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
                  // save sms delivary data
                  $save_coustom = array(
                    'gateway'     => $sms_gateway_info->provider_name,
                    'reciver'     => $info->patient_phone,
                    'message'     => $template       
                  );
                 $this->db->insert('custom_sms_info',$save_coustom);
              }
              #------------------------------
              # End SMS Sending option
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
                    $config['protocol'] = $email_config->protocol;
                    $config['mailpath'] = $email_config->mailpath;
                    $config['charset'] = 'utf-8';
                    $config['wordwrap'] = TRUE;
                    $config['mailtype'] = $email_config->mailtype;
                    $this->email->initialize($config);

                    $this->email->from($email_config->sender, "Habitusana");
                    $this->email->to($info->patient_email);
                    $this->email->subject("Informazioni appuntamento");
                    $this->email->message($message);
                    $this->email->send();
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

           }
           
            $sdata = array();
            $sdata['patient_id'] = $this->input->post('p_id',TRUE);
            $sdata['date'] = $this->input->post('date',TRUE);
            $sdata['appointment_id'] = $appointment_id;
            $this->session->set_userdata($sdata);
			$user_id = $this->session->userdata('log_id');
			$action_title = 'Add appointment';
			$action_description = 'User Add appointment ('.$appointment_id.')';
			$add_date = date('Y-m-d h:i:s');
			$sql_int = "insert into user_action_log (user_id,action_title,action_description,add_date) values ('$user_id','$action_title','$action_description','$add_date')";
			$this->db->query($sql_int);
            $this->session->set_flashdata('message','<div class="alert alert-success msg">'.display('get_appointment_msg').'</div>');
            redirect('print_appointment_info');

         }else{
        		$data['venue_info'] = $this->venue_model->get_venue_list();
  					$this->load->view('admin/_header',$data);
  					$this->load->view('admin/_left_sideber');
  					$this->load->view('admin/view_create_appointment');
  					$this->load->view('admin/_footer');
         }
    }



    function template($config = null){
        $newStr = $config['message'];
        foreach ($config as $key => $value) {
            $newStr = str_replace("%$key%", $value, $newStr);
        } 
        return $newStr; 
    }

	function send_meet_url($appointmaent_id){
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
		
		$patient_id='';
		$doctor_id='';
		$meet_url='';
		
		$sql_p = "select * from appointment_tbl where appointment_id = '".$appointmaent_id."' ";
		$res_p = $this->db->query($sql_p);
		$result_p = $res_p->result_array();
		if(is_array($result_p) && count($result_p)>0){
			$patient_id = $result_p[0]['patient_id'];
			$doctor_id = $result_p[0]['doctor_id'];
		}
		if($patient_id!="" && $doctor_id!=""){
			$sql = "select * from patient_tbl where patient_id = '".$patient_id."' ";
			$res = $this->db->query($sql);
			$result = $res->result_array();
			if(is_array($result) && count($result)>0){
				$patient_name = $result[0]['patient_name'];
				$patient_email = $result[0]['patient_email'];
			}
			$sql_doc = "select * from doctor_tbl where doctor_id = '".$doctor_id."' ";
			$res_doc = $this->db->query($sql_doc);
			$result_doc = $res_doc->result_array();
			if(is_array($result_doc) && count($result_doc)>0){
				$doctor_name = $result_doc[0]['doctor_name'];
				$meet_url = $result_doc[0]['meet_url'];
				$doc_id = $result_doc[0]['doc_id'];
			}
			if($meet_url!=""){
				
			
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
                                        <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Dear '.$patient_name.':</h2>
										<p>Thanks for choosing telehealers.in</p>
										<p>We hope your consultation will go well with '.$doctor_name.' </p>
                                        <p>Here you can find easy Google Meet URL to connect directly with Doctor.</p>
										
										<p>Meeting URL - '.$meet_url.'</p>	
									
										<p>&nbsp;</p>
										
										<p>Keep in touch during this tough time! </p>
										<p>Kindly write us back without any hasitation if you find any issues at support@telehealers.in</p>
										
										
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
		$subject = 'Telehealers Meeting Link with '.$doctor_name;
		$ci->email->subject($subject);
		$ci->email->message($message);
		$ci->email->send();
			}
		}
		if($meet_url!=""){
				$this->session->set_flashdata('message','Meeting URL has been sent successfully!');
		}else{
			$this->session->set_flashdata('message2','Doctor Meeting URL is empty.');
		}
		redirect("admin/Appointment_controller/appointment_list");
	}
	
	function send_meet_url_referral($appointmaent_id){
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
		
		$patient_id='';
		$doctor_id='';
		$meet_url='';
		
		$sql_p = "select * from appointment_tbl where appointment_id = '".$appointmaent_id."' ";
		$res_p = $this->db->query($sql_p);
		$result_p = $res_p->result_array();
		if(is_array($result_p) && count($result_p)>0){
			$patient_id = $result_p[0]['patient_id'];
		}
		
		$sql_pr = "select * from appointment_referral where appointment_id = '".$appointmaent_id."' ";
		$res_pr = $this->db->query($sql_pr);
		$result_pr = $res_pr->result_array();
		if(is_array($result_pr) && count($result_pr)>0){
			$doctor_id = $result_pr[0]['referral_to'];
		}
		
		if($patient_id!="" && $doctor_id!=""){
			$sql = "select * from patient_tbl where patient_id = '".$patient_id."' ";
			$res = $this->db->query($sql);
			$result = $res->result_array();
			if(is_array($result) && count($result)>0){
				$patient_name = $result[0]['patient_name'];
				$patient_email = $result[0]['patient_email'];
			}
			$sql_doc = "select * from doctor_tbl where doctor_id = '".$doctor_id."' ";
			$res_doc = $this->db->query($sql_doc);
			$result_doc = $res_doc->result_array();
			if(is_array($result_doc) && count($result_doc)>0){
				$doctor_name = $result_doc[0]['doctor_name'];
				$meet_url = $result_doc[0]['meet_url'];
				$doc_id = $result_doc[0]['doc_id'];
			}
			if($meet_url!=""){
				
			
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
                                        <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Dear '.$patient_name.':</h2>
										<p>Thanks for choosing telehealers.in</p>
										<p>We hope your consultation will go well with '.$doctor_name.' </p>
                                        <p>Here you can find easy Google Meet URL to connect directly with Doctor.</p>
										
										<p>Meeting URL - '.$meet_url.'</p>	
									
										<p>&nbsp;</p>
										
										<p>Keep in touch during this tough time! </p>
										<p>Kindly write us back without any hasitation if you find any issues at support@telehealers.in</p>
										
										
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
		$subject = 'Telehealers Meeting Link with '.$doctor_name;
		$ci->email->subject($subject);
		$ci->email->message($message);
		$ci->email->send();
			}
		}
		if($meet_url!=""){
				$this->session->set_flashdata('message','Meeting URL has been sent successfully!');
		}else{
			$this->session->set_flashdata('message2','Doctor Meeting URL is empty.');
		}
		redirect("admin/Appointment_controller/appointment_list_referral");
	}
	
	function appointment_referral_accept($appointmaent_id){
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
		
		$patient_id='';
		$doctor_id_from='';
		$doctor_id_to='';
		$meet_url='';
		$ref_id='';
		
		
		$sql_pr = "select * from appointment_referral where appointment_id = '".$appointmaent_id."' ";
		$res_pr = $this->db->query($sql_pr);
		$result_pr = $res_pr->result_array();
		if(is_array($result_pr) && count($result_pr)>0){
			$doctor_id_to = $result_pr[0]['referral_to'];
			$doctor_id_from = $result_pr[0]['referral_from'];
			$ref_id = $result_pr[0]['id'];
		}
		
		if($doctor_id_from!="" && $doctor_id_to!=""){
			
			$referal_from = $this->appointment_model->getdoctordata($doctor_id_from);
			$referal_to = $this->appointment_model->getdoctordata($doctor_id_to);
			
			$referal_from_doc_name='';
			$referal_from_doc_email='';
			$referal_to_doc_name='';
			$referal_to_doc_email='';
			
			
			
			if(is_array($referal_from) && count($referal_from)>0){
				$referal_from_doc_name = $referal_from['doctor_name'];
				$referal_from_doc_email = $referal_from['doc_email'];
			}
			if(is_array($referal_to) && count($referal_to)>0){
				$referal_to_doc_name = $referal_to['doctor_name'];
				$referal_to_doc_email = $referal_to['doc_email'];
			}
			$savedata = array(
				'app_status' => '1'
			);
			$this->appointment_model->UpdateReferralAppointment($savedata,$ref_id);
			if($referal_from_doc_email!=""){
				
			
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
                                        <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Hey '.$referal_from_doc_name.':</h2>
										
										<p>'.$referal_to_doc_name.' Accepted your appointment referral request!</p>	
										
										<p>Appointment ID - '.$appointmaent_id.'</p>
									
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

		$ci->email->from('info@telehealers.in', 'telehealers');
		$list = array($referal_from_doc_email);
		$ci->email->to($list);
		$this->email->reply_to('info@telehealers.in', 'telehealers');
		$subject = 'Appointment referral Accepted by '.$referal_to_doc_name;
		$ci->email->subject($subject);
		$ci->email->message($message);
		$ci->email->send();
		
		$admin_email = 'info@telehealers.in';
		$ci->email->from('info@telehealers.in', 'telehealers');
		$list = array($admin_email);
		$ci->email->to($list);
		$this->email->reply_to('info@telehealers.in', 'telehealers');
		$subject = 'Appointment referral Accepted by '.$referal_to_doc_name;
		$ci->email->subject($subject);
		$ci->email->message($message);
		$ci->email->send();
		
			}
		}
		
		$this->session->set_flashdata('message','Appointment Accepted!');
		
		redirect("admin/Appointment_controller/appointment_list_referral");
	}
	
	function appointment_referral_reject($appointmaent_id){
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
		
		$patient_id='';
		$doctor_id_from='';
		$doctor_id_to='';
		$meet_url='';
		$ref_id='';
		
		
		$sql_pr = "select * from appointment_referral where appointment_id = '".$appointmaent_id."' ";
		$res_pr = $this->db->query($sql_pr);
		$result_pr = $res_pr->result_array();
		if(is_array($result_pr) && count($result_pr)>0){
			$doctor_id_to = $result_pr[0]['referral_to'];
			$doctor_id_from = $result_pr[0]['referral_from'];
			$ref_id = $result_pr[0]['id'];
		}
		
		if($doctor_id_from!="" && $doctor_id_to!=""){
			
			$referal_from = $this->appointment_model->getdoctordata($doctor_id_from);
			$referal_to = $this->appointment_model->getdoctordata($doctor_id_to);
			
			$referal_from_doc_name='';
			$referal_from_doc_email='';
			$referal_to_doc_name='';
			$referal_to_doc_email='';
			
			
			
			if(is_array($referal_from) && count($referal_from)>0){
				$referal_from_doc_name = $referal_from['doctor_name'];
				$referal_from_doc_email = $referal_from['doc_email'];
			}
			if(is_array($referal_to) && count($referal_to)>0){
				$referal_to_doc_name = $referal_to['doctor_name'];
				$referal_to_doc_email = $referal_to['doc_email'];
			}
			$savedata = array(
				'app_status' => '2'
			);
			$this->appointment_model->UpdateReferralAppointment($savedata,$ref_id);
			if($referal_from_doc_email!=""){
				
			
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
                                        <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Hey '.$referal_from_doc_name.':</h2>
										
										<p>'.$referal_to_doc_name.' Rejected your appointment referral request!</p>	
										
										<p>Appointment ID - '.$appointmaent_id.'</p>
									
										<p>&nbsp;</p>
										
										<p>Kindly speak to admin for referring it to someone else</p>
										
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

		
		$ci->email->from('info@telehealers.in', 'telehealers');
		$list = array($referal_from_doc_email);
		$ci->email->to($list);
		$this->email->reply_to('info@telehealers.in', 'telehealers');
		$subject = 'Appointment Referral Rejected by '.$referal_to_doc_name;
		$ci->email->subject($subject);
		$ci->email->message($message);
		$ci->email->send();
		
		
		$admin_email = 'info@telehealers.in';
		$ci->email->from('info@telehealers.in', 'telehealers');
		$list = array($admin_email);
		$ci->email->to($list);
		$this->email->reply_to('info@telehealers.in', 'telehealers');
		$subject = 'Appointment Referral Rejected by '.$referal_to_doc_name;
		$ci->email->subject($subject);
		$ci->email->message($message);
		$ci->email->send();
		
		
			}
		}
		
		$this->session->set_flashdata('message','Appointment Rejected!');
		
		redirect("admin/Appointment_controller/appointment_list_referral");
	}
  
	function appointment_referral($appointmaent_id){
	    
		//echo $p_id;die(); 
		  
		$data['title'] = "Patient referral";
		//$data['patient_info'] = $this->patient_model->get_patient_inde_info($p_id);
		
		$user_type = $this->session->userdata('user_type');
		if($user_type==1){
			$user_id = $this->session->userdata('doctor_id');
		}else{
			$user_id = $this->session->userdata('user_id');
		} 
		$data['doctor_info'] = $this->doctor_model->getDoctorListByselect();
		$data['get_appointment'] = $this->appointment_model->check_appointment_referral($appointmaent_id);
			
		$data['p_id'] = $appointmaent_id;
		
		$data['user_id'] = $user_id;
		//echo $data['user_id'];die();
		
		//echo "<pre>";print_r($data['patient_info']);die();
		
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/referral_appointment');
		$this->load->view('admin/_footer');
	}  
	
	public function referral_appointment_save(){
	 
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

		$appointment_id = $this->input->post('p_id',TRUE);
		$referral_to = $this->input->post('doctor',TRUE);
		
		$user_type = $this->session->userdata('user_type');
		if($user_type==1){
			$user_id = $this->session->userdata('doctor_id');
		}else{
			$user_id = $this->session->userdata('user_id');
		} 
		$savedata =  array(
				'appointment_id' => $appointment_id,
				'referral_to' => $referral_to,
				'referral_from' => $user_id,
				'app_status' => 0,
				'referral_date' => date("Y-m-d H:i:s"),
			);
		$get_appointment = $this->appointment_model->check_appointment_referral($appointment_id);
		
		if(is_array($get_appointment) && count($get_appointment)>0){
			$ref_to = $get_appointment[0]['referral_to'];
			$ref_from = $get_appointment[0]['referral_from'];
			$ref_id = $get_appointment[0]['id'];
			$this->appointment_model->UpdateReferralAppointment($savedata,$ref_id);
			$get_appointment = $this->appointment_model->check_appointment_referral($appointment_id);
		}else{
			
			$this->appointment_model->SaveReferralAppointment($savedata);
		}
		
		$referal_from = $this->appointment_model->getdoctordata($user_id);
		$referal_to = $this->appointment_model->getdoctordata($referral_to);
		
		$referal_from_doc_name='';
		$referal_from_doc_email='';
		$referal_to_doc_name='';
		$referal_to_doc_email='';
		
		if(is_array($referal_from) && count($referal_from)>0){
			$referal_from_doc_name = $referal_from['doctor_name'];
			$referal_from_doc_email = $referal_from['doc_email'];
		}
		if(is_array($referal_to) && count($referal_to)>0){
			$referal_to_doc_name = $referal_to['doctor_name'];
			$referal_to_doc_email = $referal_to['doc_email'];
		}
		
		//echo "<pre>";print_r($referal_from);
		//echo "<pre>";print_r($referal_to);
		//echo "<pre>";print_r($get_appointment);die();
		
		
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
                                        <p>Hey '.$referal_to_doc_name.',</p>
                                        <p>Appointment Referral to you by '.$referal_from_doc_name.' ('.$referal_from_doc_email.').</p>
                                        
                                        <p>Appointment ID: '.$appointment_id.'</p>
										
										<p>Please check your doctor dashboard to accept the appointment of patient.</p>
										
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

		$ci->email->from('info@telehealers.in', 'telehealers');
		$list = array($referal_to_doc_email);
		$ci->email->to($list);
		$this->email->reply_to('info@telehealers.in', 'telehealers');
		$ci->email->subject('Referral Appointment (Telehealers)');
		$ci->email->message($message);
		$ci->email->send();
		
		$admin_email = 'info@telehealers.in';
		$ci->email->from('info@telehealers.in', 'telehealers');
		$list = array($admin_email);
		$ci->email->to($list);
		$this->email->reply_to('info@telehealers.in', 'telehealers');
		$ci->email->subject('Referral Appointment (Telehealers)');
		$ci->email->message($message);
		$ci->email->send();

		$this->session->set_flashdata('exception','<div class="alert alert-success msg">Appointment has been successfully Referral.</div><br>');

		redirect('admin/Appointment_controller/appointment_referral/'.$appointment_id);
	
			  
  }	  
  
}