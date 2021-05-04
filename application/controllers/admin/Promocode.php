<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Promocode extends CI_Controller {

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



function randstrGenapp($len) 
{
    $result = "";
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    $charArray = str_split($chars);
    for($i = 0; $i < $len; $i++) {
            $randItem = array_rand($charArray);
            $result .="".$charArray[$randItem];
    }
    return $result;
}
#------------------------------------------------
#       view create new post form
#------------------------------------------------
	public function index()
	{
        $data['title'] = "Add New Promocode";
		$data['promocode'] = "P".date('y').strtoupper($this->randstrGenapp(5));
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/websetting/add_promocode');
		$this->load->view('admin/_footer');
	}

#-------------------------------------------------
#  post list
#------------------------------------------------- 
	public function promocode_list($search=NULL)
	{
        $data['title'] = "Promocode List";
		$data['post_info'] = $this->db->get('promocode')->result();
       	$this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/websetting/promocode_list');
        $this->load->view('admin/_footer');
	}




    public function save_post()
    {
        $this->form_validation->set_rules('title', 'Promocode', 'trim|required');
		$this->form_validation->set_rules('p_limit', 'Limit', 'trim|required');
		$this->form_validation->set_rules('p_price', 'Price', 'trim|required|numeric|xss_clean');
        
        if ($this->form_validation->run()==true) {
            // get picture data
            if(!empty($this->session->userdata('doctor_id'))){
              $post_by = $this->session->userdata('doctor_id');
            } else {
              $post_by = $this->session->userdata('user_id');
            }
			$pro_code = $this->input->post('title',TRUE);
			$sql = "select * from promocode where title = '".$pro_code."'";
			$res = $this->db->query($sql);
			$result = $res->result_array();
			if(is_array($result) && count($result)>0){
				$this->session->set_flashdata('message','<div class="alert alert-danger">PromoCode  must be unique</div>');
				redirect('admin/promocode');
			}else{
				$create_date = date('Y-m-d');

				$savedata =  array(
					'title' => $this->input->post('title',TRUE), 
					'p_limit' => $this->input->post('p_limit',TRUE),
					'price'=> $this->input->post('p_price',TRUE), 
				);
				
				$savedata = $this->security->xss_clean($savedata); 
				$this->db->insert('promocode',$savedata);
				$this->session->set_flashdata('message','<div class="alert alert-success">Add successful</div>');
				redirect('admin/promocode');
			}	
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-danger">Price must be numberic</div>');
            redirect('admin/promocode');
        }
  }



#-------------------------------------------------
#  view edit post
#------------------------------------------------- 
  public function edit_post($id=NULL)
  {
        $data['title'] = "Edit Post";
        $data['post_info'] = $this->db->where('id',$id)->get('promocode')->row();
        $this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/websetting/edit_promocode');
        $this->load->view('admin/_footer');
  }

#-------------------------------------------------
#  save edit post 
#------------------------------------------------- 
public function save_edit_post()
{
    $this->form_validation->set_rules('title', 'Title', 'trim|required');
	$this->form_validation->set_rules('p_limit', 'Limit', 'trim|required');
	$this->form_validation->set_rules('p_price', 'Price', 'trim|required|numeric|xss_clean');
    
    if ($this->form_validation->run()==true) {
        // get picture data
       $pro_code = $this->input->post('title',TRUE);
	   $id = $this->input->post('id',TRUE);
			$sql = "select * from promocode where id != '$id' and title = '".$pro_code."'";
			$res = $this->db->query($sql);
			$result = $res->result_array();
			if(is_array($result) && count($result)>0){
				$this->session->set_flashdata('message','<div class="alert alert-danger">PromoCode  must be unique</div>');
				redirect('admin/promocode');
			}else{
				
            $savedata =  array(
               'title' => $this->input->post('title',TRUE), 
				'p_limit' => $this->input->post('p_limit',TRUE), 
				'price'=> $this->input->post('p_price',TRUE)							
			);
            
           


            $savedata = $this->security->xss_clean($savedata); 
            
            $this->db->where('id',$id)->update('promocode',$savedata);
            $this->session->set_flashdata('message','<div class="alert alert-success">'.display('update_msg').'</div>');
            redirect('admin/promocode/promocode_list');
		}	
        } else {

            redirect('admin/promocode/promocode_list');
        }
}



    public function delete_post($id=NULL)
    {
        $this->db->where('id',$id)->delete('promocode');
        $this->session->set_flashdata('message','<div class="alert alert-success">'.display('delete_msg').'</div>');
        redirect('admin/promocode/promocode_list');
    }


}