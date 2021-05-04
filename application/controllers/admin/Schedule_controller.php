<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_controller extends CI_Controller {
/*
|---------------------------------------------#
|	constructor function
|---------------------------------------------#
*/
	public function __construct() 
	{
		parent::__construct();
		$this->load->library('session');
		 $session_id = $this->session->userdata('session_id'); 
	    if($session_id == NULL ) {
	     redirect('logout');
	    }

	    $this->load->model('admin/Schedule_model','schedule_model');
	    $this->load->model('admin/Venue_model','venue_model');
	    $this->load->model('admin/Doctor_model','doctor_model');
	}

/*
|---------------------------------------------#
|	add schedule view form
|---------------------------------------------#
*/
	public function add_schedule()
	{
		$data['title'] = " Add new Schedule";
		$data['venue_info'] = $this->venue_model->get_venue_list(); 
		
		//$data['doctor_info'] = $this->doctor_model->getDoctorListByselect();
		
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
		
		
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/view_setup_schedule');
		$this->load->view('admin/_footer');
	}

	/*
	|-----------------------------------------------
	|	 schedule view list
	|-----------------------------------------------
	*/
	public function schedule_list()
	{
		$data['title'] = "Schedule List";
		//$data['schedul_info'] = $this->schedule_model->get_schedule_list();
		$user_type = $this->session->userdata('user_type');
		if($user_type==1){
			$doctor_id = $this->session->userdata('doctor_id');
			if($doctor_id!="1"){
				$data['schedul_info'] = $this->schedule_model->get_schedule_list_by_doc_id($doctor_id);
			}else{
				$data['schedul_info'] = $this->schedule_model->get_schedule_list();
			}
			
		}else{
			$data['schedul_info'] = $this->schedule_model->get_schedule_list();
		}
		
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/view_schedule_list');
		$this->load->view('admin/_footer');
	}


	/*
	|-----------------------------------------------
	|	 ChackSchedule 
	|-----------------------------------------------
	*/
	public function chackSchedul($cdata)
	{
			extract($cdata);
			$query = $this->db->select("*")
			->from("schedul_setup_tbl")
			->where('doctor_id', $doctor_id)
			->where('venue_id', $venue_id)
			->where('day', $day)
			->get();

	    return $result = $query->result();
	}

	/*
	|-----------------------------------------------
	|	Schedule data save 
	|-----------------------------------------------
	*/
	public function save_schedule()
	{
		$info = $this->db->where('name','timezone')->get('web_pages_tbl')->row();
          
        date_default_timezone_set(@$info->details);


	    $this->form_validation->set_rules('venue', 'Venue', 'trim|required');
	    $this->form_validation->set_rules('s_time', 'Start time', 'trim|required');
	    $this->form_validation->set_rules('e_time', 'End time', 'trim|required');
	    $this->form_validation->set_rules('p_time', 'Per', 'trim|required');
	    $this->form_validation->set_rules('visible', 'Visible', 'trim|required');
	    $this->form_validation->set_rules('fees', 'Fees', 'trim|required');
	      
	      if ($this->form_validation->run()==true) {

	      	$d_name['day'] = $this->input->post('day',TRUE);
	      	
		    for($i=0; $i<count( $d_name['day']); $i++) {
		    	$savedata = array(
	     		'doctor_id' => $this->input->post('doctor',TRUE) , 
	     		'venue_id' => $this->input->post('venue',TRUE) , 
	     		'start_time' => $this->input->post('s_time',TRUE) , 
	     		'end_time' => $this->input->post('e_time',TRUE) , 
	     		'day' => $d_name['day'][$i] , 
	     		'per_patient_time' => $this->input->post('p_time',TRUE) , 
	     		'visibility' => $this->input->post('visible',TRUE), 
	     		'fees' => $this->input->post('fees',TRUE) 
	     	);

	       $cdata['doctor_id'] = $this->session->userdata('doctor_id');      
	       $cdata['venue_id'] = $this->input->post('venue',TRUE);      
	       $cdata['day'] = $d_name['day'][$i];

	       	//Chacking Schedul setup
	       	$result = $this->chackSchedul($cdata); 
	        if( ! empty($result)) {

		       		$this->session->set_flashdata('err','<label class="col-md-3 control-label"></label>
				    <div class="col-md-5">
				        <div class="alert alert-danger">
				            <h3>ERROR MESSAGE!</h3>
				            <p>'.display('schedule_error_msg').'</p>
				        </div>
				    </div>');
		       		redirect('admin/Schedule_controller/add_schedule');
	           } else {
	           	$this->schedule_model->insert_schedule($savedata);
				$action_link = $this->db->insert_id();
				$user_id = $this->session->userdata('log_id');
				$action_title = 'Add Schedule';
				$action_description = 'User Add schedule';
				$add_date = date('Y-m-d h:i:s');
				$sql_int = "insert into user_action_log (user_id,action_title,action_description,action_link,add_date) values ('$user_id','$action_title','$action_description','$action_link','$add_date')";
				$this->db->query($sql_int);
	           }
		    }


		    $this->session->set_flashdata('message',"<div class='alert alert-success msg'>".display('schedule_add_msg')."</div>");
        	redirect('admin/Schedule_controller/add_schedule');

	      } else {

		   $data['venue_info'] = $this->venue_model->get_venue_list(); 
		   $data['doctor_info'] = $this->doctor_model->getDoctorListByselect();
	        $this->load->view('admin/_header',$data);
			$this->load->view('admin/_left_sideber');
			$this->load->view('admin/view_setup_schedule');
			$this->load->view('admin/_footer');
	     }      
    }

/*
|-----------------------------------------------
|	 schedul_active
|-----------------------------------------------
*/
    public function schedul_active($id)
    {
    	$this->db->set('visibility','1')
    	->where('schedul_id',$id)
    	->update('schedul_setup_tbl');
    	 redirect('admin/Schedule_controller/schedule_list');
    }

/*
|-----------------------------------------------
|	 schedul_inactive
|-----------------------------------------------
*/
	public function schedul_inactive($id)
	{
		$this->db->set('visibility','0')
		->where('schedul_id',$id)
		->update('schedul_setup_tbl');
		 redirect('admin/Schedule_controller/schedule_list');
	}  

/*
|-----------------------------------------------
|	Schedule data Edit form view 
|-----------------------------------------------
*/
    public function schedul_edit($id)
    {
    	$data['title'] = "Edit Schedule";
        $data['venue_info'] = $this->venue_model->get_venue_list();
    	$data['schedul_info'] = $this->schedule_model->get_inde_schedul_list($id);
    
    	$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/view_schedul_edit');
		$this->load->view('admin/_footer');
    }

/*
|-----------------------------------------------
|	Edit save Schedule data 
|-----------------------------------------------
*/
    public function edit_schedul_stup()
    {
         $s_id = $this->input->post('id',TRUE) ;
         $this->form_validation->set_rules('venue', 'Venue', 'trim|required');
         $this->form_validation->set_rules('s_time', 'Start time', 'trim|required');
         $this->form_validation->set_rules('e_time', 'End time', 'trim|required');
         $this->form_validation->set_rules('day', 'Day', 'trim|required');
         $this->form_validation->set_rules('p_time', 'Per', 'trim|required');
         $this->form_validation->set_rules('visible', 'Visible', 'trim|required');
          
        if ($this->form_validation->run()==true) {
                 $savedata = array(
         		'doctor_id' => $this->session->userdata('doctor_id',TRUE), 
         		'venue_id' => $this->input->post('venue',TRUE), 
         		'start_time' => $this->input->post('s_time',TRUE), 
         		'end_time' => $this->input->post('e_time',TRUE), 
         		'day' => $this->input->post('day',TRUE), 
         		'per_patient_time' => $this->input->post('p_time',TRUE), 
         		'visibility' => $this->input->post('visible',TRUE), 
         		'fees' => $this->input->post('fees',TRUE) 
         		);

           $this->schedule_model->save_edit_schedul($savedata,$s_id);
		   $action_link = $s_id;
		   $user_id = $this->session->userdata('log_id');
			$action_title = 'Update Schedule';
			$action_description = 'User update schedule';
			$add_date = date('Y-m-d h:i:s');
			$sql_int = "insert into user_action_log (user_id,action_title,action_description,action_link,add_date) values ('$user_id','$action_title','$action_description','$action_link','$add_date')";
			$this->db->query($sql_int);
           $this->session->set_flashdata('message',display('update_msg'));
           redirect('admin/Schedule_controller/schedule_list');
        } else {
          	$data['schedul_info'] = (object)array(
         		'schedul_id' => $this->input->post('schedul_id',TRUE),
         		'doctor_id' => $this->input->post('doctor',TRUE),
         		'venue_id' => $this->input->post('venue',TRUE), 
         		'start_time' => $this->input->post('s_time',TRUE), 
         		'end_time' => $this->input->post('e_time',TRUE), 
         		'day' => $this->input->post('day',TRUE), 
         		'per_patient_time' => $this->input->post('p_time',TRUE), 
         		'visibility' => $this->input->post('visible',TRUE) 
         		);
          	
	        $data['venue_info'] = $this->venue_model->get_venue_list(); 

        	$this->load->view('admin/_header',$data);
			$this->load->view('admin/_left_sideber');
			$this->load->view('admin/view_schedul_edit');
			$this->load->view('admin/_footer');
        }
    }
    
/*
|-------------------------------
| schedule delete funciotn
|-------------------------------
*/
    public function schedul_delete($id)
    {
		$this->db->where('schedul_id',$id);
	    $this->db->delete('schedul_setup_tbl');
		$this->session->set_flashdata('message',display('delete_msg'));
	    redirect('admin/Schedule_controller/schedule_list');
    }    



}