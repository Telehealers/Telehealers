<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'../zoom/config.php';

class Patientprofile extends CI_Controller {
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
		$data['info'] = $this->home_view_model->Home_satup();
		$user_type = $this->session->userdata('user_type');
		$log_id = $this->session->userdata('log_id');
		if(isset($user_type) && $user_type==3 && isset($log_id) && $log_id >0){
			
		}else{
			redirect('login');
		}
		$sql_sh = "select * from patient_tbl where log_id = '".$log_id."'";
		$res_sh = $this->db->query($sql_sh);
		$result_sh = $res_sh->result_array();
		$data['patient_info'] = $result_sh;
		
		$meta_sql = "select * from metadata where id = '6'";
		$res_meta = $this->db->query($meta_sql);
		$data['meta_info'] = $res_meta->result_array();
      
        #------view page----------
        $this->load->view('patientprofile',$data);
	}

  
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
                $birth_date = '';
                $age = $this->input->post('age',TRUE);

              $savedata =  array(
              'patient_name' => $this->input->post('name',TRUE),
              'birth_date' =>$birth_date,
              'age' =>$age,
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
              $this->session->set_flashdata('message','<div class="alert alert-success msg">'.display("update_msg").'</div>');
              redirect('Patientprofile');
            } else {
                redirect('Patientprofile');
            }
  }



}
