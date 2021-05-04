<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Department_controller extends CI_Controller {

#--------------------------------
#      __constructor function	
#--------------------------------	
public function __construct() 
{
		parent::__construct();
		$this->load->library('session');
		$session_id = $this->session->userdata('session_id');

	    if($session_id == NULL ) {
	     redirect('logout');
	    }
	    
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('admin/Setup_model','setup_model');
		$this->load->model('admin/Doctor_model','doctor_model');
}

#--------------------------------
#      Insert_Medicine_form	
#--------------------------------	
public function add_medicine()
{
	$data['title'] = "Add New Medicine";
	$data['mdc_info'] = $this->setup_model->getMedicineCompanyInfo();;
	$data['group_info'] = $this->setup_model->getGroupInfo();

    $this->load->view('admin/_header',$data);
    $this->load->view('admin/_left_sideber');
    $this->load->view('admin/setup/view_add_medicine');
    $this->load->view('admin/_footer');
}


#--------------------------------
#      Save_Medicine	
#--------------------------------	
	public function save_medicine()
	{
		// chack previus medicine name insert
		$query = $this->db->select('*')
 	 			->from('medecine_info')
 	 			->where('medicine_name',$this->input->post('medicine_name',TRUE))
 	 			->get()
 	 			->row();

		if( ! empty($query)) {
			$this->session->set_flashdata('message','<div class="alert alert-danger msg">'.display('exist_error_msg').'</div><br>');
			redirect('admin/Setup_controller/add_medicine');
		} else {

			//company name insert
			if(empty($this->input->post('company_id',TRUE))) {
				$company  = array('company_name' =>$this->input->post('company_name',TRUE));
				
				$this->db->insert('medicine_company_info',$company);
							
				$company_id = $this->db->insert_id();
					
			 	} else {
			 		$company_id = $this->input->post('company_id',TRUE);
			 	}
			 //group name insert	
			if(empty($this->input->post('group_id',TRUE))) {
				$group['group_name'] = $this->input->post('group_name',TRUE);
				$this->db->insert('medicine_group_tbl',$group);
				$group_id = $this->db->insert_id();
					
			 	} else {
			 		$group_id = $this->input->post('group_id',TRUE);
			 	}

			$medicine = array(
				'medicine_name' => $this->input->post('medicine_name',TRUE),
				'med_company_id' => $company_id,
				'med_group_id' => $group_id,
				'med_description' => $this->input->post('description',TRUE)
			);
			$this->db->insert('medecine_info',$medicine);
			$this->session->set_flashdata('message','<div class="alert alert-success msg">'.display('medicine_add_msg').'</div><br>');
			redirect('admin/Setup_controller/add_medicine');
		}
	}

#--------------------------------
#      insert medicine company	
#--------------------------------
	public function department_list()
	{
		$data['title'] = "Add Doctor Department";
		$data['mdc_info'] = $this->doctor_model->getDoctorDepartmentInfo();
		
		//echo "<pre>";print_r($data['mdc_info']);die();
        
		$this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/doctor/view_add_doctor_department');
        $this->load->view('admin/_footer');
	}


#--------------------------------
#      Save_Medicine_company	
#--------------------------------
public function save_doctor_department()
{	
	$c_name = $this->input->post('department_name',TRUE); 
	$query = $this->db->select('*')
	 			->from('doctor_department_info')
	 			->where('department_name',$c_name)
	 			->get()
	 			->row();



	if(!empty($query)) {
		$this->session->set_flashdata('message','<div class="alert alert-danger msg">'.display('exist_error_msg').'</div><br>');
		redirect('admin/Department_controller/department_list');
	} else {
		$company  = array('department_name' =>$this->input->post('department_name',TRUE));
		$this->db->insert('doctor_department_info',$company);
		$user_id = $this->session->userdata('log_id');
		$action_title = 'Add Doctor Department';
		$action_description = 'User add new doctor department';
		$add_date = date('Y-m-d h:i:s');
		$sql_int = "insert into user_action_log (user_id,action_title,action_description,add_date) values ('$user_id','$action_title','$action_description','$add_date')";
		$this->db->query($sql_int);
		$this->session->set_flashdata('message','<div class="alert alert-success msg">Department inserted Successful.</div><br>');
		redirect('admin/Department_controller/department_list');
	}
}

	public function edit_doctor_department($id=NULL)
	{
		$data['title'] = "Edit Doctor Department";
		$data['mdc_info'] = $this->doctor_model->getDoctorDepartmentInfo();
		$data['depart_info'] = $this->doctor_model->getDoctorDepartmentByID($id);
		//echo "<pre>";print_r($data['mdc_info']);die();
        
		$this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/doctor/edit_doctor_department');
        $this->load->view('admin/_footer');
	}
	
	public function update_doctor_department()
	{	
		$d_id = $this->input->post('department_id',TRUE); 
		$d_name = $this->input->post('department_name',TRUE); 
		
		$department = array('department_name' => $d_name);
		
		$this->db->where('department_id',$d_id);
		$this->db->update('doctor_department_info',$department);
		$user_id = $this->session->userdata('log_id');
		$action_title = 'Update Doctor Department';
		$action_description = 'User edit doctor department';
		$add_date = date('Y-m-d h:i:s');
		$sql_int = "insert into user_action_log (user_id,action_title,action_description,add_date) values ('$user_id','$action_title','$action_description','$add_date')";
		$this->db->query($sql_int);
		$this->session->set_flashdata('message','<div class="alert alert-success msg">Department updated Successful.</div><br>');
		redirect('admin/Department_controller/department_list');

	}
	
#--------------------------------
#      delete company	
#--------------------------------
	public function delete_doctor_department($id=NULL)
	{
		$this->db->where('department_id',$id)
		->delete('doctor_department_info');
		$user_id = $this->session->userdata('log_id');
		$action_title = 'Delete Doctor Department';
		$action_description = 'User delete doctor department';
		$add_date = date('Y-m-d h:i:s');
		$sql_int = "insert into user_action_log (user_id,action_title,action_description,add_date) values ('$user_id','$action_title','$action_description','$add_date')";
		$this->db->query($sql_int);
		$this->session->set_flashdata('exception','<div class="alert alert-success msg">'.display('delete_msg').'</div><br>');
		redirect('admin/Department_controller/department_list');
	}

#--------------------------------
#      View Medicine list	
#--------------------------------
public function medicine_List()
{
	$data['title'] = "Medicine List";
	$data['medicine'] = $this->setup_model->getMedicineList();
    $this->load->view('admin/_header',$data);
    $this->load->view('admin/_left_sideber');
    $this->load->view('admin/setup/view_medicine_list');
    $this->load->view('admin/_footer');
}

#--------------------------------
#      inset advice form	
#--------------------------------	
public function advice()
{
	$data['advice'] = $this->db->select('*')
	->from('doctor_advice')
	->get()
	->result();
	
	$this->load->view('admin/_header',$data);
    $this->load->view('admin/_left_sideber');
    $this->load->view('admin/setup/view_add_advice');
    $this->load->view('admin/_footer');
}

#--------------------------------
#     save advice 
#--------------------------------	
	public function save_advices()
	{
		$advice['create_by'] = 1;
		$advice['advice'] = $this->input->post('advice',TRUE); 
		$this->db->insert('doctor_advice',$advice);
		$this->session->set_flashdata('message','<div class="alert alert-success msg">'.display('advice_add_msg').'</div>');
	 	redirect('admin/Setup_controller/advice');
	}

#--------------------------------
#      delete advice 	
#--------------------------------	
	public function delete_advice($id){
		$this->db->where('advice_id',$id
			)->delete('doctor_advice');
		$this->session->set_flashdata('message','<div class="alert alert-success msg">'.display('delete_msg').'</div>');
	 	redirect('admin/Setup_controller/advice');
	}

#--------------------------------
#      Delete_Medicine	
#--------------------------------
	public function delete_medicine($id=NULL)
	{
		$this->db->where('medicine_id',$id)->delete('medecine_info');
		$this->session->set_flashdata('exception','<div class="alert alert-danger msg">'.display('delete_msg').'</div><br>');
		redirect('Medicine_List');
	}

#--------------------------------
#      Edit_Medicine view form	
#--------------------------------
	public function edit_medicine($id=NULL)
	{
		$data['medicine'] = $this->setup_model->getMedicineOne($id);
        $this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/setup/view_medicine_edit');
        $this->load->view('admin/_footer');
	}

#--------------------------------
#      Save_Edit_Medicine	
#--------------------------------
	public function save_edit_medicine()
	{
		$medicine = array(
			'medicine_name' => $this->input->post('medicine_name',TRUE),
			'med_company_id' => $this->input->post('company_id',TRUE),
			'med_group_id' => $this->input->post('group_id',TRUE),
			'med_description' => $this->input->post('description',TRUE)
		);
		$id = $this->input->post('id',TRUE);

		$this->db->where('medicine_id',$id);
		$this->db->update('medecine_info',$medicine);
		$this->session->set_flashdata('message','<div class="alert alert-success msg">'.display('update_msg').'</div><br>');
		redirect('admin/Setup_controller/medicine_List');
	}

#--------------------------------
#      insert medicine group	
#--------------------------------
	public function add_medicine_group()
	{
		$data['group_info'] = $this->setup_model->getGroupInfo();        
        $this->load->view('admin/_header',$data);
        $this->load->view('admin/_left_sideber');
        $this->load->view('admin/setup/view_add_medicine_group');
        $this->load->view('admin/_footer');
	}

#--------------------------------
#      Save_Group	
#--------------------------------
	public function save_medicine_group()
	{

		$g_name = $this->input->post('group_name',TRUE);
		$query = $this->db->select('*')
 	 			->from('medicine_group_tbl')
 	 			->where('group_name',$g_name)
 	 			->get()
 	 			->row();

		if( ! empty($query)) {
			$this->session->set_flashdata('message','<div class="alert alert-danger msg">'.display('exist_error_msg').'</div><br>');
			redirect('admin/Setup_controller/add_medicine_group');
		} else {
		$group['group_name'] = $this->input->post('group_name',TRUE);
		$this->db->insert('medicine_group_tbl',$group);
		$this->session->set_flashdata('message','<div class="alert alert-success msg">Add Successful</div><br>');
		redirect('admin/Setup_controller/add_medicine_group');
		}
	}

#--------------------------------
#      Delete group	
#--------------------------------	
	public function delete_group($id)
	{
		$this->db->where('med_group_id',$id)
		->delete('medicine_group_tbl');

		$this->session->set_flashdata('exception','<div class="alert alert-success msg">'.display('delete_msg').'</div><br>');
		redirect('admin/Setup_controller/add_medicine_group');
	}

}		