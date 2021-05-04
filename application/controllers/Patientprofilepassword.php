<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'../zoom/config.php';

class Patientprofilepassword extends CI_Controller {
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
		$data['log_id'] = $log_id;
		$sql_sh = "select * from patient_tbl where log_id = '".$log_id."'";
		$res_sh = $this->db->query($sql_sh);
		$result_sh = $res_sh->result_array();
		$data['patient_info'] = $result_sh;
		
		$meta_sql = "select * from metadata where id = '6'";
		$res_meta = $this->db->query($meta_sql);
		$data['meta_info'] = $res_meta->result_array();
      
        #------view page----------
        $this->load->view('patientprofilepassword',$data);
	}

  
	public function edit_save_patient() {
        $patient_id = $this->input->post('patient_id',TRUE);
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
         
      if ($this->form_validation->run()==TRUE) {
          // get picture data
		  
          
             $password = $this->input->post('password',TRUE);
			 $new_password = $this->input->post('new_password',TRUE);
			 $log_id = $this->input->post('log_id',TRUE);
			  
			$sql = "select * from log_info where log_id = '".$log_id."'";
			$query_medi = $this->db->query($sql);
			$result_medi = $query_medi->result_array();
			if(is_array($result_medi) && count($result_medi)>0){
				$c_password = $result_medi[0]['password'];
			}
			
			if($c_password!=md5($password)){
				$this->session->set_flashdata('message',"<div class='alert alert-danger msg'>Current password is wrong!</div>");
				redirect('Patientprofilepassword');
			}else{
				
				$sql_int = "update log_info set password = '".md5($new_password)."' where log_id = '".$log_id."'";
				$this->db->query($sql_int);

				$this->session->set_flashdata('message','<div class="alert alert-success msg">'.display("update_msg").'</div>');
				redirect('Patientprofilepassword');
			  
			}
			
		
		} else {
			redirect('Patientprofilepassword');
		}
    }

  

}
