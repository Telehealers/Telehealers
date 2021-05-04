<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bedsdata_controller extends CI_Controller {

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
	    $this->load->model('admin/Bedsdata_model','bedsdata_model');
	}

#------------------------------------------------
#       view create new post form
#------------------------------------------------
	public function index()
	{
    $data['title'] = "Add New Bedsdata";
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/websetting/view_create_new_bedsdata');
		$this->load->view('admin/_footer');
	}

#-------------------------------------------------
#  post list
#------------------------------------------------- 
	public function resource_list($search=NULL)
	{
        $data['title'] = "Bedsdata List";
        $data['post_info'] = $this->bedsdata_model->get_all_post();
       	$this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/websetting/view_bedsdata_list');
        $this->load->view('admin/_footer');
	}

  public function save_post()
  {
      $this->form_validation->set_rules('title', 'Title', 'trim|required');
      $this->form_validation->set_rules('details', 'Details', 'trim|required');      
      if ($this->form_validation->run()==true) {
          // get picture data
          
            

           

            $savedata =  array(
                'title' => $this->input->post('title',TRUE),
                'url' => $this->input->post('details',TRUE)
            );

            $savedata = $this->security->xss_clean($savedata);
			
            $this->resource_model->save_new_post($savedata);	

			$user_id = $this->session->userdata('log_id');	

			$action_title = 'Add Bedsdata';		
			
			$action_description = 'Admin add new Bedsdata';

			$add_date = date('Y-m-d h:i:s');	

			$sql_int = "insert into user_action_log (user_id,action_title,action_description,add_date) values ('$user_id','$action_title','$action_description','$add_date')";	

			$this->db->query($sql_int);
			
			
            $this->session->set_flashdata('message','<div class="alert alert-success">Add Successful</div>');
            
			
			redirect('admin/Bedsdata_controller');
        } else {
          $data['title'] = "Add New Bedsdata";
          $this->load->view('admin/_header',$data);
          $this->load->view('admin/_left_sideber');
          $this->load->view('admin/websetting/view_create_new_bedsdata');
          $this->load->view('admin/_footer');
        }
  }

#-------------------------------------------------
#  view edit post
#------------------------------------------------- 
  public function edit_post($id=NULL)
  {
    $data['title'] = "Edit Bedsdata";
    $data['post_info'] = $this->bedsdata_model->get_post_by_id($id);
    $this->load->view('admin/_header',$data);
    $this->load->view('admin/_left_sideber');
    $this->load->view('admin/websetting/view_edit_bedsdata');
    $this->load->view('admin/_footer');
  }

#-------------------------------------------------
#  save edit post 
#------------------------------------------------- 
public function save_edit_post()
{
    $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
    $this->form_validation->set_rules('details', 'Details', 'trim|required|xss_clean');      
    if ($this->form_validation->run()==true) {
        // get picture data
        

            $savedata =  array(
            'title' => $this->input->post('title',TRUE),
            'url' => $this->input->post('details',TRUE)
            );
			
            $id = $this->input->post('id',TRUE);

            $savedata = $this->security->xss_clean($savedata); 
            
            $this->resource_model->save_update_post($savedata,$id);	

			$user_id = $this->session->userdata('log_id');	

			$action_title = 'Update Bedsdata';		
			
			$action_description = 'Admin update Bedsdata';	

			$add_date = date('Y-m-d h:i:s');	

			$sql_int = "insert into user_action_log (user_id,action_title,action_description,add_date) values ('$user_id','$action_title','$action_description','$add_date')";	

			$this->db->query($sql_int);
			
			
            $this->session->set_flashdata('message','<div class="alert alert-success">'.display('update_msg').'</div>');
            redirect('admin/bedsdata_controller/bedsdata_list');
        } else {
         redirect('admin/bedsdata_controller/bedsdata_list');
        }
}

#-------------------------------------------------
#  delete_post
#------------------------------------------------- 
    public function delete_post($id=NULL)
    {
        $this->db->where('id',$id)->delete('bedsdata_tbl');
         $this->session->set_flashdata('message','<div class="alert alert-success">'.display('delete_msg').'</div>');
        redirect('admin/bedsdata_controller/bedsdata_list');
    }


}