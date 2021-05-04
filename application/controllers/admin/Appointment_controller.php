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
				$data['doctor_info'] = $this->doctor_model->getDoctorListById($doctor_id);	
			}else{
				$data['doctor_info'] = $this->doctor_model->getDoctorListByselect();
			}
			
		}else{
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
			$doctor_id = $this->session->userdata('doctor_id');
			if($doctor_id!="1"){
				$data['appointmaent_info'] = $this->appointment_model->get_appointment_list_by_id($doctor_id);
			}else{
				$data['appointmaent_info'] = $this->appointment_model->get_appointment_list();
			}
		}else{
			$data['appointmaent_info'] = $this->appointment_model->get_appointment_list();
		}
		
	
        
        
       	$this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/view_appointment_list');
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
        $data['appointmaent_info'] = $this->overview_model->to_day_appointment();
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
    	$this->form_validation->set_rules('date', 'Date', 'trim|required');
    	$this->form_validation->set_rules('p_id', 'Patient Id', 'trim|required');
      $this->form_validation->set_rules('venue', 'venue', 'trim|required'); 
      $this->form_validation->set_rules('sequence', 'sequence', 'trim|required');


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


          $check =  $this->appointment_model->Check_appointment($this->input->post('date',TRUE),$this->input->post('p_id',TRUE));
          
          if(!empty($check)){
              $this->session->set_flashdata('exception',display('appointment_error_msg'));
              redirect('admin/Appointment_controller');
          }else{
              $this->appointment_model->SaveAppoin($saveData);
              
              $info = $this->basic_model->get_appointment_print_result($appointment_id);
              #-----------------------------------------
              // sms information save in sms_info table

              $start = @$info->start_time;
              $patient_time = $info->date.' '.date('h:i:s', strtotime($start));
              
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


  
}