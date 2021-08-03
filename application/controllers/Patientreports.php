<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'../zoom/config.php';

class Patientreports extends CI_Controller {
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
		
		$sql_dc = "select * from patient_tbl where log_id = '".$log_id."'";
		$res_dc = $this->db->query($sql_dc);
		$result_dc = $res_dc->result_array();
		if(is_array($result_dc) && count($result_dc)>0){
			$patient_id = $result_dc[0]['patient_id'];
			
			$sql_doc = "select * from patient_doc_tbl where patient_id = '".$patient_id."'";
			$res_doc = $this->db->query($sql_doc);
			$result_doc = $res_doc->result_array();
			$data['patient_docs'] = $result_doc;
		}				$doc_arr = array();		$sql = "select * from appointment_tbl where patient_id = '$patient_id'";		$res = $this->db->query($sql);		$result = $res->result_array();		if(is_array($result) && count($result)>0){			foreach($result as $val){				$doc_arr[] = $val['doctor_id'];			}		}		$doc_arr = array_unique($doc_arr);		$data['d_data'] = $doc_arr;
		//echo "<pre>";print_r($data['patient_docs']);die(); 
		
		
		
		$meta_sql = "select * from metadata where id = '6'";
		$res_meta = $this->db->query($meta_sql);
		$data['meta_info'] = $res_meta->result_array();
      
        #------view page----------
        $this->load->view('patientreports',$data);
	}

  
	public function save_patient_doc(){
	  
	   $p_id = $this->input->post('p_id',TRUE);	   $doctor_id = $this->input->post('doctor_id',TRUE);
	   
	   //echo "p_id--".$p_id;die();
	  
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

			$create_date = date('Y-m-d h:i:s');
			
			$savedata =  array(
              'patient_id' => $p_id,			                
			  'doctor_id' => $doctor_id,
              'document' => $image,
              'add_date' => $create_date
            );
			
			$this->patient_model->save_patient_doc($savedata);
			
			/** Inform doctor about shared doc */
			$doc_info_query = "select doctor_phone from doctor_tbl where doctor_id = '".$doctor_id."'";
			$doctor_entry = $this->db->query($doc_info_query)->result();
			if (($doctor_entry) && isset($doctor_entry[0]['doctor_phone'])) {
				$this->smsgateway->sms_alert_doctor_about_patient_documents(
					$doctor_entry[0]['doctor_phone'], $p_id);
			}

			$user_id = $this->session->userdata('log_id');
			$action_title = 'Add patient document';
			$action_description = 'User add patient document';
			$add_date = date('Y-m-d h:i:s');
			$sql_int = "insert into user_action_log (user_id,action_title,action_description,add_date) values ('$user_id','$action_title','$action_description','$add_date')";
			$this->db->query($sql_int);
			
			$this->session->set_flashdata('message',"<div class='alert alert-success msg'>Patient document upload successfully.</div>");
			
			redirect('Patientreports');
			

	}
  
	public function delete_patient_document($id=NULL)
	{
	
	$this->db->where('patient_doc_id',$id)->delete('patient_doc_tbl');
	$user_id = $this->session->userdata('log_id');
	$action_title = 'Delete patient document';
	$action_description = 'User delete patient document';
	$add_date = date('Y-m-d h:i:s');
	$sql_int = "insert into user_action_log (user_id,action_title,action_description,add_date) values ('$user_id','$action_title','$action_description','$add_date')";
	$this->db->query($sql_int);
	
	$this->session->set_flashdata('message','<div class="alert alert-success msg">Selected document has been delete successfully.</div><br>');
	
	redirect('Patientreports');

	}


}
