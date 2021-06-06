<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_controller extends CI_Controller {
/*
|--------------------------------------
|   Constructor function
|--------------------------------------
*/
	public function __construct() 
	{
		parent::__construct();
		$this->load->library('session');
		 $session_id = $this->session->userdata('session_id'); 
	    if($session_id == NULL ) {
	     redirect('logout');
	    }
		$this->load->model('admin/Patient_model','patient_model');
		$this->load->model('admin/Doctor_model','doctor_model');
		$this->load->model('admin/Venue_model','venue_model');
		$this->load->model('admin/Overview_model','overview_model');
		$this->load->model('admin/email/Email_model','email_model');
		$this->load->model("Superpro_model", "conference");
  }
/*
|--------------------------------------
|     view all patient list
|--------------------------------------
*/
	public function patient_list()
	{
		//echo '<pre>'; print_r($this->session->all_userdata());exit;
		$user_type = $this->session->userdata('user_type');
		if($user_type==1){
			$user_id = $this->session->userdata('doctor_id');	
		}
		if($user_type==2){
			$user_id = $this->session->userdata('user_id');	
		}
		if($user_type==1 && $user_id==1){
			/** Case of Admin */
			$data['patient_info'] = $this->patient_model->get_all_patient();	
		}else{
			$data['patient_info'] = $this->patient_model->get_by_id_patient($user_id);
		}
		$data['title'] = "Patient List";
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/view_patient_list');
		$this->load->view('admin/_footer');
	}
	
	public function referral_patient_list()
	{ 
		//echo '<pre>'; print_r($this->session->all_userdata());exit;
		$user_type = $this->session->userdata('user_type');
		if($user_type==1){
			$user_id = $this->session->userdata('doctor_id');	
		}
		if($user_type==2){
			$user_id = $this->session->userdata('user_id');	
		}
		if($user_type==1 && $user_id==1){
			$data['patient_info'] = $this->patient_model->get_all_patient();	
		}else{
			//echo '1..'.$user_id;
			$data['patient_info'] = $this->patient_model->get_by_id_patient($user_id);
		}
		$data['patient_info'] = $this->patient_model->get_referral_patient($user_id);
		
		
		//echo "<pre>";print_r($data['patient_info']);die();
		$data['title'] = "Patient List";
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/view_referral_patient_list');
		$this->load->view('admin/_footer');
	}
/*
|--------------------------------------
|     Today patient list
|--------------------------------------
*/
  public function today_patient_list()
  {
    $data['title'] = "Today Patient List";
    $data['patient_info'] = $this->overview_model->today_patient();
    
    $this->load->view('admin/_header',$data);
    $this->load->view('admin/_left_sideber');
    $this->load->view('admin/view_today_patient_list');
    $this->load->view('admin/_footer');
  }  
/*
|--------------------------------------
|   Create a new patient view
|--------------------------------------
*/
	public function create_new_patient()
	{
    $data['title'] = "Create New Patient";
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/view_create_patient');
		$this->load->view('admin/_footer');
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

/*
|--------------------------------------
| save patient to patient_tbl
|--------------------------------------
*/
	public function save_patient()
	{
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
		
	     $this->form_validation->set_rules('name', 'Name', 'trim|required');
      $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|min_length[6]|max_length[15]');
      $this->form_validation->set_rules('email', 'Email', 'valid_email');         
   
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
            			      redirect('create_new_patient');
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
			$p_email = $this->input->post('email',true);
			$patient_exist=0;
			$sql_log = "select * from log_info where email = '$p_email'";
			$res_log = $this->db->query($sql_log);
			$result_log = null;//$res_log->result_array();
			if(is_array($result_log) && count($result_log)>0){
				$this->session->set_flashdata('message','<div class="alert alert-success msg">Patient Email ID already exist.</div>');
				redirect('create_new_patient');
			}else{
				$p_password = md5('PTele@123!');
			$pass_p = 'PTele@123!';
			$log_data = array(
				'email' => $p_email,
				'password' => $p_password,
				'user_type' => '3'
			);	
			$this->db->insert('log_info', $log_data);	
			$log_id = $this->db->insert_id();	
			
			$p_name = $this->input->post('name',TRUE);

			$user_type = $this->session->userdata('user_type');
			if($user_type==1){
				$user_id = $this->session->userdata('doctor_id');	
			}
			if($user_type==2){
				$user_id = $this->session->userdata('user_id');	
			}
			
            $create_date = date('Y-m-d h:i:s');
            $p_id="P".date('y').strtoupper($this->randstrGen(2,4));
             $savedata =  array(
            'patient_id'    => $p_id,
            'log_id'    => $log_id,
            'doctor_id'    => $user_id,
            'patient_name' => $this->input->post('name',TRUE),
            'patient_email' => $this->input->post('email',true),
            'patient_phone' => $this->input->post('phone',TRUE),
            'age' => $this->input->post('age',TRUE), 
            'sex' => $this->input->post('gender',TRUE),
            'create_date'=>$create_date
            );
            $savedata = $this->security->xss_clean($savedata); 
            $this->patient_model->save_patient($savedata);
			
			$patient_name = $this->input->post('name',TRUE);
			
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
                                       <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Dear '.$p_name.':</h2>
										<p>Thanks for choosing telehealers.in</p>
										<p>Kindly visit Your dashboard using registered mobile number.</p>
										<p>Url:  https://telehealers.in/Userlogin</p>
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
			$list = array($p_email);
			$ci->email->to($list);
			$this->email->reply_to('info@telehealers.in', 'telehealers');
			$ci->email->subject('Patient Account Details on telehealers.in');
			$ci->email->message($message);
			$ci->email->send();
			
			
			

            $email_config1 = $this->email_model->email_config();
            #-------------------------------
            if($email_config1->at_registration==1){
                // gate email template
                $email_temp_info = $this->db->select("*")->from('email_template')->where('default_status',1)->where('template_type',1)->get()->row();
             
            
                if(!empty($email_temp_info)) {     
              
                    $message = $this->template([
                         'patient_name'     => $this->input->post('name',TRUE),
                         'patient_id'       => $this->input->post('patient_id',TRUE), 
                         'date' => date("Y-m-d H:i:s"),
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
                      'delivery_date_time '=> date("Y-m-d H:i:s"),
                      'reciver_email '=> $this->input->post('email',TRUE),
                      'message'     => $message       
                    );
                    
                    $this->db->insert('email_delivery',$save_email);
                } 
            }

            $da['info'] = $savedata;
            redirect('patient_list');
			}
			


        } else {
			$this->load->view('admin/_header');
      		$this->load->view('admin/_left_sideber');
      		$this->load->view('admin/view_create_patient');
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

/*
|--------------------------------------
|   delete patient to patient_tbl
|--------------------------------------
*/ 
  public function delete_patient($patient_id)
  {
		$sql = "select * from patient_tbl where patient_id = '".$patient_id."'";
		$query_medi = $this->db->query($sql);
		$result_medi = $query_medi->result_array();
		if(is_array($result_medi) && count($result_medi)>0){
			$patient_name = $result_medi[0]['patient_name'];
			$patient_email = $result_medi[0]['patient_email'];
		}
      $this->db->where('patient_id',$patient_id);
      $this->db->delete('patient_tbl');
	  $user_id = $this->session->userdata('log_id');
			$action_title = 'Delete Patient';
			$action_description = 'User delete patient ('.$patient_name.'/'.$patient_email.')';
			$add_date = date('Y-m-d h:i:s');
			$sql_int = "insert into user_action_log (user_id,action_title,action_description,add_date) values ('$user_id','$action_title','$action_description','$add_date')";
			$this->db->query($sql_int);
      $this->session->set_flashdata('message',"<div class='alert alert-success msg'>".display('delete_msg')."</div>");
      redirect('patient_list');
  }
  
/*
|--------------------------------------
|    patient edit form view 
|--------------------------------------
*/ 
  public function patient_edit($patient_id)
  {
    $data['title'] = "Patient Edit";
    $data['patient_info'] = $this->patient_model->get_patient_inde_info($patient_id);
    $this->load->view('admin/_header',$data);
    $this->load->view('admin/_left_sideber');
    $this->load->view('admin/view_edit_patient');
    $this->load->view('admin/_footer');
  }

/*
|--------------------------------------
|    patient edit save to patient_tbl
|--------------------------------------
*/    
  public function edit_save_patient() {
        $patient_id = $this->input->post('patient_id',TRUE);
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|min_length[9]|max_length[15]');        
      if ($this->form_validation->run()==TRUE) {
          // get picture data
              if (@$_FILES['picture']['name']) {
                $ext = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
                $config['upload_path']          = './assets/uploads/patient/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['overwrite']     = false;
                $config['max_size']      = 1024;
                $config['remove_spaces'] = true;
                $config['max_filename']   = 5;
                $config['file_ext_tolower'] = true;
                
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('picture')) {
                     $sdata = $this->upload->display_errors();
                     $this->session->set_userdata($sdata);
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
                $image = $this->input->post('image',TRUE);
              }
                $birth_date = date('Y-m-d',strtotime($this->input->post('birth_date',TRUE)));

              $savedata =  array(
              'patient_name' => $this->input->post('name',TRUE),
              'birth_date' =>$birth_date,
              'sex' => $this->input->post('gender',TRUE),
              'blood_group' => $this->input->post('blood_group',TRUE),
              'patient_phone' => $this->input->post('phone',TRUE),
              'address' => $this->input->post('address',TRUE),
              'picture' => $image
              
              );
              $this->patient_model->save_edit_patient($savedata,$patient_id);
			  $user_id = $this->session->userdata('log_id');
			  
			$sql = "select * from patient_tbl where patient_id = '".$patient_id."'";
			$query_medi = $this->db->query($sql);
			$result_medi = $query_medi->result_array();
			if(is_array($result_medi) && count($result_medi)>0){
				$patient_name = $result_medi[0]['patient_name'];
				$patient_email = $result_medi[0]['patient_email'];
			}
			$action_title = 'Update patient';
			$action_description = 'User Update Patient ('.$patient_name.'/'.$patient_email.')';
			$add_date = date('Y-m-d h:i:s');
			$sql_int = "insert into user_action_log (user_id,action_title,action_description,add_date) values ('$user_id','$action_title','$action_description','$add_date')";
			$this->db->query($sql_int);
              $this->session->set_flashdata('message',"<div class='alert alert-success msg'>".display('update_msg')."</div>");
              redirect('patient_list');
            } else {
                $data['patient_info'] = $this->patient_model->get_patient_inde_info($patient_id);
                $this->load->view('admin/_header',$data);
                $this->load->view('admin/_left_sideber');
                $this->load->view('admin/view_edit_patient');
                $this->load->view('admin/_footer');
            }
  }
  
  public function upload_patient_doc($p_id){
	//echo $p_id;die(); 
	$data['title'] = "Patient Document List";
	$user_type = $this->session->userdata('user_type');
	$log_id = $this->session->userdata('log_id');
	
	if($user_type==1){
		
		if($log_id==1){
			$data['patient_info'] = $this->patient_model->get_patient_doc_info($p_id);
		}else{
			$doctor_id = $this->session->userdata('doctor_id');	
			$data['patient_info'] = $this->patient_model->get_patient_doc_info_by_doctor_id($p_id, $doctor_id);
		}
	}else{
		$data['patient_info'] = $this->patient_model->get_patient_doc_info($p_id);
	}
	
    
	
	
	$doc_arr = array();
	$sql = "select * from appointment_tbl where patient_id = '$p_id'";
	$res = $this->db->query($sql);
	$result = $res->result_array();
	if(is_array($result) && count($result)>0){
		foreach($result as $val){
			$doc_arr[] = $val['doctor_id'];
		}
	}
	//$doc_arr[] = 15;
	$doc_arr = array_unique($doc_arr);
	
	
	if($user_type==1){
		
		if($log_id==1){
			$data['d_data'] = $doc_arr;
		}else{
			$doctor_id = $this->session->userdata('doctor_id');	
			$doc_arr = array($doctor_id);
			$data['d_data'] = $doc_arr;
		}
	}else{
		$data['d_data'] = $doc_arr;
	}	
	
	
	//echo "<pre>";print_r($data['d_data']);die();
	
	$data['p_id'] = $p_id;
	//echo "<pre>";print_r($data['patient_info']);die();
    $this->load->view('admin/_header',$data);
    $this->load->view('admin/_left_sideber');
    $this->load->view('admin/view_patient_doc_list');
    $this->load->view('admin/_footer');
	  
  }
  
  public function save_patient_doc(){
	  
	   $p_id = $this->input->post('p_id',TRUE);
	   $doctor_id = $this->input->post('doctor_id',TRUE);
	  
	  if (@$_FILES['doc_name']['name']){
			$config['upload_path']   = './assets/uploads/patient/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
			$config['overwrite']     = false;
			$config['max_size']      = 1024;
			$config['remove_spaces'] = true;
			$config['max_filename']   = 10;
			$config['file_ext_tolower'] = true;

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('doc_name')){
				$this->session->set_flashdata('exception',"<div class='alert alert-danger msg'>".$this->upload->display_errors()."</div>");
					  redirect('admin/Patient_controller/upload_patient_doc/'.$p_id);
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

			$create_date = date('Y-m-d h:i:s');
			
			$savedata =  array(
              'patient_id' => $p_id,
              'doctor_id' => $doctor_id,
              'document' => $image,
              'add_date' => $create_date
            );
			
			$this->patient_model->save_patient_doc($savedata);
			
			$user_id = $this->session->userdata('log_id');
			$action_title = 'Add patient document';
			$action_description = 'User add patient document';
			$add_date = date('Y-m-d h:i:s');
			$sql_int = "insert into user_action_log (user_id,action_title,action_description,add_date) values ('$user_id','$action_title','$action_description','$add_date')";
			$this->db->query($sql_int);
			
			 $this->session->set_flashdata('message',"<div class='alert alert-success msg'>Patient document upload successfully.</div>");
			
			redirect('admin/Patient_controller/upload_patient_doc/'.$p_id);

  }
  
  public function delete_patient_document($id=NULL,$p_id=NULL)
  {
		
	
	$this->db->where('patient_doc_id',$id)->delete('patient_doc_tbl');
	
	$user_id = $this->session->userdata('log_id');
			$action_title = 'Delete patient document';
			$action_description = 'User delete patient document';
			$add_date = date('Y-m-d h:i:s');
			$sql_int = "insert into user_action_log (user_id,action_title,action_description,add_date) values ('$user_id','$action_title','$action_description','$add_date')";
			$this->db->query($sql_int);
	
	$this->session->set_flashdata('exception','<div class="alert alert-success msg">Selected document has been delete successfully.</div><br>');
	
	redirect('admin/Patient_controller/upload_patient_doc/'.$p_id);

	}

	public function referral_patient($p_id){
	  
	//echo $p_id;die(); 
	  
	$data['title'] = "Patient referral";
    $data['patient_info'] = $this->patient_model->get_patient_inde_info($p_id);
	
	$user_type = $this->session->userdata('user_type');
	if($user_type==1){
		$user_id = $this->session->userdata('doctor_id');
	}else{
		$user_id = $this->session->userdata('user_id');
	} 
	$data['doctor_info'] = $this->doctor_model->getDoctorListByselect();
		
	$data['p_id'] = $p_id;
	$data['user_id'] = $user_id;
	//echo $data['user_id'];die();
	
	//echo "<pre>";print_r($data['patient_info']);die();
    
    $this->load->view('admin/_header',$data);
    $this->load->view('admin/_left_sideber');
    $this->load->view('admin/referral_patient');
    $this->load->view('admin/_footer');
	
	  
  }
  /**A function to referr patient to another doctors.
   * This function updates ref_doc_id, ref_doc_id_by column of patient_tbl
   * and adds rows for ref_doc_id and patient's documents(sharing docs).
   */
  public function referral_patient_save(){
	 
		$patient_id = $this->input->post('p_id',TRUE);
		$user_type = $this->session->userdata('user_type');
		if($user_type==1){
			$user_id = $this->session->userdata('doctor_id');
		}else{
			$user_id = $this->session->userdata('user_id');
		}
		$referred_doctor = $this->input->post('doctor',TRUE);
		$savedata =  array(
		'ref_doc_id' => $referred_doctor,
		'ref_doc_id_by' => $user_id
		);
		
		$doc_id = $this->input->post('doctor',TRUE);

		$this->patient_model->save_edit_patient($savedata,$patient_id);
		if (!$this->patient_model->transfer_patient_doc_to_new_doctor(
			$patient_id, $user_id, $referred_doctor)) {
				log_message("error", "Bad transfer function.");
		}
		
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
		
		$sql = "select * from doctor_tbl where doctor_id = '".$doc_id."'";
		$res = $this->db->query($sql);
		$result = $res->result_array();
		if(is_array($result) && count($result)>0){
			$doctor_name = $result[0]['doctor_name'];
			$doc_id = $result[0]['doc_id'];
			$log_id = $result[0]['log_id'];
		}
		if($log_id>0){
			$sql_doc = "select * from log_info where log_id = '".$log_id."'";
			$res_doc = $this->db->query($sql_doc);
			$result_doc = $res_doc->result_array();
			if(is_array($result_doc) && count($result_doc)>0){
				$doctor_email = $result_doc[0]['email'];
			}
		}
		/** Inform doctors about referral */
		$sql2 = "select * from doctor_tbl where doctor_id = '".$referred_doctor."'";
		$res2 = $this->db->query($sql2);
		$result2 = $res2->result_array();
		if(is_array($result2) && count($result2)>0){
			$doctor_name_f = $result2[0]['doctor_name'];
		}
		
		$message = $this->conference->createVideoCallInformationMail(
			'<p>New patient referred to you</p>'.
			'<p>Hey Dr. '.$doctor_name.',</p>'.
			'<p>Patient referral to you by '.$doctor_name_f.'.</p>'.
			'<p>ID: '.$patient_id.'</p>');

		$ci->email->from('info@telehealers.in', 'telehealers');
		$list = array($doctor_email);
		$ci->email->to($list);
		$this->email->reply_to('info@telehealers.in', 'telehealers');
		$ci->email->subject('Referraled A Patient (Telehealers)');
		$ci->email->message($message);
		$ci->email->send();
	
		$this->session->set_flashdata('exception','<div class="alert alert-success msg">Patient has been successfully Referraled.</div><br>');	
		redirect('admin/Patient_controller/referral_patient/'.$patient_id);	
	}	  
  

}	