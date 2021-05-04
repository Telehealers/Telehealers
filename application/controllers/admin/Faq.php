<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

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
        $data['title'] = "Add New Faq";
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/websetting/add_faq');
		$this->load->view('admin/_footer');
	}

#-------------------------------------------------
#  post list
#------------------------------------------------- 
	public function faq_list($search=NULL)
	{
        $data['title'] = "Faq List";
        $data['post_info'] = $this->db->get('faq')->result();
       	$this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/websetting/faq_list');
        $this->load->view('admin/_footer');
	}




    public function save_post()
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('details', 'Details', 'trim|required|max_length[1600]'); 

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
			'details' => $this->input->post('details',True),
            'create_by' => $post_by,
            'post_date'=>$create_date,
            );

            $savedata = $this->security->xss_clean($savedata); 
            $this->db->insert('faq',$savedata);
            $this->session->set_flashdata('message','<div class="alert alert-success">Add successful</div>');
            redirect('admin/faq');
        } else {
            $data['title'] = "Add New Faq";            
            $this->load->view('admin/_header',$data);			
            $this->load->view('admin/_left_sideber');
            $this->load->view('admin/websetting/add_faq');
            $this->load->view('admin/_footer');
        }
  }



#-------------------------------------------------
#  view edit post
#------------------------------------------------- 
  public function edit_post($id=NULL)
  {
        $data['title'] = "Edit Post";
        $data['post_info'] = $this->db->where('id',$id)->get('faq')->row();
        $this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/websetting/edit_faq');
        $this->load->view('admin/_footer');
  }

#-------------------------------------------------
#  save edit post 
#------------------------------------------------- 
public function save_edit_post()
{
    $this->form_validation->set_rules('title', 'Title', 'trim|required');
    $this->form_validation->set_rules('details', 'Details', 'trim|required'); 

    if ($this->form_validation->run()==true) {
        // get picture data
       
            $savedata =  array(
                'title' => $this->input->post('title',TRUE),								'details' => $this->input->post('details',TRUE)
			);
            
            $id = $this->input->post('id',TRUE);


            $savedata = $this->security->xss_clean($savedata); 
            
            $this->db->where('id',$id)->update('faq',$savedata);
            $this->session->set_flashdata('message','<div class="alert alert-success">'.display('update_msg').'</div>');
            redirect('admin/faq/faq_list');
        } else {

            redirect('admin/faq/faq_list');
        }
}



    public function delete_post($id=NULL)
    {
        $this->db->where('id',$id)->delete('faq');
        $this->session->set_flashdata('message','<div class="alert alert-success">'.display('delete_msg').'</div>');
        redirect('admin/faq/faq_list');
    }


}