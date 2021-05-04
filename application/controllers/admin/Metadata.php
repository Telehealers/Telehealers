<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Metadata extends CI_Controller {

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
        $data['title'] = "Add New Metadata";
		$data['services'] = $this->db->get('metadata')->result();
		//echo "<pre>";print_r($data['services']);die();
		$data['doctor_info'] = $this->doctor_model->getDoctorListByselect();
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/websetting/add_metadata');
		$this->load->view('admin/_footer');
	}

#-------------------------------------------------
#  post list
#------------------------------------------------- 
	public function metadata_list($search=NULL)
	{
        $data['title'] = "Metadata List";
        $data['post_info'] = $this->db->get('metadata')->result();
		//$SQL = "select a.*,b.title from servicetype as a , service as b where a.service=b.id";
		//$query = $this->db->query($SQL);
		//$data['post_info'] = $query->result_array();
		//echo "<pre>";print_r($result);die();
		//echo "<pre>";print_r($data['post_info']);die();
       	$this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/websetting/metadata_list');
        $this->load->view('admin/_footer');
	}




    public function save_post()
    {
        $this->form_validation->set_rules('page', 'page', 'trim|required');
        $this->form_validation->set_rules('page_title', 'page title', 'trim|required');
        $this->form_validation->set_rules('meta_title', 'meta title', 'trim|required');
        $this->form_validation->set_rules('meta_keywords', 'meta keywords', 'trim|required');
        $this->form_validation->set_rules('meta_description', 'meta description', 'trim|required');
		
        if ($this->form_validation->run()==true) {
            
            
			$savedata =  array(
				'page' => $this->input->post('page',TRUE),
				'page_title' => $this->input->post('page_title',TRUE),	
				'meta_title' => $this->input->post('meta_title',TRUE),
				'meta_keywords' => $this->input->post('meta_keywords',TRUE),
				'meta_description'=>$this->input->post('meta_description',TRUE)
            );

            $savedata = $this->security->xss_clean($savedata); 
            $this->db->insert('metadata',$savedata);
            $this->session->set_flashdata('message','<div class="alert alert-success">Add successful</div>');
            redirect('admin/metadata');
        } else {
            $data['title'] = "Add New Metadata";    
			$data['services'] = $this->db->get('metadata')->result();
			$data['doctor_info'] = $this->doctor_model->getDoctorListByselect();
            $this->load->view('admin/_header',$data);			
            $this->load->view('admin/_left_sideber');
            $this->load->view('admin/websetting/add_metadata');
            $this->load->view('admin/_footer');
        }
  }



#-------------------------------------------------
#  view edit post
#------------------------------------------------- 
  public function edit_post($id=NULL)
  {
        $data['title'] = "Edit Post";
        $data['post_info'] = $this->db->where('id',$id)->get('metadata')->row();
		$data['services'] = $this->db->get('service')->result();
		$data['doctor_info'] = $this->doctor_model->getDoctorListByselect();
        $this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/websetting/edit_metadata');
        $this->load->view('admin/_footer');
  }

#-------------------------------------------------
#  save edit post 
#------------------------------------------------- 
public function save_edit_post()
{
    $this->form_validation->set_rules('meta_title', 'meta title', 'trim|required');
	$this->form_validation->set_rules('meta_keywords', 'meta keywords', 'trim|required');
	$this->form_validation->set_rules('meta_description', 'meta description', 'trim|required');
    
    if ($this->form_validation->run()==true) {
        // get picture data
		
		
            $savedata =  array(
                'meta_title' => $this->input->post('meta_title',TRUE),
				'meta_keywords' => $this->input->post('meta_keywords',TRUE),
				'meta_description'=>$this->input->post('meta_description',TRUE)
			);
            
            $id = $this->input->post('id',TRUE);


            $savedata = $this->security->xss_clean($savedata); 
            
            $this->db->where('id',$id)->update('metadata',$savedata);
            $this->session->set_flashdata('message','<div class="alert alert-success">'.display('update_msg').'</div>');
            redirect('admin/metadata/metadata_list');
        } else {

            redirect('admin/metadata/metadata_list');
        }
}



    public function delete_post($id=NULL)
    {
        $this->db->where('id',$id)->delete('metadata');
        $this->session->set_flashdata('message','<div class="alert alert-success">'.display('delete_msg').'</div>');
        redirect('admin/metadata/metadata_list');
    }


}