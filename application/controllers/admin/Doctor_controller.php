<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_controller extends CI_Controller {
  
  /*
  |--------------------------------------
  |  Construction function 
  |--------------------------------------
  */
	public function __construct() 
	{
		parent::__construct();
		$this->load->library('session');
		   $session_id = $this->session->userdata('session_id'); 
	    if($session_id == NULL ) {
	       redirect('logout');
	    }
	  $this->load->model('admin/Doctor_model','doctor_model');
	}

  /*
  |--------------------------------------
  | Profile
  |--------------------------------------
  */
	public function profile()
	{

        $doctor_id = $this->session->userdata('doctor_id');
        
        $data['title'] = "Profile";
		$data['doctor_info'] = $this->doctor_model->get_doctor_info($doctor_id);
		$data['depart_info'] = $this->doctor_model->getDoctorDepartmentInfo();
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/profile_setup');
		$this->load->view('admin/_footer');
	}
  /*
  |--------------------------------------
  | update_profile
  |--------------------------------------
  */ 

	public function edit_profile($doctor_id)
	{
		//echo $doctor_id;die();
        $data['title'] = "Profile";
		$data['doctor_info'] = $this->doctor_model->get_doctor_info2($doctor_id);
		$data['depart_info'] = $this->doctor_model->getDoctorDepartmentInfo();
		//echo "<pre>";print_r($data['doctor_info']);die();
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/doctor/update_doctor');
		$this->load->view('admin/_footer');
	}
	

	public function update_profile()
	{
		//$this->form_validation->set_rules('fees','Fees','trim|required');
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('phone','Phone','trim|required');
		$this->form_validation->set_rules('registration_number','Registration number','trim|required');
        $this->form_validation->set_rules('about_me','About me','trim|required');

        $doctor_id = $this->input->post('doctor_id',TRUE);
		
		if($this->form_validation->run()==true) {
			    # get picture data
              if (@$_FILES['picture']['name']) {
                $config['upload_path']   = './assets/uploads/doctor/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['overwrite']     = false;
                $config['max_size']      = 1024;
                $config['remove_spaces'] = true;
                $config['max_filename']   = 10;
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('picture'))
                {
                   $this->session->set_flashdata('execption', $this->upload->display_errors());
                   redirect('profile');
                } else {
                
                 $data = $this->upload->data();
                 $image = base_url($config['upload_path'].$data['file_name']);
                  #------------resize image------------#
                  $this->load->library('image_lib');
                  $config['image_library'] = 'gd2';
                  $config['source_image'] = $config['upload_path'].$data['file_name'];
                  $config['create_thumb'] = FALSE;
                  $config['maintain_ratio'] = FALSE;
                  $config['width']     = 250;
                  $config['height']   = 200;

                  $this->image_lib->clear();
                  $this->image_lib->initialize($config);
                  $this->image_lib->resize();
                  #-------------resize image----------#
                }

                } else {
                    $image = $this->input->post('image',TRUE);
                }

				if (@$_FILES['picture2']['name']) {
                $config['upload_path']   = './assets/uploads/doctor/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['overwrite']     = false;
                $config['max_size']      = 1024;
                $config['remove_spaces'] = true;
                $config['max_filename']   = 10;
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('picture2'))
                {
                   $this->session->set_flashdata('execption', $this->upload->display_errors());
                   redirect('profile');
                } else {
                
                 $data = $this->upload->data();
                 $image2 = base_url($config['upload_path'].$data['file_name']);
                  #------------resize image------------#
                  $this->load->library('image_lib');
                  $config['image_library'] = 'gd2';
                  $config['source_image'] = $config['upload_path'].$data['file_name'];
                  $config['create_thumb'] = FALSE;
                  $config['maintain_ratio'] = FALSE;
                  $config['width']     = 250;
                  $config['height']   = 200;

                  $this->image_lib->clear();
                  $this->image_lib->initialize($config);
                  $this->image_lib->resize();
                  #-------------resize image----------#
                }

                } else {
                    $image2 = $this->input->post('image2',TRUE);
                }				

				

				$savedata =  array(
					'doctor_name' => $this->input->post('name',TRUE),
					'department' => $this->input->post('department',TRUE),
					'designation' => $this->input->post('designation',TRUE),
					'degrees' => $this->input->post('degree',TRUE), 
					'degrees' => $this->input->post('degree',TRUE), 
					'doc_id' => $this->input->post('registration_number',TRUE),
					'doctor_exp' => $this->input->post('doctor_exp',TRUE),
					'birth_date' => $this->input->post('birth_date',TRUE),
					'sex' => $this->input->post('gender',TRUE),
					'blood_group' => $this->input->post('blood_group',TRUE),
					'doctor_phone' => $this->input->post('phone',TRUE),
					'address' => $this->input->post('address',TRUE),
					'language' => $this->input->post('language',TRUE),
					'meet_url' => $this->input->post('meet_url',TRUE),
					'about_me' => $this->input->post('about_me',TRUE),
					'service_place' => $this->input->post('service_place',TRUE),
					'picture' => $image,
					'picture2' => $image2
				);
               


              $this->doctor_model->save_edit_dcotor_profile($savedata, $doctor_id);

              $this->session->set_flashdata('message','<div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>'.display('update_msg').'</strong> .
              </div>');
			  if($doctor_id==1){
					redirect('profile');
			  }else{
				  redirect('profile');
			  }
               

			} else {
				
				$data['doctor_info'] = $this->doctor_model->get_doctor_info($doctor_id);
				$data['depart_info'] = $this->doctor_model->getDoctorDepartmentInfo();
				$this->load->view('admin/_header',$data);
				$this->load->view('admin/_left_sideber');
				$this->load->view('admin/profile_setup');
				$this->load->view('admin/_footer');

			}
	}
	
	public function update_profile_doc()
	{
		//$this->form_validation->set_rules('fees','Fees','trim|required');
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('phone','Phone','trim|required');
		$this->form_validation->set_rules('about_me','About me','trim|required');

        $doctor_id = $this->input->post('doctor_id',TRUE);
		
		if($this->form_validation->run()==true) {
			    # get picture data
              if (@$_FILES['picture']['name']) {
                $config['upload_path']   = './assets/uploads/doctor/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['overwrite']     = false;
                $config['max_size']      = 1024;
                $config['remove_spaces'] = true;
                $config['max_filename']   = 10;
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('picture'))
                {
                   $this->session->set_flashdata('execption', $this->upload->display_errors());
                   redirect('profile');
                } else {
                
                 $data = $this->upload->data();
                 $image = base_url($config['upload_path'].$data['file_name']);
                  #------------resize image------------#
                  $this->load->library('image_lib');
                  $config['image_library'] = 'gd2';
                  $config['source_image'] = $config['upload_path'].$data['file_name'];
                  $config['create_thumb'] = FALSE;
                  $config['maintain_ratio'] = FALSE;
                  $config['width']     = 250;
                  $config['height']   = 200;

                  $this->image_lib->clear();
                  $this->image_lib->initialize($config);
                  $this->image_lib->resize();
                  #-------------resize image----------#
                }

                } else {
                    $image = $this->input->post('image',TRUE);
                }

				if (@$_FILES['picture2']['name']) {
                $config['upload_path']   = './assets/uploads/doctor/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['overwrite']     = false;
                $config['max_size']      = 1024;
                $config['remove_spaces'] = true;
                $config['max_filename']   = 10;
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('picture2'))
                {
                   $this->session->set_flashdata('execption', $this->upload->display_errors());
                   redirect('profile');
                } else {
                
                 $data = $this->upload->data();
                 $image2 = base_url($config['upload_path'].$data['file_name']);
                  #------------resize image------------#
                  $this->load->library('image_lib');
                  $config['image_library'] = 'gd2';
                  $config['source_image'] = $config['upload_path'].$data['file_name'];
                  $config['create_thumb'] = FALSE;
                  $config['maintain_ratio'] = FALSE;
                  $config['width']     = 250;
                  $config['height']   = 200;

                  $this->image_lib->clear();
                  $this->image_lib->initialize($config);
                  $this->image_lib->resize();
                  #-------------resize image----------#
                }

                } else {
                    $image2 = $this->input->post('image2',TRUE);
                }				

				

				$savedata =  array(
					'fees' => '200',
					'doctor_name' => $this->input->post('name',TRUE),
					'department' => $this->input->post('department',TRUE),
					'designation' => $this->input->post('designation',TRUE),
					'degrees' => $this->input->post('degree',TRUE), 
					'degrees' => $this->input->post('degree',TRUE), 
					'doc_id' => $this->input->post('registration_number',TRUE),
					'doctor_exp' => $this->input->post('doctor_exp',TRUE),
					'birth_date' => $this->input->post('birth_date',TRUE),
					'sex' => $this->input->post('gender',TRUE),
					'blood_group' => $this->input->post('blood_group',TRUE),
					'doctor_phone' => $this->input->post('phone',TRUE),
					'address' => $this->input->post('address',TRUE),
					'language' => $this->input->post('language',TRUE),
					'meet_url' => $this->input->post('meet_url',TRUE),
					'about_me' => $this->input->post('about_me',TRUE),
					'service_place' => $this->input->post('service_place',TRUE),
					'picture' => $image,
					'picture2' => $image2
				);
               


              $this->doctor_model->save_edit_dcotor_profile($savedata, $doctor_id);

              $this->session->set_flashdata('message','<div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>'.display('update_msg').'</strong> .
              </div>');
			  if($doctor_id==1){
					redirect('profile');
			  }else{
				  redirect('admin/Doctor_controller/doctor_list');
			  }
               

			} else {
				
				$data['doctor_info'] = $this->doctor_model->get_doctor_info($doctor_id);
				$data['depart_info'] = $this->doctor_model->getDoctorDepartmentInfo();
				$this->load->view('admin/_header',$data);
				$this->load->view('admin/_left_sideber');
				$this->load->view('admin/profile_setup');
				$this->load->view('admin/_footer');

			}
	}
	
	public function create_new_doctor(){

		$data['title'] = "Doctor List";

		$data['depart_info'] = $this->doctor_model->getDoctorDepartmentInfo();

		$this->load->view('admin/_header',$data);

		$this->load->view('admin/_left_sideber');

		$this->load->view('admin/doctor/create_new_doctor');

		$this->load->view('admin/_footer');

	}			
	
	public function doctor_list(){	

		$data['title'] = "Doctor List";	

		$data['doc_list'] = $this->doctor_model->getDoctorList();
		
		//echo "<pre>";print_r($data['doc_list']);die();

		$this->load->view('admin/_header',$data);

		$this->load->view('admin/_left_sideber');

		$this->load->view('admin/doctor/view_doctor_list');	

		$this->load->view('admin/_footer');	

	}		
	
	public function add_new_doctor(){

		//$this->form_validation->set_rules('fees', 'Fees', 'trim|required|xss_clean');
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');

		$this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|min_length[9]|max_length[15]');

		$this->form_validation->set_rules('email', 'Email', 'valid_email|is_unique[log_info.email]');

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		
		if ($this->form_validation->run()==true) {	

		$log_data = array(
		'email' => $this->input->post('email',TRUE),
		'password' => MD5($this->input->post('password',TRUE)),
		'user_type' => '1'
		);					

		if (@$_FILES['picture']['name']) {
                $config['upload_path']   = './assets/uploads/doctor/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['overwrite']     = false;
                $config['max_size']      = 1024;
                $config['remove_spaces'] = true;
                $config['max_filename']   = 10;
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('picture'))
                {
                   $this->session->set_flashdata('execption', $this->upload->display_errors());
                   redirect('profile');
                } else {
                
                 $data = $this->upload->data();
                 $image = base_url($config['upload_path'].$data['file_name']);
                  #------------resize image------------#
                  $this->load->library('image_lib');
                  $config['image_library'] = 'gd2';
                  $config['source_image'] = $config['upload_path'].$data['file_name'];
                  $config['create_thumb'] = FALSE;
                  $config['maintain_ratio'] = FALSE;
                  $config['width']     = 250;
                  $config['height']   = 200;

                  $this->image_lib->clear();
                  $this->image_lib->initialize($config);
                  $this->image_lib->resize();
                  #-------------resize image----------#
                }

		} else {
				$image = $this->input->post('image',TRUE);
		}

		if (@$_FILES['picture2']['name']) {
                $config['upload_path']   = './assets/uploads/doctor/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['overwrite']     = false;
                $config['max_size']      = 1024;
                $config['remove_spaces'] = true;
                $config['max_filename']   = 10;
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('picture2'))
                {
                   $this->session->set_flashdata('execption', $this->upload->display_errors());
                   redirect('profile');
                } else {
                
                 $data = $this->upload->data();
                 $image2 = base_url($config['upload_path'].$data['file_name']);
                  #------------resize image------------#
                  $this->load->library('image_lib');
                  $config['image_library'] = 'gd2';
                  $config['source_image'] = $config['upload_path'].$data['file_name'];
                  $config['create_thumb'] = FALSE;
                  $config['maintain_ratio'] = FALSE;
                  $config['width']     = 250;
                  $config['height']   = 200;

                  $this->image_lib->clear();
                  $this->image_lib->initialize($config);
                  $this->image_lib->resize();
                  #-------------resize image----------#
                }

		} else {
				$image2 = $this->input->post('image2',TRUE);
		}	

		$exists_user = $this->doctor_model->exists_doctor(	
		$this->input->post('phone',true),
		date('Y-m-d',strtotime($this->input->post('birth_date',true)))
		); 		

		if($exists_user == true){	

		$this->session->set_flashdata('exception','<div class="alert alert-danger">'.$this->input->post('name',TRUE) .display('exist_error_msg').'</div>');  

		redirect('admin/Doctor_controller/create_new_doctor');

		}								

		// insert login info			

		$this->db->insert('log_info', $log_data);	

		// get last insert id			

		$log_id = $this->db->insert_id();	

		$create_date = date('Y-m-d h:i:s');	

		$birth_date = date('Y-m-d',strtotime($this->input->post('birth_date',TRUE)));	

		$savedata =  array(
		
		'log_id' => $log_id,
		
		'doctor_name' => $this->input->post('name',TRUE),
		
		'fees' => '200',
		
		'department' => $this->input->post('department',TRUE),
		
		'designation' => $this->input->post('designation',TRUE),
		
		'degrees' => $this->input->post('degree',TRUE),
		
		'specialist' => $this->input->post('specialist',TRUE),
		
		'doctor_exp' => $this->input->post('doctor_exp',TRUE),
		
		'birth_date' => $birth_date,
		
		'sex' => $this->input->post('gender',TRUE),
		
		'blood_group' => $this->input->post('blood_group',TRUE),
		
		'doctor_phone' => $this->input->post('phone',TRUE),
		
		'address' => $this->input->post('address',TRUE),
		
		'language' => $this->input->post('language',TRUE),
		
		'meet_url' => $this->input->post('meet_url',TRUE),
		
		'about_me' => $this->input->post('about_me',TRUE),
		
		'doc_id' => $this->input->post('registration_number',TRUE),
		
		'service_place' => $this->input->post('service_place',TRUE),
		
		'picture' => $image,
		
		'picture2' => $image2
		
		);		

		$this->db->insert('doctor_tbl', $savedata);	
		
		$doc_id = $this->db->insert_id();
		
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		
		for ($i = 0; $i < 8; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		$savedociddata=array(
			'doc_id' => $randomString
		);
		//echo "<pre>";print_r($savedociddata);die();
		
		//$this->doctor_model->save_edit_dcotor_profile($savedociddata, $doc_id);
		
		$this->session->set_flashdata('message',"<div class='alert alert-success msg'>".$this->input->post('name',TRUE) .', '. display('register_msg')."</div>");
        
		redirect('admin/Doctor_controller/doctor_list');
		

		} else {    

        $data['title'] = "Create New Doctor";   

		$this->load->view('admin/_header',$data);
		$data['depart_info'] = $this->doctor_model->getDoctorDepartmentInfo();
		$this->load->view('admin/_left_sideber');

		$this->load->view('admin/doctor/create_new_doctor',$data);  

        $this->load->view('admin/_footer');  

    	}			

	}
	
	public function delete_doctor($log_id)
	  {
		  $this->db->where('log_id',$log_id);
		  $this->db->delete('doctor_tbl');

		  $this->db->where('log_id',$log_id);
		  $this->db->delete('log_info');
		  $this->session->set_flashdata('message',"<div class='alert alert-success msg'>".display('delete_msg')."</div>");
		  redirect('admin/Doctor_controller/doctor_list');
	  }


}