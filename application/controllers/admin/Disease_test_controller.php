<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Disease_test_controller extends CI_Controller {

	/*
	|------------------------------------
	|  construction funcion
	|------------------------------------
	*/	
	public function __construct() 
	{
		parent::__construct();
	    $this->load->library('session');
		$session_id = $this->session->userdata('session_id');	
	    if($session_id == NULL ) {
	     redirect('logout');
	    }
        $this->load->model('admin/Disease_test_model','disease_test_model');
	 }

	/*
	|------------------------------------
	|add AddTestName view form
	|------------------------------------
	*/	 
	public function add_new_test()
	{
		$data['title'] = "Add New Test";
		$this->load->view('admin/_header');
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/setup/view_add_test_name');
		$this->load->view('admin/_footer');
	}
	
	/*
	|--------------------------------------
	|save test Name 
	|--------------------------------------
	*/	 
	public function save_test_name(){
		$tesAdd = array(
			'test_name' => $this->input->post('test_name',TRUE),
			'test_description' => $this->input->post('test_description',TRUE)
			 );
		$test_name = $this->input->post('test_name',TRUE);
		
		$query = $this->db->select('*')
 	 			->from('test_name_tbl')
 	 			->where('test_name',$test_name)
 	 			->get()
 	 			->row();
		if(!empty($query)) {
			$this->session->set_flashdata('msg','<div class="alert alert-danger msg">This Test allrady Inserted</div><br>');
			redirect('admin/Disease_test_controller/add_new_test');
		} else {
		$this->disease_test_model->insert_test_name($tesAdd);
		$group_id = $this->db->insert_id();
		$action_link = $group_id;
		$user_id = $this->session->userdata('log_id');
		$action_title = 'Add Test';
		$action_description = 'User add Test ('.$test_name.')';
		$add_date = date('Y-m-d h:i:s');
		$sql_int = "insert into user_action_log (user_id,action_title,action_description,action_link,add_date) values ('$user_id','$action_title','$action_description','$action_link','$add_date')";
		$this->db->query($sql_int);
		$this->session->set_flashdata('msg', display('test_add_msg'));
		redirect('admin/Disease_test_controller/add_new_test');
		}
	}

	/*
	|----------------------------------------
	|test Name list 
	|----------------------------------------
	*/	 
	public function test_list()
	{
		$data['t_info']=$this->disease_test_model->get_test_name();

		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/setup/view_test_name_list');
		$this->load->view('admin/_footer');
	}

	/*
	|---------------------------------------
	|edit test Name 
	|---------------------------------------
	*/	 
	public function edit_test_name($id=NULL)
	{
		
		$result = $this->db->select('*')
		->from('test_name_tbl')
		->where('test_id',$id)
		->get()
		->row();

		 if($result){
			echo ''.form_open('admin/Disease_test_controller/save_edit_test',array('class'=>'form-horizental')).'
		                   
               <div class="col-md-12 ">
	            <div  class="panel panel-default panel-form">
	                <div class="panel-body">
	                
                                
		                   <div class="form-body"> 
                     			<input type="hidden" class="form-control" value="'.$result->test_id.'" name="id" />
                                
                                <div class="form-group">
                                    <label class="control-label col-md-3"> '.display('test_name').' </label>
                                    <div class="col-md-7">
                                        <input type="text" value="'.$result->test_name.'"class="form-control" name="test_name" />
                                    </div>
                                </div><br><br>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">'.display('description').' :</label>
                                    <div class="col-md-7">
                                         <textarea name="test_description" class="wysihtml5 form-control" required rows="5">'.$result->test_description.'</textarea>
                                    </div>
                                </div>
                                <br><br>

		                        <div class="form-group">
		                         	<label class="col-md-8 control-label"></label>
		                            <div class="col-md-3">
						             	<button class="btn btn-primary">'.display('update').'</button>
						           </div>
						        </div>
		              	</div>
		             
		          </div>
		         </div>
		       </div>
		         </form>
		      
		    ';
        }
	}


	/*
	|-------------------------------------
	|Edit test Name 
	|-------------------------------------
	*/
	public function save_edit_test()
	{
		$tesAdd = array(
		'test_name' => $this->input->post('test_name',TRUE),
		'test_description' => $this->input->post('test_description',TRUE)
		 );

		$id = $this->input->post('id'); 
		$this->db->where('test_id',$id);
		$this->db->update('test_name_tbl',$tesAdd);
		
		$test_name = $this->input->post('test_name',TRUE);
		$action_link = $id;
		$user_id = $this->session->userdata('log_id');
		$action_title = 'Add Test';
		$action_description = 'User add Test ('.$test_name.')';
		$add_date = date('Y-m-d h:i:s');
		$sql_int = "insert into user_action_log (user_id,action_title,action_description,action_link,add_date) values ('$user_id','$action_title','$action_description','$action_link','$add_date')";
		$this->db->query($sql_int);

		$this->session->set_flashdata('del_msg', display('update_msg'));
		redirect('admin/Disease_test_controller/test_list');
	}

	/*
	|--------------------------------------
	|save test Name 
	|--------------------------------------
	*/	 
	public function delete_test_name($id)
	{
		$sql_medi = "select * from test_name_tbl where test_id = '".$id."' ";
		$query_medi = $this->db->query($sql_medi);
		$result_medi = $query_medi->result_array();
		$test_name = $result_medi[0]['test_name'];
		
		$this->db->where('test_id',$id);
		$this->db->delete('test_name_tbl');
		
		$user_id = $this->session->userdata('log_id');
		$action_title = 'Delete test';
		$action_description = 'User delete test ('.$test_name.')';
		$add_date = date('Y-m-d h:i:s');
		$sql_int = "insert into user_action_log (user_id,action_title,action_description,add_date) values ('$user_id','$action_title','$action_description','$add_date')";
		$this->db->query($sql_int);
		
		$this->session->set_flashdata('del_msg', display('delete_msg'));
		redirect('admin/Disease_test_controller/test_list');
	}

}