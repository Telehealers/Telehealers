<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Servicestype extends CI_Controller {

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
		$this->load->model('admin/Doctor_model','doctor_model');
	}




#------------------------------------------------
#       view create new post form
#------------------------------------------------
	public function index()
	{
        $data['title'] = "Add New Services type";
		$data['services'] = $this->db->get('service')->result();
		//echo "<pre>";print_r($data['services']);die();
		$data['doctor_info'] = $this->doctor_model->getDoctorListByselect();
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/websetting/add_servicetype');
		$this->load->view('admin/_footer');
	}

#-------------------------------------------------
#  post list
#------------------------------------------------- 
	public function servicetype_list($search=NULL)
	{
        $data['title'] = "Services Type List";
        //$data['post_info'] = $this->db->get('servicetype')->result();
		$SQL = "select a.*,b.title from servicetype as a , service as b where a.service=b.id";
		$query = $this->db->query($SQL);
		$data['post_info'] = $query->result_array();
		//echo "<pre>";print_r($result);die();
		//echo "<pre>";print_r($data['post_info']);die();
       	$this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/websetting/servicetype_list');
        $this->load->view('admin/_footer');
	}



    /** A function to add servicetype to db tables.
     * Inserts in servicetype, servicetype_to_doctor_map.
     */
    public function save_post()
    {
        $this->form_validation->set_rules('service', 'Servie', 'trim|required');
        $this->form_validation->set_rules('servicetype', 'Services type', 'trim|required');
		
        if ($this->form_validation->run()==true) {
            // get picture data
            if(!empty($this->session->userdata('doctor_id'))){
              $post_by = $this->session->userdata('doctor_id');
            } else {
              $post_by = $this->session->userdata('user_id');
            }
            /**servicetype insertion */
            $create_date = date('Y-m-d');
			$assign_doctors = $this->input->post('assign_doctors',TRUE);
            $service = $this->input->post('service',TRUE);
            $servicetype = $this->input->post('servicetype',TRUE);
            $savedata =  array(
				'service' => $service,
				'servicetype' => $servicetype,
				'create_by' => $post_by,
				'doctors' => "",
				'post_date'=>$create_date
            );
            $savedata = $this->security->xss_clean($savedata); 
            $this->db->insert('servicetype',$savedata);
            /** Insert into servicetyp_to_doctor_map */
            $servicetype_id = $this->db->insert_id();
            $servicetype_doctor_map_values = array();
            foreach($assign_doctors as $doctor_id) {
                array_push($servicetype_doctor_map_values, "(".$servicetype_id." , ".$doctor_id.")");
            }
            $servicetype_doctor_map_query = "INSERT INTO servicetype_to_doctor_map (servicetype_id, doctor_id) VALUES ".
                implode(",", $servicetype_doctor_map_values);
            $this->db->query($servicetype_doctor_map_query);
            $this->session->set_flashdata('message','<div class="alert alert-success">Add successful</div>');
            redirect('admin/servicestype');
        } else {
            $data['title'] = "Add New Service Type";    
			$data['services'] = $this->db->get('service')->result();
			$data['doctor_info'] = $this->doctor_model->getDoctorListByselect();
            $this->load->view('admin/_header',$data);			
            $this->load->view('admin/_left_sideber');
            $this->load->view('admin/websetting/add_servicetype');
            $this->load->view('admin/_footer');
        }
  }



#-------------------------------------------------
#  view edit post
#------------------------------------------------- 
  public function edit_post($id=NULL)
  {
        $data['title'] = "Edit Post";
        $data['post_info'] = $this->db->where('id',$id)->get('servicetype')->row();
		$data['services'] = $this->db->get('service')->result();
		$data['doctor_info'] = $this->doctor_model->getDoctorListByselect();
        $this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/websetting/edit_servicetype');
        $this->load->view('admin/_footer');
  }

#-------------------------------------------------
#  save edit post 
#------------------------------------------------- 
public function save_edit_post()
{
    $this->form_validation->set_rules('service', 'service', 'trim|required');
    $this->form_validation->set_rules('servicetype', 'service type', 'trim|required');
    
    if ($this->form_validation->run()==true) {
        // get picture data
		
		$assign_doctors = $this->input->post('assign_doctors',TRUE);
			$doctorsArr = implode(',',$assign_doctors);
       
            $savedata =  array(
                'service' => $this->input->post('service',TRUE),								
                'servicetype' => $this->input->post('servicetype',TRUE),
				'doctors' => $doctorsArr
			);
            
            $id = $this->input->post('id',TRUE);


            $savedata = $this->security->xss_clean($savedata); 
            
            $this->db->where('id',$id)->update('servicetype',$savedata);

            /** Insert into servicetyp_to_doctor_map */
            $servicetype_doctor_map_values = array();
            foreach($assign_doctors as $doctor_id) {
                array_push($servicetype_doctor_map_values, "(".$id." , ".$doctor_id.")");
            }
            $servicetype_doctor_map_query = "INSERT INTO servicetype_to_doctor_map (servicetype_id, doctor_id) VALUES ".
                implode(",", $servicetype_doctor_map_values);
            $this->db->query($servicetype_doctor_map_query);

            $this->session->set_flashdata('message','<div class="alert alert-success">'.display('update_msg').'</div>');
            redirect('admin/servicestype/servicetype_list');
        } else {

            redirect('admin/servicestype/servicetype_list');
        }
}



    public function delete_post($id=NULL)
    {
        $this->db->where('id',$id)->delete('servicetype');
        $this->session->set_flashdata('message','<div class="alert alert-success">'.display('delete_msg').'</div>');
        redirect('admin/servicestype/servicetype_list');
    }


}