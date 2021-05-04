<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Basic_controller extends CI_Controller {

/*
|--------------------------------------
|    constructor function
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
	    $this->load->model('admin/Basic_model','basic_model');
        $this->load->model('web/Home_view_model','home_view_model');
    }

/*
|--------------------------------------
|     view  print_appointment_info
|--------------------------------------
*/ 
    public function print_appointment_info()
    {
        $appointment_id = $this->session->userdata('appointment_id'); 
        $data['print'] = $this->basic_model->get_appointment_print_result($appointment_id);
        $data['info'] = $this->home_view_model->Home_satup();
    		
    		if($data){
             	 $this->load->view('public/patient_appointment_info',$data); 
            } else {
                if($this->session->userdata('log_id')) {
                redirect('admin/Appointment_controller');
            	} else {
    	          redirect("index");
    	        } 
            } 
    }
    
/*
|--------------------------------------
|    my_appointment view 
|--------------------------------------
*/ 
    public function my_appointment($appointment_id=NULL)
    {
    	if(isset($appointment_id)) {

            $data['info'] = $this->home_view_model->Home_satup();

            $query_result = $this->db->select("action_serial.*,
                patient_tbl.*,
                doctor_tbl.department,
                doctor_tbl.doctor_name,								doctor_department_info.department_name,
                venue_tbl.*,
                log_info.*")
                ->from('action_serial')
                ->join('patient_tbl', 'patient_tbl.patient_id = action_serial.patient_id','left')				 ->join('doctor_tbl', 'doctor_tbl.doctor_id = action_serial.doctor_id','left')
                ->join('doctor_department_info', 'doctor_department_info.department_id = doctor_tbl.department','left')
                ->join('venue_tbl', ' venue_tbl.venue_id = action_serial.venue_id','left')
                ->join('log_info', ' log_info.log_id = doctor_tbl.log_id','left')
                ->where('action_serial.appointment_id',$appointment_id)
                ->get();
                $result = $query_result->row();
                $data['print'] = $result;


            $this->load->view('public/patient_appointment_info',$data);

        } else {
              redirect("");
        }
    }        

}