<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial extends CI_Controller {

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
        $data['title'] = "Add New Testimonial";
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/websetting/add_testimonial');
		$this->load->view('admin/_footer');
	}

#-------------------------------------------------
#  post list
#------------------------------------------------- 
	public function testimonial_list($search=NULL)
	{
        $data['title'] = "Testimonial List";
        $data['post_info'] = $this->db->get('testimonial')->result();
       	$this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/websetting/testimonial_list');
        $this->load->view('admin/_footer');
	}




    public function save_post()
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('details', 'Details', 'trim|required|max_length[300]'); 

        if ($this->form_validation->run()==true) {
            // get picture data
            if (@$_FILES['picture']['name']){

              $config['upload_path']   = './assets/uploads/blog/';
              $config['allowed_types'] = 'gif|jpg|jpeg|png';
              $config['overwrite']     = false;
              $config['max_size']      = 1024;
              $config['remove_spaces'] = true;
              $config['max_filename']   = 10;
              $config['file_ext_tolower'] = true;
              
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('picture')){

                    $this->session->set_flashdata('exception',"<div class='alert alert-danger msg'>".$this->upload->display_errors()."</div>");
                    redirect('admin/testimonial');

            } else {

                $data = $this->upload->data();
                $image = base_url($config['upload_path'].$data['file_name']);

                #------------resize image------------#
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = $config['upload_path'].$data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
               // $config['width']    = 400;
               // $config['height']   = 320;

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
            'title' => $this->input->post('title',TRUE),            'designation' => $this->input->post('designation',TRUE),            'star' => $this->input->post('star',TRUE),
            'details' => $this->input->post('details',True),
            'picture' => $image,
            'create_by' => $post_by,
            'post_date'=>$create_date,
            );

            $savedata = $this->security->xss_clean($savedata); 
            $this->db->insert('testimonial',$savedata);
            $this->session->set_flashdata('message','<div class="alert alert-success">Add successful</div>');
            redirect('admin/testimonial');
        } else {
            $data['title'] = "Add New Testimonial";            
            $this->load->view('admin/_header',$data);			
            $this->load->view('admin/_left_sideber');
            $this->load->view('admin/websetting/add_testimonial');
            $this->load->view('admin/_footer');
        }
  }



#-------------------------------------------------
#  view edit post
#------------------------------------------------- 
  public function edit_post($id=NULL)
  {
        $data['title'] = "Edit Post";
        $data['post_info'] = $this->db->where('id',$id)->get('testimonial')->row();
        $this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/websetting/edit_testimonial');
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
        if (@$_FILES['picture']['name']){

            $config['upload_path']   = './assets/uploads/blog/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['overwrite']     = false;
            $config['max_size']      = 1024;
            $config['remove_spaces'] = true;
            $config['max_filename']   = 10;
            $config['file_ext_tolower'] = true;
              
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('picture')){
                $this->session->set_flashdata('exception',"<div class='alert alert-danger msg'>".$this->upload->display_errors()."</div>");
                redirect('admin/testimonial/post_list');
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

            


            $savedata =  array(
                'title' => $this->input->post('title',TRUE),								'designation' => $this->input->post('designation',TRUE),								'star' => $this->input->post('star',TRUE),
                'details' => $this->input->post('details',TRUE),
                'picture' => $image,
            );
            
            $id = $this->input->post('id',TRUE);


            $savedata = $this->security->xss_clean($savedata); 
            
            $this->db->where('id',$id)->update('testimonial',$savedata);
            $this->session->set_flashdata('message','<div class="alert alert-success">'.display('update_msg').'</div>');
            redirect('admin/testimonial/testimonial_list');
        } else {

            redirect('admin/testimonial/testimonial_list');
        }
}



    public function delete_post($id=NULL)
    {
        $this->db->where('id',$id)->delete('testimonial');
        $this->session->set_flashdata('message','<div class="alert alert-success">'.display('delete_msg').'</div>');
        redirect('admin/testimonial/testimonial_list');
    }


}