<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'../zoom/config.php';

class Page404 extends CI_Controller {
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
		
		$data['service'] = $this->db->get('service')->result();
		
		//get doctor list for appointmaent
		$data['doctor_info_for_appo'] = $this->doctor_model->getDoctorListByselect();

		$meta_sql = "select * from metadata where id = '5'";
		$res_meta = $this->db->query($meta_sql);
		$data['meta_info'] = $res_meta->result_array();
      

        #------view page----------
        $this->load->view('errorpage',$data);
	}

}
