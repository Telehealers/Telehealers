<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Precautions_controller extends CI_Controller {

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
	    $this->load->model('admin/Precautions_model','precautions_model');
	}

#------------------------------------------------
#       view create new post form
#------------------------------------------------
	public function index()
	{
    $data['title'] = "Add New Precautions";
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/websetting/view_create_new_precautions');
		$this->load->view('admin/_footer');
	}

#-------------------------------------------------
#  post list
#------------------------------------------------- 
	public function precautions_list($search=NULL)
	{
        $data['title'] = "Precautions List";
        $data['post_info'] = $this->precautions_model->get_all_post();
		$this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/websetting/view_precautions_list');
        $this->load->view('admin/_footer');
	}

  public function save_post()
  {
      $this->form_validation->set_rules('title', 'Title', 'trim|required');
      $this->form_validation->set_rules('details', 'Details', 'trim|required');      
      if ($this->form_validation->run()==true) {
          // get picture data
          if (@$_FILES['picture']['name']){

              $config['upload_path']   = './assets/uploads/precautions/';
              $config['allowed_types'] = 'gif|jpg|jpeg|png';
              $config['overwrite']     = false;
              $config['max_size']      = 1024;
              $config['remove_spaces'] = true;
              $config['max_filename']   = 10;
              $config['file_ext_tolower'] = true;
              
              $this->load->library('upload', $config);
              if (!$this->upload->do_upload('picture')){
                  $this->session->set_flashdata('exception',"<div class='alert alert-danger msg'>".$this->upload->display_errors()."</div>");
                    redirect('admin/Precautions_controller');
              } else {
                $data = $this->upload->data();
                $image = base_url($config['upload_path'].$data['file_name']);

                #------------resize image------------#
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = $config['upload_path'].$data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['width']    = 400;
                $config['height']   = 320;

                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                #-------------resize image----------#
              }
            } else {
              $image = "NULL";
            }

            if(!empty($this->session->userdata('doctor_id'))){
              $post_by = $this->session->userdata('doctor_id');
            } else {
              $post_by = $this->session->userdata('user_id');
            }

            $create_date = date('Y-m-d');

            $savedata =  array(
                'title' => $this->input->post('title',TRUE),
                'details' => $this->input->post('details',TRUE),
                'picture' => $image,
                'post_by' => $post_by,
                'post_date'=>$create_date,
                'post_category'=>$this->input->post('category',TRUE)
            );

            $savedata = $this->security->xss_clean($savedata);
			
            $this->precautions_model->save_new_post($savedata);	

			$user_id = $this->session->userdata('log_id');	

			$action_title = 'Add Precautions';		
			
			$action_description = 'Admin add new Precautions';

			$add_date = date('Y-m-d h:i:s');	

			$sql_int = "insert into user_action_log (user_id,action_title,action_description,add_date) values ('$user_id','$action_title','$action_description','$add_date')";	

			$this->db->query($sql_int);
			
			
            $this->session->set_flashdata('message','<div class="alert alert-success">Add Successful</div>');
            
			
			redirect('admin/Precautions_controller');
        } else {
          $data['title'] = "Add New Precautions";
          $this->load->view('admin/_header',$data);
          $this->load->view('admin/_left_sideber');
          $this->load->view('admin/websetting/view_create_new_precautions');
          $this->load->view('admin/_footer');
        }
  }

#-------------------------------------------------
#  view edit post
#------------------------------------------------- 
  public function edit_post($id=NULL)
  {
    $data['title'] = "Edit Precautions";
    $data['post_info'] = $this->precautions_model->get_post_by_id($id);
    $this->load->view('admin/_header',$data);
    $this->load->view('admin/_left_sideber');
    $this->load->view('admin/websetting/view_edit_precautions');
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
        if (@$_FILES['picture']['name']){

            $config['upload_path']   = './assets/uploads/precautions/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['overwrite']     = false;
            $config['max_size']      = 1024;
            $config['remove_spaces'] = true;
            $config['max_filename']   = 10;
            $config['file_ext_tolower'] = true;
              
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('picture')){
                $this->session->set_flashdata('exception',"<div class='alert alert-danger msg'>".$this->upload->display_errors()."</div>");
                redirect('admin/precautions_controller/precautions_list');
            } else {
                    $data = $this->upload->data();
                    $image = base_url($config['upload_path'].$data['file_name']);

                    #------------resize image------------#
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $config['upload_path'].$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width']    = 400;
                    $config['height']   = 320;

                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    #-------------resize image----------#
                }
            } else {
              $image = $this->input->post('pic',TRUE);
            }

            if(!empty($this->session->userdata('doctor_id'))){
              $post_by = $this->session->userdata('doctor_id');
            } else {
              $post_by = $this->session->userdata('user_id');
            }
            
            $savedata =  array(
            'title' => $this->input->post('title',TRUE),
            'details' => $this->input->post('details',TRUE),
            'picture' => $image,
            'post_category'=>$this->input->post('category',TRUE)
            );
            $id = $this->input->post('id',TRUE);

            $savedata = $this->security->xss_clean($savedata); 
            
            $this->precautions_model->save_update_post($savedata,$id);	

			$user_id = $this->session->userdata('log_id');	

			$action_title = 'Update Precautions';		
			
			$action_description = 'Admin update Precautions';	

			$add_date = date('Y-m-d h:i:s');	

			$sql_int = "insert into user_action_log (user_id,action_title,action_description,add_date) values ('$user_id','$action_title','$action_description','$add_date')";	

			$this->db->query($sql_int);
			
			
            $this->session->set_flashdata('message','<div class="alert alert-success">'.display('update_msg').'</div>');
            redirect('admin/Precautions_controller/precautions_list');
        } else {
         redirect('admin/Precautions_controller/precautions_list');
        }
}

#-------------------------------------------------
#  delete_post
#------------------------------------------------- 
    public function delete_post($id=NULL)
    {
        $this->db->where('id',$id)->delete('precautions_tbl');
         $this->session->set_flashdata('message','<div class="alert alert-success">'.display('delete_msg').'</div>');
        redirect('admin/Precautions_controller/precautions_list');
    }


}