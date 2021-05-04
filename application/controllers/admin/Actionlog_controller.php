<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Actionlog_Controller extends CI_Controller {
	/*
	|-----------------------------------------------
	|	 Constructor funcion
	|-----------------------------------------------
	*/
	public function __construct() 
	{
		parent::__construct();
		$this->load->library('session');
		 $session_id = $this->session->userdata('session_id'); 
	    if($session_id == NULL ) {
	     redirect('logout');
	    }

	    $this->load->model('admin/Venue_model','venue_model');
	}
	
	/*
	|-----------------------------------------------
	|	 venue_list
	|-----------------------------------------------
	*/	
	public function index()
	{
		//echo "here...";die();
		$data['title'] = "User Action Log List";
		$SQL4 = "select * from user_action_log";
		$query4 = $this->db->query($SQL4);
		$result4 = $query4->result_array();
		
		//echo "<pre>";print_r($result4);die();
		
		$data['action_info'] = $result4;
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/view_user_actionlog');
		$this->load->view('admin/_footer');
	}

	
	/*
	|-----------------------------------------------
	|	 Delete  venue
	|-----------------------------------------------
	*/
    public function delet_actionlog($id)
    {
      $this->db->where('id',$id);
      $this->db->delete('user_action_log');
	  $this->session->set_flashdata('message','<div class="alert alert-success msg">'.display('delete_msg').'</div>');
      redirect('admin/Actionlog_controller');
    }

}