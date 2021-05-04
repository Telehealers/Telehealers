<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

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
	}




#------------------------------------------------
#       view create new post form
#------------------------------------------------
	public function index()
	{
        $data['title'] = "Add New Service";
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/websetting/add_service');
		$this->load->view('admin/_footer');
	}

#-------------------------------------------------
#  post list
#------------------------------------------------- 
	public function service_list($search=NULL)
	{
        $data['title'] = "Services List";
        $data['post_info'] = $this->db->get('service')->result();
       	$this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/websetting/service_list');
        $this->load->view('admin/_footer');
	}




    public function save_post()
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        
        if ($this->form_validation->run()==true) {
            // get picture data
            if(!empty($this->session->userdata('doctor_id'))){
              $post_by = $this->session->userdata('doctor_id');
            } else {
              $post_by = $this->session->userdata('user_id');
            }

            $create_date = date('Y-m-d');

            $savedata =  array(
				'title' => $this->input->post('title',TRUE), 
				'create_by' => $post_by,
				'post_date'=>$create_date,
            );

            $savedata = $this->security->xss_clean($savedata); 
            $this->db->insert('service',$savedata);
            $this->session->set_flashdata('message','<div class="alert alert-success">Add successful</div>');
            redirect('admin/services');
        } else {
            $data['title'] = "Add New Service";            
            $this->load->view('admin/_header',$data);			
            $this->load->view('admin/_left_sideber');
            $this->load->view('admin/websetting/add_service');
            $this->load->view('admin/_footer');
        }
  }



#-------------------------------------------------
#  view edit post
#------------------------------------------------- 
  public function edit_post($id=NULL)
  {
        $data['title'] = "Edit Post";
        $data['post_info'] = $this->db->where('id',$id)->get('service')->row();
        $this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/websetting/edit_service');
        $this->load->view('admin/_footer');
  }

#-------------------------------------------------
#  save edit post 
#------------------------------------------------- 
public function save_edit_post()
{
    $this->form_validation->set_rules('title', 'Title', 'trim|required');
    
    if ($this->form_validation->run()==true) {
        // get picture data
       
            $savedata =  array(
                'title' => $this->input->post('title',TRUE)								
			);
            
            $id = $this->input->post('id',TRUE);


            $savedata = $this->security->xss_clean($savedata); 
            
            $this->db->where('id',$id)->update('service',$savedata);
            $this->session->set_flashdata('message','<div class="alert alert-success">'.display('update_msg').'</div>');
            redirect('admin/services/service_list');
        } else {

            redirect('admin/services/service_list');
        }
}



    public function delete_post($id=NULL)
    {
        $this->db->where('id',$id)->delete('service');
        $this->session->set_flashdata('message','<div class="alert alert-success">'.display('delete_msg').'</div>');
        redirect('admin/services/service_list');
    }


}