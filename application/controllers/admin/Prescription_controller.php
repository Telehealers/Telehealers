<?php 
defined('BASEPATH') OR exit('No direct script access allowed');



//include '/home/telehea2/telehealers.in/pdf/2/examples/tcpdf_include.php';

class Prescription_controller extends CI_Controller {

#-----------------------------------------------
#    prescription_list
#----------------------------------------------
	public function __construct() 
	{
		parent::__construct();
	    $this->load->library('session');
		$log_id = $this->session->userdata('log_id');	
		$session_id = $this->session->userdata('session_id');	
		$this->load->library('Pdf');
	    
	   	if($session_id == NULL ) {
	     redirect('logout');
	    }

        $this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('admin/Patient_model','patient_model');
        $this->load->model('admin/Prescription_model','prescription_model');
	 	$this->load->model('admin/Venue_model','venue_model');
	 	$this->load->model('admin/Overview_model','overview_model');
	 	$this->load->model('admin/Represcription','represcription');
		$this->load->model('admin/Doctor_model','doctor_model');
	 	
	 	$result = $this->db->select('*')->from('web_pages_tbl')->where('name','timezone')->get()->row();
		
		date_default_timezone_set(@$result->details);
		
		$this->load->model('admin/email/Email_model','email_model');
        $this->load->library('email');
		
	}


#-----------------------------------------------
#    prescription_list
#---------------------------------------------- 
	public function prescription_list()
	{
		$user_type = $this->session->userdata('user_type');
		if($user_type==1){
			$user_id = $this->session->userdata('doctor_id');	
			if($user_id == 1){
				$data['Prescription'] = $this->prescription_model->prescription_list();
			}else{
				$data['Prescription'] = $this->prescription_model->prescription_list_doc_id($user_id);
			}
		}
		if($user_type==2){		
			$data['Prescription'] = $this->prescription_model->prescription_list();
		}
	 	
	 	$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/view_prescription_list');
		$this->load->view('admin/_footer');
	 
	}


#-----------------------------------------------
#    prescription_list
#---------------------------------------------- 
	public function today_prescription_list()
	{
		$data['title'] = "Today Prescription List";
	 	$data['Prescription'] = $this->overview_model->today_prescription();
	 	$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/view_today_prescription_list');
		$this->load->view('admin/_footer');	 
	}

#-----------------------------------------
#			create new prescription 
#-----------------------------------------
	public function create_prescription($appointment_id = NULL)
	{
		$data['title'] = "Create Prescription";
		$data['patient_info'] = $this->prescription_model->patient_info($appointment_id);
		$data['doctor_info']=NULL;
	 	$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/create_prescription');
		$this->load->view('admin/_footer'); 	
	}

#-----------------------------------------
#       Save Prescription
#-----------------------------------------	
	public function save_prescription()
	{
		$info = $this->db->where('name','timezone')->get('web_pages_tbl')->row();
          
        date_default_timezone_set(@$info->details);

	 	$this->session->unset_userdata('appointment_id');
	 	$this->session->unset_userdata('prescription_id'); 	
	 	$appointment_id=$this->input->post('appointment_id',TRUE)?$this->input->post('appointment_id',TRUE): "A".date('y').strtoupper($this->randstrGen(2,4));
	 	$pdata['patient_id'] = $this->input->post('patient_id',TRUE);
	 	$pdata['appointment_id'] = $appointment_id;
	 	$pdata['doctor_id'] = $this->session->userdata('doctor_id',TRUE);
	 	$pdata['Pressure'] = $this->input->post('Pressure',TRUE);
	 	$pdata['Weight'] = $this->input->post('Weight',TRUE);
	 	$pdata['problem'] = $this->input->post('Problem',TRUE);
	 	$pdata['venue_id'] = $this->input->post('venue_id',TRUE);
	 	$pdata['oex'] = $this->input->post('oex',TRUE);
		$pdata['pd'] = $this->input->post('pd',TRUE);
		$pdata['history'] = $this->input->post('history',TRUE);
		$pdata['temperature'] = $this->input->post('temperature',TRUE);
		$pdata['prescription_type'] = 1;
	 	$pdata['pres_comments'] = $this->input->post('prescription_comment',TRUE);
		if($this->input->post('create_date',TRUE)==""){
			$pdata['create_date_time'] = date("Y-m-d H:i:s");
		}else{
			$pdata['create_date_time'] = $this->input->post('create_date',TRUE);	
		}
	 	

	 	$this->db->insert('prescription',$pdata);
	    // get last insert id
	    $prescription_id = $this->db->insert_id();
		
		
		
	#----------------------------------------------------#
			 	# medicine assign for patient 
	#----------------------------------------------------#    
	 	$mdata['medicine_id'] = ($this->input->post('medicine_id',TRUE));
	 	$mdata['comments'] = ($this->input->post('comments',TRUE));
	 	$mdata['appointment_id'] = $appointment_id;
	 	$mdata['prescription_id'] = $prescription_id;


			for($i=0; $i<count($mdata['medicine_id']); $i++) {

			 	if(empty($mdata['medicine_id'][$i])) {

			 		$md_name['medicine_name'] = $this->input->post('md_name',TRUE);
				 	$create_by = $this->session->userdata('doctor_id');
				 	$med_description = 'doctor description';

				 	# chack the medicine name in the medicine_info table 
				 	$query = $this->db->select('*')
	 	 			->from('medecine_info')
	 	 			->where('medicine_name',$md_name['medicine_name'][$i])
	 	 			->get()
	 	 			->row();

	 	 			if(!empty($query)) {
						$mdata['med_id'] = $query->medicine_id;
					} else {
						$medicine = array(
						'medicine_name' => $md_name['medicine_name'][$i],
						'med_company_id' => '01',
						'med_group_id' => '01',
						'med_description' => $med_description
					);
					# insert medicine id in medicine_info table
					$this->db->insert('medecine_info',$medicine);
					# medicine id
					$mdata['med_id'] = $this->db->insert_id();
					}
			 	} else {
			 		$mdata['med_id'] = $mdata['medicine_id'][$i];
			 	}

	            $data = array(
	                    'prescription_id'=> $mdata['prescription_id'],
	                    'appointment_id'=> $mdata['appointment_id'],
	                    'medicine_id'=> $mdata['med_id'],
	                    'medicine_com'=>$mdata['comments'][$i]
	            );

	            $this->db->insert('medicine_prescription', $data);
	        }
	#----------------------------------------------------#
			 	# test assign for patient
	#----------------------------------------------------#		 	
		 	$tdata['prescription_id'] = $prescription_id;
		 	$tdata['test_id'] = ($this->input->post('test_name',TRUE));
		 	$tdata['test_description'] = ($this->input->post('test_description',TRUE));
		 	$tdata['appointment_id'] = $appointment_id;
			$test_name = $this->input->post('test_name',TRUE);
			$te_name    = $this->input->post('te_name',TRUE);

		if((is_array($test_name) && sizeof($test_name) > 0 && !empty($test_name[0])) || (sizeof($te_name) > 0 && !empty($te_name[0]))){	 	
		 	
		 	for($i=0; $i<count($tdata['test_id']); $i++) {

	            if(empty($tdata['test_id'][$i])) {
			 		$test_name['test_name'] = $this->input->post('te_name',TRUE);
				 	$test_description = 'doctor';
				 	# chack the test name in the test_info table 
				 		$query = $this->db->select('*')
				 	 			->from('test_name_tbl')
				 	 			->where('test_name',$test_name['test_name'][$i])
				 	 			->get()
				 	 			->row();
						if(!empty($query)) {
							$tdata['t_id'] = $query->test_id;
						} else {
							$tesAdd = array(
								'test_name' => $test_name['test_name'][$i],
								'test_description' => $test_description
								 );

							$this->db->insert('test_name_tbl', $tesAdd);
							$tdata['t_id'] = $this->db->insert_id();
						}

					
			 	} else {
			 		$tdata['t_id'] = $tdata['test_id'][$i];
			 	}

	            $data = array(
	        		'prescription_id' => $tdata['prescription_id'],
	        		'appointment_id' => $tdata['appointment_id'],
	                'test_id'=> $tdata['t_id'],
	                'test_assign_description'=>$tdata['test_description'][$i]
	            );

	        	$this->db->insert('test_assign_for_patine', $data);
			}
		}


#---------------------------------------------------
#			advice assign for patient
#---------------------------------------------------
		$a_data['appointment_id'] = $appointment_id;
		$a_data['prescription_id'] = $prescription_id;
	 	$a_data['advice'] = ($this->input->post('advice',TRUE))?($this->input->post('advice',TRUE)):[];
 		$num_advice = $this->input->post('advice',TRUE)?$this->input->post('advice',TRUE):[];
	 	$num_adv    = $this->input->post('adv',TRUE)?$this->input->post('adv',TRUE):[];
		 if((sizeof($num_advice) > 0 && !empty($num_advice[0])) || (sizeof($num_adv) > 0 && !empty($num_adv[0]))){
			for($i=0; $i<=count($a_data['advice']); $i++) {
				if(empty($a_data['advice'][$i])) {
			 		$adv_name['advice'] = $this->input->post('adv',TRUE);
					$adv = array(
						'advice' => $adv_name['advice'][$i],
						'create_by' => $this->session->userdata('doctor_id',TRUE)
						);
					$this->db->insert('doctor_advice', $adv);
					$ad_data['advice'] = $this->db->insert_id();
			 	} else {
			 		$ad_data['advice'] = $a_data['advice'][$i];
			 	}

				$advice_data = array(
            		'appointment_id' => $a_data['appointment_id'],
            		'prescription_id'=> $a_data['prescription_id'],
            		'advice_id' => $ad_data['advice']
            	);
            	$this->db->insert('advice_prescriptiion',$advice_data);
			}
		}
		
		$d['appointment_id'] = $appointment_id;	
		$base_url=base_url();
    	$this->session->set_userdata($d);
		$this->session->set_flashdata('message','<div class="alert alert-success msg">Prescription has been add successfully.
			<a href="'.$base_url.'admin/Prescription_controller/my_prescription/'.$prescription_id.'" target="_blank" style="  text-decoration: underline;  color: white;">Click here</a> to view the prescription</div>');

	 	redirect("admin/Prescription_controller/prescription_list");
		
		//redirect("prescription");
	}		 


#------------------------------------------------
#		create new prescription view form
#------------------------------------------------		 
	public function  create_new_prescription()
	{
		$data['title'] = "Create New Prescription ";
		$data['venue'] = $this->venue_model->get_venue_list();
		
		//$data['doctor_info'] = $this->doctor_model->getDoctorListByselect();
		
		$user_type = $this->session->userdata('user_type');
		if($user_type==1){
			$doctor_id = $this->session->userdata('doctor_id');
			if($doctor_id!="1"){
				$data['doctor_info'] = $this->doctor_model->getDoctorListById($doctor_id);	
				$data['patient_info'] = $this->patient_model->get_by_id_patient($doctor_id);
			}else{
				$data['doctor_info'] = $this->doctor_model->getDoctorListByselect();
				$data['patient_info'] = $this->patient_model->get_all_patient();
			}
			
		}else{
			$data['doctor_info'] = $this->doctor_model->getDoctorListByselect();
			$data['patient_info'] = $this->patient_model->get_all_patient();
		}
		
		
	 	$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/create_prescription');
		$this->load->view('admin/_footer');
	}


#-----------------------------------------------
#    random coad genaretor of appointmaent id
#----------------------------------------------    

	function randstrGen($mode=null,$len=null)
	{
	    $result = "";
	    if($mode == 1):
	        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	    elseif($mode == 2):
	        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	    elseif($mode == 3):
	        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
	    elseif($mode == 4):
	        $chars = "0123456789";
	    endif;

	    $charArray = str_split($chars);
	    for($i = 0; $i < $len; $i++) {
            $randItem = array_rand($charArray);
            $result .="".$charArray[$randItem];
	    }
	    return $result;
	}

#-----------------------------------------
#	add new  prescription without ap id
#----------------------------------------	
	public function new_prescriptions_f()
	{

		$info = $this->db->where('name','timezone')->get('web_pages_tbl')->row();
          
        date_default_timezone_set(@$info->details);

		if(empty($this->input->post('patient_id',TRUE))) {
		 	$patient_id =  $this->input->post('p_id',TRUE);
		    $p_data['patient_id']=   $patient_id;
		 	$p_data['patient_name']= $this->input->post('name',TRUE);
		 	$p_data['patient_phone']= $this->input->post('phone',TRUE);
		 	$p_data['birth_date']=   $this->input->post('birth_date',TRUE);
		 	$p_data['sex']=          $this->input->post('gender',TRUE);
		 	$this->db->insert('patient_tbl',$p_data);
			$action_link = $this->db->insert_id();
			$user_id = $this->session->userdata('log_id');
			$action_title = 'Add Patient during add prescriptions';
			$action_description = 'User add Patient during add prescriptions';
			$add_date = date('Y-m-d h:i:s');
			$sql_int = "insert into user_action_log (user_id,action_title,action_description,action_link,add_date) values ('$user_id','$action_title','$action_description','$action_link','$add_date')";
			$this->db->query($sql_int);
		} else {
			 	$patient_id = $this->input->post('patient_id',TRUE);
			}
			 	if(empty($this->input->post('appointment_id',TRUE))) {
			 		$pdata['appointment_id'] = "A".date('y').strtoupper($this->randstrGen(2,4));
			 	} else {
			 		$pdata['appointment_id'] = $this->input->post('appointment_id',TRUE);
			 	}

			 	$pdata['patient_id'] = $patient_id;
			 	$pdata['appointment_id'] =$pdata['appointment_id'];
			 	$pdata['doctor_id'] = $this->input->post('doctor',TRUE);
			 	$pdata['Pressure'] = $this->input->post('Pressure',TRUE);
			 	$pdata['Weight'] = $this->input->post('Weight',TRUE);
			 	$pdata['problem'] = $this->input->post('Problem',TRUE);
			 	$pdata['venue_id'] = $this->input->post('venue_id',TRUE);
			 	$pdata['oex'] = $this->input->post('oex',TRUE);
				$pdata['pd'] = $this->input->post('pd',TRUE);
				$pdata['history'] = $this->input->post('history',TRUE);
				$pdata['temperature'] = $this->input->post('temperature',TRUE);
			 	$pdata['prescription_type'] = 1;
			 	$pdata['pres_comments'] = $this->input->post('prescription_comment',TRUE);
			 	$pdata['create_date_time'] = date("Y-m-d H:i:s");

			 	$this->session->unset_userdata('v_id');
	            $session_venu = array('v_id' => $this->input->post('venue_id',TRUE));
		 		$this->session->set_userdata($session_venu);

			 	$this->db->insert('prescription',$pdata);
				# get last insert id
	            $p = $this->db->insert_id();
	            
				$action_link = $p;
				$user_id = $this->session->userdata('log_id');
				$action_title = 'Add Prescriptiion ('.$pdata['appointment_id'].')';
				$action_description = 'User add Prescriptiion';
				$add_date = date('Y-m-d h:i:s');
				$sql_int = "insert into user_action_log (user_id,action_title,action_description,action_link,add_date) values ('$user_id','$action_title','$action_description','$action_link','$add_date')";
				$this->db->query($sql_int);
				
	            $mdata['med_type'] = $this->input->post('type',TRUE);
			 	$mdata['medicine_id'] = ($this->input->post('medicine_id',TRUE));
			 	$mdata['mg'] = ($this->input->post('mg',TRUE));
			 	$mdata['dose'] = ($this->input->post('dose',TRUE));
			 	$mdata['day'] = ($this->input->post('day',TRUE));
			 	$mdata['comments'] = ($this->input->post('comments',TRUE));
			 	$mdata['appointment_id'] = $pdata['appointment_id'];
			 	$mdata['prescription_id'] = $p;


			for($i=0; $i<count($mdata['medicine_id']); $i++) {
			 	
			 	if(empty($mdata['medicine_id'][$i])) {
			 		$md_name['medicine_name'] = $this->input->post('md_name',TRUE);
				 	$create_by = $this->session->userdata('doctor_id',TRUE);
				 	$med_description = 'doctor';

				 	# chack the medicine name in the medicine_info table 
				 	$query = $this->db->select('*')
	 	 			->from('medecine_info')
	 	 			->where('medicine_name',$md_name['medicine_name'][$i])
	 	 			->get()
	 	 			->row();
	 	 			if( ! empty($query)) {
						$mdata['med_id'] = $query->medicine_id;
					} else {
						$medicine = array(
						'medicine_name' => $md_name['medicine_name'][$i],
						'med_company_id' => '01',
						'med_group_id' => '01',
						'med_description' => $med_description
					);
					# insert medicine id in medicine_info table
					$this->db->insert('medecine_info',$medicine);
					# medicine id
					$mdata['med_id'] = $this->db->insert_id();
					}

			 	} else {
			 		$mdata['med_id'] = $mdata['medicine_id'][$i];
			 	}

	            $data = array(
	                'prescription_id'=> $mdata['prescription_id'],
	                'appointment_id'=> $mdata['appointment_id'],
	                'medicine_id'=> $mdata['med_id'],
	                'mg'=>$mdata['mg'][$i],
	                'dose'=>$mdata['dose'][$i],
	                'day'=>$mdata['day'][$i],
	                'medicine_type' => $mdata['med_type'][$i],
	                'medicine_com'=>$mdata['comments'][$i]
	            );
				
	            $this->db->insert('medicine_prescription', $data);
				$action_link = $this->db->insert_id();
				$user_id = $this->session->userdata('log_id');
				$action_title = 'Add medicine ('.$mdata['appointment_id'].')';
				$action_description = 'User add medician Prescriptiion';
				$add_date = date('Y-m-d h:i:s');
				$sql_int = "insert into user_action_log (user_id,action_title,action_description,action_link,add_date) values ('$user_id','$action_title','$action_description','$action_link','$add_date')";
				$this->db->query($sql_int);
	            }

				#----------------------------------------------------
				#   test assign for patient
				#-----------------------------------------------------		 	
			 	$tdata['prescription_id'] = $p;
			 	$tdata['test_id'] = ($this->input->post('test_name',TRUE));
			 	$tdata['test_description'] = ($this->input->post('test_description',TRUE));
			 	$tdata['appointment_id'] = $pdata['appointment_id'];
			 
				$test_name = $this->input->post('test_name',TRUE);
			 	$te_name    = $this->input->post('te_name',TRUE);

		if((sizeof($test_name) > 0 && !empty($test_name[0])) || (sizeof($te_name) > 0 && !empty($te_name[0]))){	 	
		 	
			 	for($i=0; $i<count($tdata['test_id']); $i++) {

		            if(empty($tdata['test_id'][$i])) {
				 		$test_name['test_name'] = $this->input->post('te_name',TRUE);
					 	$test_description = 'doctor';
					 	# chack the test name in the test_info table 
					 		$query = $this->db->select('*')
					 	 			->from('test_name_tbl')
					 	 			->where('test_name',$test_name['test_name'][$i])
					 	 			->get()
					 	 			->row();
							if(!empty($query)) {
								$tdata['t_id'] = $query->test_id;
							} else {
								$tesAdd = array(
									'test_name' => $test_name['test_name'][$i],
									'test_description' => $test_description
									 );

								$this->db->insert('test_name_tbl', $tesAdd);
								$tdata['t_id'] = $this->db->insert_id();
							}
						
				 	} else {
				 		$tdata['t_id'] = $tdata['test_id'][$i];
				 	}

		            $data = array(
		        		'prescription_id' => $tdata['prescription_id'],
		        		'appointment_id' => $tdata['appointment_id'],
		                'test_id'=> $tdata['t_id'],
		                'test_assign_description'=>$tdata['test_description'][$i]
		            );
	            	$this->db->insert('test_assign_for_patine', $data);
				}
			}


	#---------------------------------------------------
	#	advice assign for patient
	#---------------------------------------------------
			$a_data['appointment_id'] = $pdata['appointment_id'];
			$a_data['prescription_id'] = $mdata['prescription_id'];
		 	$a_data['advice'] = ($this->input->post('advice',TRUE));
			$num_advice = $this->input->post('advice',TRUE);
		 	$num_adv    = $this->input->post('adv',TRUE);
		 if((sizeof($num_advice) > 0 && !empty($num_advice[0])) || (sizeof($num_adv) > 0 && !empty($num_adv[0]))){
			
				for($i=0; $i<count($a_data['advice']); $i++) {

					if(empty($a_data['advice'][$i])) {
						
				 		$adv_name['advice'] = $this->input->post('adv',TRUE);
						$adv = array(
							'advice' => $adv_name['advice'][$i],
							'create_by' => $this->input->post('doctor',TRUE)
							);
						$this->db->insert('doctor_advice', $adv);
						$ad_data['advice'] = $this->db->insert_id();
				 	} else {
				 		$ad_data['advice'] = $a_data['advice'][$i];
				 	}

					$advice_data = array(
	            		'appointment_id' => $a_data['appointment_id'],
	            		'prescription_id'=> $a_data['prescription_id'],
	            		'advice_id' => $ad_data['advice']
	            	);

	            $this->db->insert('advice_prescriptiion',$advice_data);
				$action_link = $this->db->insert_id();
				$user_id = $this->session->userdata('log_id');
				$action_title = 'Add Advice Prescriptiion ('.$a_data['appointment_id'].')';
				$action_description = 'User add Advice Prescriptiion';
				$add_date = date('Y-m-d h:i:s');
				$sql_int = "insert into user_action_log (user_id,action_title,action_description,action_link,add_date) values ('$user_id','$action_title','$action_description',$action_link,'$add_date')";
				$this->db->query($sql_int);
				}
			}
		 	$d['appointment_id'] = $pdata['appointment_id'];
		 	$d['prescription_id'] = $p;
        	$this->session->set_userdata($d);
		 	redirect("prescription");
	}

#-----------------------------------------
#		prescription search view
#-----------------------------------------		 
	public function search_prescription($search=NULL)
	{
	 	
	 	if(!empty($search)) {
		 	$appointment_id = $_GET['appointment_id']; 
		 	@$venue_id = $this->db->select('prescription_id,venue_id')->from('prescription')->where('appointment_id',$appointment_id)->get()->row();
	 		$prescription_id = $venue_id->prescription_id;

		 	 $data['patient_info'] = $this->prescription_model->prescription_by_id($prescription_id);
			    // test query
			     $data['t_info'] = $this->db->select('*')
			     ->from('test_assign_for_patine')
			     ->join('test_name_tbl', 'test_name_tbl.test_id = test_assign_for_patine.test_id')
			     ->where('test_assign_for_patine.prescription_id',$prescription_id)
			     ->get()
			     ->result();
			     
			    // advice query
			      $data['a_info'] = $this->db->select('advice_prescriptiion.*,doctor_advice.*')
			     ->from('advice_prescriptiion')
			     ->join('doctor_advice', 'doctor_advice.advice_id = advice_prescriptiion.advice_id')
			     ->where('advice_prescriptiion.prescription_id',$prescription_id)
			     ->get()
			     ->result();

			         //venue info
	          $data['venue_info'] = $this->db->select('prescription.venue_id,venue_tbl.*')
	         ->from('prescription')
	         ->join('venue_tbl', 'venue_tbl.venue_id = prescription.venue_id')
	         ->where('prescription.prescription_id',$prescription_id)
	         ->get()
	         ->row();

	 		@$venue_id = $this->db->select('prescription_id,venue_id')->from('prescription')->where('appointment_id',$appointment_id)->get()->row();
		
	     	$data['chember_time'] = $this->db->select('*')
	        ->from('schedul_setup_tbl')
	        ->where('venue_id', $venue_id->venue_id)
	        ->limit(1)
	        ->get()
	        ->row();

	        $data['pattern'] = $this->db->select('*')
			->from('print_pattern')
			->where('doctor_id',$this->session->userdata('doctor_id'))
			->where('venue_id',$venue_id->venue_id)
			->get()
			->row();

	        if($data['pattern']!==NULL){
				$data['others'] = $this->load->view('pattern/'.$data['pattern']->pattern_no.'',$data,true);
			}
			$data['default'] = $this->load->view('pattern/default',$data,true); 
			$this->load->view('pattern/press',$data); 


		} else {

			$this->load->view('admin/_header');
			$this->load->view('admin/_left_sideber');
			$this->load->view('admin/view_find_prescription');
			$this->load->view('admin/_footer');

		}

	}


#-------------------------------------------
#		view prescription
#-------------------------------------------		 

	public function prescription()
	{
		 $info = $this->db->where('name','timezone')->get('web_pages_tbl')->row();
          
            date_default_timezone_set(@$info->details);


		$appointment_id = $this->session->userdata('appointment_id');
		@$venue_id = $this->db->select('prescription_id,venue_id')->from('prescription')->where('appointment_id',$appointment_id)->get()->row();
	 	
	 	@$prescription_id = $venue_id->prescription_id;

		$data['patient_info'] = $this->prescription_model->prescription_by_id($prescription_id);
	    
	    // test query
	     $data['t_info'] = $this->db->select('*')
	     ->from('test_assign_for_patine')
	     ->join('test_name_tbl', 'test_name_tbl.test_id = test_assign_for_patine.test_id')
	     ->where('test_assign_for_patine.prescription_id',$prescription_id)
	     ->get()
	     ->result();
	     
	    // advice query
	      $data['a_info'] = $this->db->select('advice_prescriptiion.*,doctor_advice.*')
	     ->from('advice_prescriptiion')
	     ->join('doctor_advice', 'doctor_advice.advice_id = advice_prescriptiion.advice_id')
	     ->where('advice_prescriptiion.prescription_id',$prescription_id)
	     ->get()
	     ->result();

	    //venue info
	      $data['v_info'] = $this->db->select('prescription.venue_id,venue_tbl.*')
	     ->from('prescription')
	     ->join('venue_tbl', 'venue_tbl.venue_id = prescription.venue_id')
	     ->where('prescription.prescription_id',$prescription_id)
	     ->get()
	     ->row();

	 	@$venue_id = $this->db->select('prescription_id,venue_id')->from('prescription')->where('appointment_id',$appointment_id)->get()->row();
		
	     $data['chember_time'] = $this->db->select('*')
	        ->from('schedul_setup_tbl')
	        ->where('venue_id', $venue_id->venue_id)
	        ->limit(1)
	        ->get()
	        ->row();

	        $data['pattern'] = $this->db->select('*')
			->from('print_pattern')
			->where('doctor_id',$this->session->userdata('doctor_id'))
			->where('venue_id',$venue_id->venue_id)
			->get()
			->row();

	        if($data['pattern']!==NULL){
				$data['others'] = $this->load->view('pattern/'.$data['pattern']->pattern_no.'',$data,true);
			}

			$data['default'] = $this->load->view('pattern/default',$data,true); 
			$this->load->view('pattern/press',$data); 
	    
	}


	#--------------------------------------------
	#		veiw my_prescription
	#--------------------------------------------

	public function my_prescription($prescription_id=NULL)
	{

		$info = $this->db->where('name','timezone')->get('web_pages_tbl')->row();
          
        date_default_timezone_set(@$info->details);


		$data['patient_info'] = $this->prescription_model->prescription_by_id($prescription_id);
	    
	    // test query
	     $data['t_info'] = $this->db->select('*')
	     ->from('test_assign_for_patine')
	     ->join('test_name_tbl', 'test_name_tbl.test_id = test_assign_for_patine.test_id')
	     ->where('test_assign_for_patine.prescription_id',$prescription_id)
	     ->get()
	     ->result();
	     
	    // advice query
	      $data['a_info'] = $this->db->select('advice_prescriptiion.*,doctor_advice.*')
	     ->from('advice_prescriptiion')
	     ->join('doctor_advice', 'doctor_advice.advice_id = advice_prescriptiion.advice_id')
	     ->where('advice_prescriptiion.prescription_id',$prescription_id)
	     ->get()
	     ->result();
     	  //venue info
    


        $data['pattern'] = $this->db->select('*')
		->from('print_pattern')
		->where('doctor_id',$this->session->userdata('doctor_id'))
		->get()
		->row();

        if($data['pattern']!==NULL){
			$data['others'] = $this->load->view('pattern/'.$data['pattern']->pattern_no.'',$data,true);
		}
		$data['default'] = $this->load->view('pattern/default',$data,true); 
		$this->load->view('pattern/press',$data);  

	    
	}

	public function edit_prescription(){

		$prescription_id = $this->uri->segment('4');
	 	$data['pres'] = $this->represcription->re_data($prescription_id);
	 	$data['t_info'] = $this->represcription->re_test_data($prescription_id);
	 	$data['a_info'] = $this->represcription->re_advice_data($prescription_id);
	 	$data['m_info'] = $this->represcription->re_medicine($prescription_id);
	 	#---------------------------------
	 	// doctor venue info

		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/view_edit_prescription');
		$this->load->view('admin/_footer');
	}


	public function update_prescription(){

		 $info = $this->db->where('name','timezone')->get('web_pages_tbl')->row();
          
            date_default_timezone_set(@$info->details);
        $pres_id = $this->input->post('prescription_id',TRUE);
	 	$pdata['patient_id'] = $this->input->post('patient_id',TRUE);
	 	$pdata['appointment_id'] = $this->input->post('appointment_id',TRUE);
	 	$pdata['doctor_id'] = $this->input->post('doctor_id',TRUE);
	 	$pdata['Pressure'] = $this->input->post('Pressure',TRUE);
	 	$pdata['Weight'] = $this->input->post('Weight',TRUE);
	 	$pdata['problem'] = $this->input->post('Problem',TRUE);
	 	
	 	$pdata['oex'] = $this->input->post('oex',TRUE);
		$pdata['pd'] = $this->input->post('pd',TRUE);
		$pdata['history'] = $this->input->post('history',TRUE);
		$pdata['temperature'] = $this->input->post('temperature',TRUE);
		$pdata['prescription_type'] = 1;
	 	$pdata['pres_comments'] = $this->input->post('prescription_comment',TRUE);
	 	$pdata['create_date_time'] = date("Y-m-d H:i:s");
	 	$pdata['prescription_id'] = $pres_id;

	 			
		$sql_p = "delete from prescription where prescription_id = '$pres_id'";
		$res_p = $this->db->query($sql_p);

	 	$this->db->insert('prescription',$pdata);
		$user_id = $this->session->userdata('log_id');
		$action_title = 'Update prescription';
		$action_description = 'User update Prescriptiion';
		$action_link = $pres_id;
		//$action_link = $this->db->insert_id();
		$add_date = date('Y-m-d h:i:s');
		$sql_int = "insert into user_action_log (user_id,action_title,action_description,action_link,add_date) values ('$user_id','$action_title','$action_description','$action_link','$add_date')";
		$this->db->query($sql_int);
	#----------------------------------------------------#
			 	# medicine assign for patient 
	#----------------------------------------------------#    
	    $mdata['med_type'] = $this->input->post('type',TRUE)?$this->input->post('type',TRUE):[] ;
	 	$mdata['medicine_id'] =($this->input->post('medicine_id',TRUE))?($this->input->post('medicine_id',TRUE)):[];
	 	$mdata['mg'] = ($this->input->post('mg',TRUE))?($this->input->post('mg',TRUE)):[];
	 	$mdata['dose'] = ($this->input->post('dose',TRUE))?($this->input->post('dose',TRUE)):[];
	 	$mdata['day'] = ($this->input->post('day',TRUE));
	 	$mdata['comments'] = ($this->input->post('comments',TRUE));
	 	$mdata['appointment_id'] = $this->input->post('appointment_id',TRUE);
	 	$mdata['prescription_id'] = $pres_id;

	 	 $this->db->where('prescription_id',$pres_id)->delete('medicine_prescription');
			for($i=0; $i<count($mdata['medicine_id']); $i++) {

			 	if(empty($mdata['medicine_id'][$i])) {

			 		$md_name['medicine_name'] = $this->input->post('md_name',TRUE);
				 	$create_by = $this->session->userdata('doctor_id');
				 	$med_description = 'doctor description';

				 	# chack the medicine name in the medicine_info table 
				 	$query = $this->db->select('*')
	 	 			->from('medecine_info')
	 	 			->where('medicine_name',$md_name['medicine_name'][$i])
	 	 			->get()
	 	 			->row();

	 	 			if(!empty($query)) {
						$mdata['med_id'] = $query->medicine_id;
					} else {
						$medicine = array(
						'medicine_name' => $md_name['medicine_name'][$i],
						'med_company_id' => '01',
						'med_group_id' => '01',
						'med_description' => $med_description
					);
					# insert medicine id in medicine_info table
					$this->db->insert('medecine_info',$medicine);
					# medicine id
					$mdata['med_id'] = $this->db->insert_id();
					$user_id = $this->session->userdata('log_id');
					$action_link = $this->db->insert_id();
					$action_title = 'Update medecine info prescription';
					$action_description = 'User update medecine info';
					$add_date = date('Y-m-d h:i:s');
					$sql_int = "insert into user_action_log (user_id,action_title,action_description,action_link,add_date) values ('$user_id','$action_title','$action_description','$action_link','$add_date')";
					$this->db->query($sql_int);
					}
			 	} else {
			 		$mdata['med_id'] = $mdata['medicine_id'][$i];
			 	}

	            $data = array(
	                    'prescription_id'=> $mdata['prescription_id'],
	                    'appointment_id'=> $mdata['appointment_id'],
	                    'medicine_id'=> $mdata['med_id'],
	                    'mg'=>$mdata['mg'][$i],
	                    'dose'=>$mdata['dose'][$i],
	                    'day'=>$mdata['day'][$i],
	                    'medicine_type' => $mdata['med_type'][$i],
	                    'medicine_com'=>$mdata['comments'][$i]
	            );

	           
			
	            $this->db->insert('medicine_prescription', $data);
				$user_id = $this->session->userdata('log_id');
				$action_title = 'Add medecine prescription';
				$action_description = 'User Add medecine prescription';
				$action_link = $this->db->insert_id();
				$add_date = date('Y-m-d h:i:s');
				$sql_int = "insert into user_action_log (user_id,action_title,action_description,action_link,add_date) values ('$user_id','$action_title','$action_description','$action_link','$add_date')";
				$this->db->query($sql_int);
	        }
			#----------------------------------------------------#
					 	# test assign for patient
			#----------------------------------------------------#		 	
		 	$tdata['prescription_id'] = $pres_id;
		 	$tdata['test_id'] = ($this->input->post('test_name',TRUE))?($this->input->post('test_name',TRUE)):[];
		 	$tdata['test_description'] = ($this->input->post('test_description',TRUE))?($this->input->post('test_description',TRUE)):[];
		 	$tdata['appointment_id'] = $this->input->post('appointment_id',TRUE);
			$test_name = $this->input->post('test_name',TRUE)? $this->input->post('test_name',TRUE):[];
			$te_name    = $this->input->post('te_name',TRUE)?$this->input->post('te_name',TRUE):[];

		$this->db->where('prescription_id',$pres_id)->delete('test_assign_for_patine');


		if((sizeof($test_name) > 0 && !empty($test_name[0])) || (sizeof($te_name) > 0 && !empty($te_name[0]))){	 	
		 	
		 	for($i=0; $i<count($tdata['test_id']); $i++) {

	            if(empty($tdata['test_id'][$i])) {
			 		$test_name['test_name'] = $this->input->post('te_name');
				 	$test_description = 'doctor';
				 	# chack the test name in the test_info table 
				 		$query = $this->db->select('*')
				 	 			->from('test_name_tbl')
				 	 			->where('test_name',$test_name['test_name'][$i])
				 	 			->get()
				 	 			->row();
						if(!empty($query)) {
							$tdata['t_id'] = $query->test_id;
						} else {
							$tesAdd = array(
								'test_name' => $test_name['test_name'][$i],
								'test_description' => $test_description
								 );

							$this->db->insert('test_name_tbl', $tesAdd);
							$tdata['t_id'] = $this->db->insert_id();
						}

					
			 	} else {
			 		$tdata['t_id'] = $tdata['test_id'][$i];
			 	}

	            $data = array(
	        		'prescription_id' => $tdata['prescription_id'],
	        		'appointment_id' => $tdata['appointment_id'],
	                'test_id'=> $tdata['t_id'],
	                'test_assign_description'=>$tdata['test_description'][$i]
	            );



	        	$this->db->insert('test_assign_for_patine', $data);
			}
		}


		#---------------------------------------------------
		#			advice assign for patient
		#---------------------------------------------------

			$a_data['appointment_id'] = $this->input->post('appointment_id',TRUE);
			$a_data['prescription_id'] = $mdata['prescription_id'];
		 	$a_data['advice'] = ($this->input->post('advice',TRUE))?($this->input->post('advice',TRUE)):[];
	 		$num_advice = $this->input->post('advice',TRUE)?$this->input->post('advice',TRUE):[];
		 	$num_adv    = $this->input->post('adv',TRUE)?$this->input->post('adv',TRUE):[];

		 	$this->db->where('prescription_id',$pres_id)->delete('advice_prescriptiion');

		 if((sizeof($num_advice) > 0 && !empty($num_advice[0])) || (sizeof($num_adv) > 0 && !empty($num_adv[0]))){
			
			for($i=0; $i<=count($a_data['advice']); $i++) {
				if (array_key_exists($i, $a_data['advice'])) {

				if(empty($a_data['advice'][$i])) {

			 		$adv_name['advice'] = $this->input->post('adv',TRUE);
					@$adv = array(
						'advice' => $adv_name['advice'][$i],
						'create_by' => $this->session->userdata('doctor_id')
						);
					$this->db->insert('doctor_advice', $adv);
					$ad_data['advice'] = $this->db->insert_id();
			 	} else {
			 		$ad_data['advice'] = $a_data['advice'][$i];
			 	}

				$advice_data = array(
            		'appointment_id' => $a_data['appointment_id'],
            		'prescription_id'=> $a_data['prescription_id'],
            		'advice_id' => $ad_data['advice']
            	);
            	$this->db->insert('advice_prescriptiion',$advice_data);
				
            	}
			}
			$user_id = $this->session->userdata('log_id');
			$action_title = 'Add advice prescriptiion';
			$action_link = $this->db->insert_id();
			$action_description = 'User Add advice prescriptiion';
			$add_date = date('Y-m-d h:i:s');
			$sql_int = "insert into user_action_log (user_id,action_title,action_description,action_link,add_date) values ('$user_id','$action_title','$action_description','$action_link','$add_date')";
			$this->db->query($sql_int);

		}

	 	$d['appointment_id'] = $this->input->post('appointment_id');
    	$this->session->set_userdata($d);
	 	redirect("admin/Prescription_controller/my_prescription/".$pres_id);
	}
	
	
	
	public function send_prescription($p_id){
		
		// patient info
		$data['patient_info'] = $this->prescription_model->gereric_by_id($p_id);	    
	   
	    // test query
	    $data['t_info'] = $this->db->select('*')
	     ->from('test_assign_for_patine')
	     ->join('test_name_tbl', 'test_name_tbl.test_id = test_assign_for_patine.test_id')
	     ->where('test_assign_for_patine.prescription_id',$p_id)
	     ->get()
	     ->result();
		 
		//echo "<pre>";print_r($data['t_info']);die();

	    // advice query
	    $data['a_info'] = $this->db->select('advice_prescriptiion.*,doctor_advice.*')
	     ->from('advice_prescriptiion')
	     ->join('doctor_advice', 'doctor_advice.advice_id = advice_prescriptiion.advice_id')
	     ->where('advice_prescriptiion.prescription_id',$p_id)
	     ->get()
	     ->result();


	      //venue info
          $data['v_info'] = $this->db->select('prescription.venue_id,venue_tbl.*')
         ->from('prescription')
         ->join('venue_tbl', 'venue_tbl.venue_id = prescription.venue_id')
         ->where('prescription.prescription_id',$p_id)
         ->get()
         ->row();

	 	@$venue_id = $this->db->select('prescription_id,venue_id')->from('prescription')->where('prescription_id',$p_id)->get()->row();
	    $data['chember_time'] = $this->db->select('*')
	        ->from('schedul_setup_tbl')
	        ->where('venue_id', $venue_id->venue_id)
	        ->limit(1)
	        ->get()
	        ->row();

	        $data['pattern'] = $this->db->select('*')
			->from('print_pattern')
			->where('doctor_id',$this->session->userdata('doctor_id'))
			->where('venue_id',$venue_id->venue_id)
			->get()
			->row();
	        if($data['pattern']!==NULL){
				$data['others'] = $this->load->view('generic_pattern/'.$data['pattern']->pattern_no.'',$data,true);
			}
			$data['default'] = $this->load->view('generic_pattern/default',$data,true); 
			
			
		//echo "p_id--".$p_id;die();
		$ci = get_instance();
		$ci->load->library('email');
		$email_config = $this->email_model->email_config();
		$protocol = $email_config->protocol;
		$smtp_host = $email_config->mailpath;
		$smtp_port = $email_config->port;
		$smtp_user = $email_config->sender;
		$smtp_pass = $email_config->mailtype;
		$config['protocol'] = $protocol;
        $config['smtp_host'] = $smtp_host;
        $config['smtp_port'] = $smtp_port;
        $config['smtp_user'] = $smtp_user; 
        $config['smtp_pass'] = $smtp_pass;
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
		$ci->email->initialize($config);
		
		$patient_id='';
		$doctor_id='';
		$appointment_id='';
		$sequence='';
		$date='';
		$app_date='';
		$degrees='';
		$weight='';
		$pressure='';
		$problem='';
		$oex='';
		$pd='';
		$history='';
		$temperature='';
		$create_date_time='';
		$prescription_type='';
		
		$sql_p = "select * from prescription where prescription_id = '".$p_id."' ";
		$res_p = $this->db->query($sql_p);
		$result_p = $res_p->result_array();
		if(is_array($result_p) && count($result_p)>0){
			$patient_id = $result_p[0]['patient_id'];
			$doctor_id = $result_p[0]['doctor_id'];
			$appointment_id = $result_p[0]['appointment_id'];
			$pres_comments = $result_p[0]['pres_comments'];
			$weight = $result_p[0]['weight'];
			$pressure = $result_p[0]['pressure'];
			$problem = $result_p[0]['problem'];
			$oex = $result_p[0]['oex'];
			$pd = $result_p[0]['pd'];
			$history = $result_p[0]['history'];
			$temperature = $result_p[0]['temperature'];
			$create_date_time = $result_p[0]['create_date_time'];
			$prescription_type = $result_p[0]['prescription_type'];
			if($create_date_time!=""){
				//$create_date_time = date_format($create_date_time,"d-M-Y l");	
			}
			
		}
		
		
		if($appointment_id!=""){
			$sql_ap = "select * from appointment_tbl where appointment_id = '".$appointment_id."' ";
			//echo $sql_ap;
			$res_ap = $this->db->query($sql_ap);
			$result_ap = $res_ap->result_array();
			if(is_array($result_ap) && count($result_ap)>0){
				$sequence = $result_ap[0]['sequence'];
				$date = $result_ap[0]['date'];
			}
		}
		if($sequence!=""){
			$sequence = date('h:i A', strtotime($sequence));
			$app_date = date('jS F Y',strtotime($date));
		}
		
		$picture2='';
		$picture3='';
		if($patient_id!="" && $doctor_id!=""){
			$sql = "select * from patient_tbl where patient_id = '".$patient_id."' ";
			$res = $this->db->query($sql);
			$result = $res->result_array();
			if(is_array($result) && count($result)>0){
				$patient_name = $result[0]['patient_name'];
				$patient_email = $result[0]['patient_email'];
				$patient_age = $result[0]['age'];
				$patient_sex = $result[0]['sex'];
			}
			$sql_doc = "select * from doctor_tbl where doctor_id = '".$doctor_id."' ";
			$res_doc = $this->db->query($sql_doc);
			$result_doc = $res_doc->result_array();
			if(is_array($result_doc) && count($result_doc)>0){
				$picture2 = $result_doc[0]['picture2'];
				$picture3 = $result_doc[0]['picture3'];
				$doctor_name = $result_doc[0]['doctor_name'];
				$doc_id = $result_doc[0]['doc_id'];
				$degrees = $result_doc[0]['degrees'];
			}
			
			
			//echo "path...".APPPATH;die();
		
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		// create new PDF document
		//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('dejavusans', '', 10);

		// add a page
		$pdf->AddPage();

/* set background image  */

	$bMargin = $pdf->getBreakMargin();
	$auto_page_break = $pdf->getAutoPageBreak();
	$pdf->SetAutoPageBreak(false, 0);
	$img_file = 'https://www.telehealers.in//web_assets2/images/aajay.jpg';
	$pdf->Image($img_file, 0, 14.5, 210, 280, '', '', '', false, 300, '', false, false, 0);
	$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
	$pdf->setPageMark();

/* top header start */

	/* section one */
	$newDate='';
	if($create_date_time!=""){
		$date1 =  date_create($create_date_time);
		$newDate = date_format($date1,"d-M-Y l");
	}
	
	$html = '<span color="white">Date : '.$newDate.'<br />';
	$pdf->SetFillColor(4,158,141);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=12, $y=18, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
	
	/* section two */
	
	$html = '<span color="white">Patient Id: '.$patient_id.', Appointment Id: '.$appointment_id.'</span><br />';
	$pdf->SetTextColor(255, 255, 255);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=90, $y=18, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
	
	/* section three */

	$html = '<span color="white"></span><br />';
	$pdf->SetFont('dejavusans', '', 14);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=170, $y=17, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

/* top header end */

/* doctor details */
	/* section one */
	$html = '<span color="black">'.$doctor_name.'- ('.$doc_id.')</span>';
	$pdf->SetFont('dejavusans', '', 12);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=105, $y=30, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

	/* section two  */
	$html = '<span color="black">'.$degrees.'</span>';
	$pdf->SetFont('dejavusans', '', 9);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=105, $y=38, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);


	/* sectoin three */
	$html = '<span color="black">COVID Telehealer</span><br /><span>Online</span>';
	$pdf->SetFont('dejavusans', '', 9);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=105, $y=50, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

/* header two patient details */

	$html = '<span color="white">Patient Name: '.$patient_name.',   Age : '.$patient_age.',  Gender : '.$patient_sex.',  Patient Weight : '.$weight.',  Patient BP : '.$pressure.'</span><br />';
	$pdf->SetFont('dejavusans', '', 10);
	$pdf->SetFillColor(4,158,141);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->writeHTMLCell(210, 11, 0, +61, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=12, $y=64, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

/* complaint section  */
	$html = '<span color="#049e8d">Patient complaint</span>';
	$pdf->SetFont('dejavusans', '', 12);
	$pdf->SetTextColor(4,158,141);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=4, $y=75, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

		$cc =  explode(",",$problem);
		$html = '';
		for ($i=0; $i<count($cc); $i++) {
			 $html .= '<span color="grey">'.trim(html_escape(@$cc[$i])).'</span><br>';
		}
		$html = $html;
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=60, $h=0, $x=8, $y=85, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

/* history section */
	$html = '<span color="#049e8d">History</span>';
	$pdf->SetFont('dejavusans', '', 12);
	$pdf->SetTextColor(4,158,141);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=4, $y=105, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

		$cc =  explode(",",$history);
		$html = '';
		for ($i=0; $i<count($cc); $i++) {
			 $html .= '<span color="grey">'.trim(html_escape(@$cc[$i])).'</span><br>';
		}
		$html = $html;
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=60, $h=0, $x=8, $y=115, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);


/* temp section */
	$html = '<span color="#049e8d">Temperature : '.$temperature.'°C</span>';
	$pdf->SetFont('dejavusans', '', 12);
	$pdf->SetTextColor(4,158,141);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=4, $y=125, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

		$html = '<span color="#049e8d">O/Ex</span>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->SetTextColor(4,158,141);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=0, $h=0, $x=4, $y=135, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
	
			$html = '<span color="grey">. '.$oex.'</span>';
			$pdf->SetFont('dejavusans', '', 10);
			$pdf->SetTextColor(0,0,0);
			$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
			$pdf->writeHTMLCell($w=60, $h=0, $x=8, $y=142, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
	
		$html = '<span color="#049e8d">PD</span>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->SetTextColor(4,158,141);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=0, $h=0, $x=4, $y=150, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);


			$html = '<span color="grey">. '.$pd.'</span>';
			$pdf->SetFont('dejavusans', '', 10);
			$pdf->SetTextColor(0,0,0);
			$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
			$pdf->writeHTMLCell($w=60, $h=0, $x=8, $y=157, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);



/* test section */
	$html = '<span color="#049e8d">Test</span>';
	$pdf->SetFont('dejavusans', '', 12);
	$pdf->SetTextColor(4,158,141);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=4, $y=167, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

		$i=0; 
		$ex=165;
		$htmlc = '<span color="black">';
		foreach ($data['t_info'] as $value2) {
			
		$i++;
		$htmlc .= '<span color="grey"> '.$i.'. '.$value2->test_name.' - '.$value2->test_assign_description.'</span><br />';
		}
		$htmlc .= '';								
		
		$html = $htmlc;
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=60, $h=0, $x=10, $y=175, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
		$ex = $ex + 10;

/* advice section */
	$html = '<span color="#049e8d">Advice</span>';
	$pdf->SetFont('dejavusans', '', 12);
	$pdf->SetTextColor(4,158,141);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=4, $y=200, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
		
		$i=0; 
		$ex=165;
		$htmlc = '<span color="black">';
		foreach ($data['a_info'] as $value2) {
			
		$i++;
		$htmlc .= '<span color="grey"> '.$i.'. '.$value2->advice.'</span><br />';
		}
		$htmlc .= '';								
		
		$html = $htmlc;
		
		//$html = '<span color="black">. advice here </span><br /><span>. advice here</span>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(10, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=60, $h=0, $x=8, $y=210, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
		
/* advice section */
	//$html = '<span color="black" style="width:120px;">SL</span><span color="black">Type</span><span color="black">Generic name</span><span color="black">Mg/Ml</span><span color="black">Dose</span><span color="black">Day</span><span color="black">Comments</span>';
	
	$html = '<table cellspacing="4" cellpadding="4" border="" style="border:solid 1px #ccc;">
    <tr style="border:none;">
        <td align="center" style="border-right:1px solid #ccc; width:30px;  position: relative;">SL</td>
        <td align="center" style="border-right:1px solid #ccc; width:50px; padding:5px 5px;">Type</td>
        <td align="center" style="border-right:1px solid #ccc; width:120px; padding:5px 5px;">Generic name</td>
        <td align="center" style="border-right:1px solid #ccc; width:50px; padding:5px 5px;">Mg/Ml</td>
        <td align="center" style="border-right:1px solid #ccc; width:50px; padding:5px 5px;">Dose</td>
        <td align="center" style="border-right:1px solid #ccc; width:50px; padding:5px 5px;">Day</td>
        <td align="center" style="width:90px; padding:5px 5px;">Comments</td>
    </tr></table>';

	$pdf->SetFont('dejavusans', '', 11);
	$pdf->SetTextColor(0,0,0);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=70, $y=75, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
	
		$html = '<table cellspacing="4" cellpadding="4" border="" style="border:solid 1px #ccc;">'; 
		
		$i=0; 
		$j=85;
		foreach ($data['patient_info'] as $value1) {
			$i++;
			$j = $j + 15;
		$html .= ' <tr style="border:none; padding-top: 10px; padding-bottom:10px;">
        <td align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc; width:30px; position: relative; ">'.$i.'</td>
        <td align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc; width:50px; padding:5px 5px;">'.$value1->medicine_type.'</td>
        <td align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc; width:120px; padding:5px 5px;">'.$value1->group_name.'</td>
        <td align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc; width:50px; padding:5px 5px;">'.$value1->mg.'</td>
        <td align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc; width:50px; padding:5px 5px;"> '.$value1->dose.'</td>
        <td align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc; width:50px; padding:5px 5px;">'.$value1->day.'</td>
        <td align="center" style="border-bottom:1px solid #ccc; width:90px; padding:5px 5px;">'.$value1->medicine_com.'</td>
    </tr>';
		
		} 
		
		$html .= '</table>';
		
		$pdf->SetFont('dejavusans', '', 9);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=0, $h=0, $x=70, $y=85, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
		
		$html = $pres_comments;
		
		$pdf->SetFont('dejavusans', '', 9);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=0, $h=0, $x=70, $y=$j, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
		
		

				
	/* Sign of doctor  */
	if($picture3 !=""){
		
	$sign= str_replace('[removed]','data:image/png;base64,',$picture3); 
	
	$img = '<img src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $sign) . '">';
	
	//$pdf->writeHTML($img, 5157, 227, 430, 420, 'PNG', 'http://www.tcpdf.org', '', true, 50, '', false, false, 0, false, false, false);
	//$pdf->writeHTML($img,157, 227, 30, 20, true, false, true, false, '');
	
	$img = base64_decode(preg_replace('#^data:image/[^;]+;base64,#', '', $sign));
    
	$pdf->Image("@".$img, 155, 218, 36, 36);
	
	//$pdf->Image('https://www.telehealers.in/./assets/uploads/doctor/Whats2.jpeg', 157, 227, 30, 20, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 0, false, false, false);
		
		$html = '<span>------------------------</span><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Signature</span>';
		$pdf->SetFont('dejavusans', '', 14);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=0, $h=0, $x=150, $y=245, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);	
		
	}else{
		
		$html = '<span>------------------------</span><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Signature</span>';
		$pdf->SetFont('dejavusans', '', 14);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=0, $h=0, $x=150, $y=245, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);	
		
	}	

		//$pdf->Output('example_051.pdf', 'I');
		
		$rand = rand(1000,9999);
		$date = date('Y-m-d');
		$filename = $patient_id.'-'.$date.'-'.$rand;
		$filename2 = $patient_id.'-'.$date.'-'.$rand.'.pdf';
		
		$pdf->Output('/home/telehea2/telehealers.in/ppdf/'.$filename.'.pdf', 'FD');
		
		$sql_pdf = "update prescription set pdf = '$filename2' where prescription_id = '$p_id'";
		$this->db->query($sql_pdf);
		
			
			$message = '<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
    <center style="width: 100%; background-color: #f1f1f1;">
        <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
            &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <div style="max-width: 600px; margin: 0 auto;" class="email-container">
            <!-- BEGIN BODY -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tbody><tr>
                    <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody><tr>
                                <td class="logo" style="text-align: left;">
                                    <h1>
                                        <a href="https://telehealers.in/">
                                        <img src="https://telehealers.in/assets/uploads/images/telehe2.png">    
                                        </a>
                                    </h1>
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
                <tr>
                    </tr></tbody></table><table class="bg_white" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody><tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
                            <td valign="middle" width="100%" style="text-align:left; padding: 0 2.5em;">
                                <div class="product-entry">
                                    <div class="text">
                                        <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Dear '.$patient_name.':</h2>
										<p>Thanks for choosing telehealers.in</p>
										<p>We hope your consultation was well with '.$doctor_name.' </p>
                                        <p>Here you will find attachment of Prescription with this email</p>
										<p>Please download your Prescription from <a href="https://telehealers.in/Userlogin" target="_blank">Here</a></p>
										<p>&nbsp;</p>
										
                                        <p>Also you can login to the website to view it</p>
                                        <p>with below mentioned details from your account we have created:- </p>
										<p><b>Details of Login:-</b></p>
										<p>Url:  https://telehealers.in/Userlogin</p>
                                        <p>&nbsp;</p>
										
										<p>Keep in touch during this tough time! </p>
										<p>Kindly write us back without any hasitation if you find any issues at support@telehealers.in</p>
										
										
										
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody></table>
                
            
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tbody><tr>
                    <td class="bg_white" style="text-align: center;">
                        <p>Receive these email? You can <a href="#" style="color: rgba(0,0,0,.8);">Unsubscribe here</a></p>
                    </td>
                </tr>
            </tbody></table>

        </div>
    </center>


</body></html>';

		
		$img_url = 'https://www.telehealers.in/assets/uploads/images/telehe.png';
		$img_url2 = 'https://www.telehealers.in/web_assets2/images/aajay.jpg';
			
		//$file_path = 'https://www.telehealers.in/ppdf/'.$filename2;	
		$file_path = '/home/telehea2/telehealers.in/ppdf/'.$filename2;	
		$message2 = '';
		
		//$patient_email = 'raghuveer@ecomsolver.com';
		
		//echo $patient_email;die();
		
		$ci->email->from('info@telehealers.in', 'telehealers');
		$list = array($patient_email);
		$ci->email->to($list);
		$this->email->reply_to('info@telehealers.in', 'telehealers');
		$ci->email->subject('Prescription Information');
		$ci->email->message($message);
		$this->email->attach($file_path);
		$ci->email->send();
		
		$ci->email->from('info@telehealers.in', 'telehealers');
		$list = array('info@telehealers.in');
		$ci->email->to($list);
		$this->email->reply_to('info@telehealers.in', 'telehealers');
		$ci->email->subject('Prescription Information');
		$ci->email->message($message);
		$ci->email->send();
		
		}
		 
		$this->session->set_flashdata('message','<div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Prescription has been sent successfully!</strong>
              </div>');
			  
		//die();	  
		redirect("admin/Prescription_controller/prescription_list");
	}
	
	
	public function send_prescription2($p_id){
		
		$info = $this->db->where('name','timezone')->get('web_pages_tbl')->row();
        date_default_timezone_set(@$info->details);
		
		@$venue_id = '3';
		@$prescription_id = $p_id; 

		$data['patient_info'] = $this->prescription_model->prescription_by_id($prescription_id);
	    
	    // test query
	     $data['t_info'] = $this->db->select('*')
	     ->from('test_assign_for_patine')
	     ->join('test_name_tbl', 'test_name_tbl.test_id = test_assign_for_patine.test_id')
	     ->where('test_assign_for_patine.prescription_id',$prescription_id)
	     ->get()
	     ->result();
	     
	    // advice query
	      $data['a_info'] = $this->db->select('advice_prescriptiion.*,doctor_advice.*')
	     ->from('advice_prescriptiion')
	     ->join('doctor_advice', 'doctor_advice.advice_id = advice_prescriptiion.advice_id')
	     ->where('advice_prescriptiion.prescription_id',$prescription_id)
	     ->get()
	     ->result();
     	  //venue info
          $data['v_info'] = $this->db->select('prescription.venue_id,venue_tbl.*')
         ->from('prescription')
         ->join('venue_tbl', 'venue_tbl.venue_id = prescription.venue_id')
         ->where('prescription.prescription_id',$prescription_id)
         ->get()
         ->row();


			$data['chember_time'] = $this->db->select('*')
        ->from('schedul_setup_tbl')
        ->where('venue_id', @$venue_id->venue_id)
        ->limit(1)
        ->get()
        ->row();

        $data['pattern'] = $this->db->select('*')
		->from('print_pattern')
		->where('doctor_id',$this->session->userdata('doctor_id'))
		->where('venue_id',@$venue_id->venue_id)
		->get()
		->row();

        if($data['pattern']!==NULL){
			$data['others'] = $this->load->view('pattern/'.$data['pattern']->pattern_no.'',$data,true);
		}
		$data['default'] = $this->load->view('pattern/default',$data,true); 
			
			
		//echo "p_id--".$p_id;die();
		$ci = get_instance();
		$ci->load->library('email');
		$email_config = $this->email_model->email_config();
		$protocol = $email_config->protocol;
		$smtp_host = $email_config->mailpath;
		$smtp_port = $email_config->port;
		$smtp_user = $email_config->sender;
		$smtp_pass = $email_config->mailtype;
		$config['protocol'] = $protocol;
        $config['smtp_host'] = $smtp_host;
        $config['smtp_port'] = $smtp_port;
        $config['smtp_user'] = $smtp_user; 
        $config['smtp_pass'] = $smtp_pass;
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
		$ci->email->initialize($config);
		
		
		
		
		$patient_id='';
		$doctor_id='';
		$app_id='';
		$appointment_id='';
		$sequence='';
		$date='';
		$app_date='';
		$degrees='';
		$weight='';
		$pressure='';
		$problem='';
		$oex='';
		$pd='';
		$history='';
		$temperature='';
		$create_date_time='';
		$prescription_type='';
		
		$sql_p = "select * from prescription where prescription_id = '".$p_id."' ";
		$res_p = $this->db->query($sql_p);
		$result_p = $res_p->result_array();
		if(is_array($result_p) && count($result_p)>0){
			$patient_id = $result_p[0]['patient_id'];
			$app_id = $result_p[0]['appointment_id'];
			$doctor_id = $result_p[0]['doctor_id'];
			$pres_comments = $result_p[0]['pres_comments'];
			$weight = $result_p[0]['weight'];
			$pressure = $result_p[0]['pressure'];
			$problem = $result_p[0]['problem'];
			$oex = $result_p[0]['oex'];
			$pd = $result_p[0]['pd'];
			$history = $result_p[0]['history'];
			$temperature = $result_p[0]['temperature'];
			$create_date_time = $result_p[0]['create_date_time'];
			$prescription_type = $result_p[0]['prescription_type'];
			
		}
		if($patient_id!="" && $doctor_id!="" && $app_id!=""){
		
		if($app_id!=""){
			$sql_ap = "select * from appointment_tbl where appointment_id = '".$app_id."' ";
			//echo $sql_ap;
			$res_ap = $this->db->query($sql_ap);
			$result_ap = $res_ap->result_array();
			if(is_array($result_ap) && count($result_ap)>0){
				$sequence = $result_ap[0]['sequence'];
				$date = $result_ap[0]['date'];
			}
		}
		if($sequence!=""){
			$sequence = date('h:i A', strtotime($sequence));
			$app_date = date('jS F Y',strtotime($date));
		}
		
		$picture2='';
		$picture3='';
		if($patient_id!="" && $doctor_id!=""){
			$sql = "select * from patient_tbl where patient_id = '".$patient_id."' ";
			$res = $this->db->query($sql);
			$result = $res->result_array();
			if(is_array($result) && count($result)>0){
				$patient_name = $result[0]['patient_name'];
				$patient_email = $result[0]['patient_email'];
				$patient_age = $result[0]['age'];
				$patient_sex = $result[0]['sex'];
			}
			$sql_doc = "select * from doctor_tbl where doctor_id = '".$doctor_id."' ";
			$res_doc = $this->db->query($sql_doc);
			$result_doc = $res_doc->result_array();
			if(is_array($result_doc) && count($result_doc)>0){
				$picture2 = $result_doc[0]['picture2'];
				$picture3 = $result_doc[0]['picture3'];
				$doctor_name = $result_doc[0]['doctor_name'];
				$doc_id = $result_doc[0]['doc_id'];
				$degrees = $result_doc[0]['degrees'];
			}
		}	
			
				//echo "path...".APPPATH;die();
		
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		// create new PDF document
		//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('dejavusans', '', 10);

		// add a page
		$pdf->AddPage();

/* set background image  */

	$bMargin = $pdf->getBreakMargin();
	$auto_page_break = $pdf->getAutoPageBreak();
	$pdf->SetAutoPageBreak(false, 0);
	$img_file = 'https://www.telehealers.in//web_assets2/images/aajay.jpg';
	$pdf->Image($img_file, 0, 14.5, 210, 280, '', '', '', false, 300, '', false, false, 0);
	$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
	$pdf->setPageMark();

/* top header start */

	/* section one */
	$newDate='';
	if($create_date_time!=""){
		$date1 =  date_create($create_date_time);
		$newDate = date_format($date1,"d-M-Y l");
	}
	
	$html = '<span color="white">Date : '.$newDate.'<br />';
	$pdf->SetFillColor(4,158,141);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=12, $y=18, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
	
	/* section two */
	
	$html = '<span color="white">Patient Id: '.$patient_id.', Appointment Id: '.$app_id.'</span><br />';
	$pdf->SetTextColor(255, 255, 255);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=90, $y=18, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
	
	/* section three */

	$html = '<span color="white"></span><br />';
	$pdf->SetFont('dejavusans', '', 14);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=170, $y=17, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

/* top header end */

/* doctor details */
	/* section one */
	$html = '<span color="black">'.$doctor_name.'- ('.$doc_id.')</span>';
	$pdf->SetFont('dejavusans', '', 12);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=105, $y=30, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

	/* section two  */
	$html = '<span color="black">'.$degrees.'</span>';
	$pdf->SetFont('dejavusans', '', 9);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=105, $y=38, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);


	/* sectoin three */
	$html = '<span color="black">COVID Telehealer</span><br /><span>Online</span>';
	$pdf->SetFont('dejavusans', '', 9);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=105, $y=50, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

/* header two patient details */

	$html = '<span color="white">Patient Name: '.$patient_name.',   Age : '.$patient_age.',  Gender : '.$patient_sex.',  Patient Weight : '.$weight.',  Patient BP : '.$pressure.'</span><br />';
	$pdf->SetFont('dejavusans', '', 10);
	$pdf->SetFillColor(4,158,141);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->writeHTMLCell(210, 11, 0, +61, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=12, $y=64, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

/* complaint section  */
	$html = '<span color="#049e8d">Patient complaint</span>';
	$pdf->SetFont('dejavusans', '', 12);
	$pdf->SetTextColor(4,158,141);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=4, $y=75, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

		$cc =  explode(",",$problem);
		$html = '';
		for ($i=0; $i<count($cc); $i++) {
			 $html .= '<span color="grey">'.trim(html_escape(@$cc[$i])).'</span><br>';
		}
		$html = $html;
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=60, $h=0, $x=8, $y=85, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

/* history section */
	$html = '<span color="#049e8d">History</span>';
	$pdf->SetFont('dejavusans', '', 12);
	$pdf->SetTextColor(4,158,141);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=4, $y=105, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

		$cc =  explode(",",$history);
		$html = '';
		for ($i=0; $i<count($cc); $i++) {
			 $html .= '<span color="grey">'.trim(html_escape(@$cc[$i])).'</span><br>';
		}
		$html = $html;
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=60, $h=0, $x=8, $y=115, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);


/* temp section */
	$html = '<span color="#049e8d">Temperature : '.$temperature.'°C</span>';
	$pdf->SetFont('dejavusans', '', 12);
	$pdf->SetTextColor(4,158,141);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=4, $y=125, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

		$html = '<span color="#049e8d">O/Ex</span>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->SetTextColor(4,158,141);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=0, $h=0, $x=4, $y=135, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
	
			$html = '<span color="grey">. '.$oex.'</span>';
			$pdf->SetFont('dejavusans', '', 10);
			$pdf->SetTextColor(0,0,0);
			$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
			$pdf->writeHTMLCell($w=60, $h=0, $x=8, $y=142, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
	
		$html = '<span color="#049e8d">PD</span>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->SetTextColor(4,158,141);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=0, $h=0, $x=4, $y=150, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);


			$html = '<span color="grey">. '.$pd.'</span>';
			$pdf->SetFont('dejavusans', '', 10);
			$pdf->SetTextColor(0,0,0);
			$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
			$pdf->writeHTMLCell($w=60, $h=0, $x=8, $y=157, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);



/* test section */
	$html = '<span color="#049e8d">Test</span>';
	$pdf->SetFont('dejavusans', '', 12);
	$pdf->SetTextColor(4,158,141);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=4, $y=167, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

		$i=0; 
		$ex=165;
		$htmlc = '<span color="black">';
		foreach ($data['t_info'] as $value2) {
			
		$i++;
		$htmlc .= '<span color="grey"> '.$i.'. '.$value2->test_name.' - '.$value2->test_assign_description.'</span><br />';
		}
		$htmlc .= '';								
		
		$html = $htmlc;
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=60, $h=0, $x=10, $y=175, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
		$ex = $ex + 10;

/* advice section */
	$html = '<span color="#049e8d">Advice</span>';
	$pdf->SetFont('dejavusans', '', 12);
	$pdf->SetTextColor(4,158,141);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=4, $y=184, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
		
		$i=0; 
		$ex=165;
		$htmlc = '<span color="black">';
		foreach ($data['a_info'] as $value2) {
			
		$i++;
		$htmlc .= '<span color="grey"> '.$i.'. '.$value2->advice.'</span><br />';
		}
		$htmlc .= '';								
		
		$html = $htmlc;
		
		//$html = '<span color="black">. advice here </span><br /><span>. advice here</span>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(10, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=60, $h=0, $x=8, $y=194, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
		
/* advice section */
	//$html = '<span color="black" style="width:120px;">SL</span><span color="black">Type</span><span color="black">Generic name</span><span color="black">Mg/Ml</span><span color="black">Dose</span><span color="black">Day</span><span color="black">Comments</span>';
	
	$html = '<table cellspacing="4" cellpadding="4" border="" style="border:solid 1px #ccc;">
    <tr style="border:none;">
        <td align="center" style="border-right:1px solid #ccc; width:30px;  position: relative;">SL</td>
        <td align="center" style="border-right:1px solid #ccc; width:50px; padding:5px 5px;">Type</td>
        <td align="center" style="border-right:1px solid #ccc; width:120px; padding:5px 5px;">Medicine name</td>
        <td align="center" style="border-right:1px solid #ccc; width:50px; padding:5px 5px;">Mg/Ml</td>
        <td align="center" style="border-right:1px solid #ccc; width:50px; padding:5px 5px;">Dose</td>
        <td align="center" style="border-right:1px solid #ccc; width:50px; padding:5px 5px;">Day</td>
        <td align="center" style="width:90px; padding:5px 5px;">Comments</td>
    </tr></table>';

	$pdf->SetFont('dejavusans', '', 11);
	$pdf->SetTextColor(0,0,0);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=70, $y=75, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
	
		$html = '<table cellspacing="4" cellpadding="4" border="" style="border:solid 1px #ccc;">'; 
		
		$i=0; 
		$j=85;
		foreach ($data['patient_info'] as $value1) {
			$i++;
			$j = $j + 15;
		$html .= ' <tr style="border:none; padding-top: 10px; padding-bottom:10px;">
        <td align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc; width:30px; position: relative; ">'.$i.'</td>
        <td align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc; width:50px; padding:5px 5px;">'.$value1->medicine_type.'</td>
        <td align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc; width:120px; padding:5px 5px;">'.$value1->medicine_name.'</td>
        <td align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc; width:50px; padding:5px 5px;">'.$value1->mg.'</td>
        <td align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc; width:50px; padding:5px 5px;"> '.$value1->dose.'</td>
        <td align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc; width:50px; padding:5px 5px;">'.$value1->day.'</td>
        <td align="center" style="border-bottom:1px solid #ccc; width:90px; padding:5px 5px;">'.$value1->medicine_com.'</td>
    </tr>';
		
		} 
		
		$html .= '</table>';
		
		$pdf->SetFont('dejavusans', '', 9);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=0, $h=0, $x=70, $y=85, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
		
		$html = $pres_comments;
		
		$pdf->SetFont('dejavusans', '', 9);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=0, $h=0, $x=70, $y=$j, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
		
		

				
	/* Sign of doctor  */
	if($picture3 !=""){
		
	$sign= str_replace('[removed]','data:image/png;base64,',$picture3); 
	
	$img = '<img src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $sign) . '">';
	
	//$pdf->writeHTML($img, 5157, 227, 430, 420, 'PNG', 'http://www.tcpdf.org', '', true, 50, '', false, false, 0, false, false, false);
	//$pdf->writeHTML($img,157, 227, 30, 20, true, false, true, false, '');
	
	$img = base64_decode(preg_replace('#^data:image/[^;]+;base64,#', '', $sign));
    
	$pdf->Image("@".$img, 155, 218, 36, 36);
	
	//$pdf->Image('https://www.telehealers.in/./assets/uploads/doctor/Whats2.jpeg', 157, 227, 30, 20, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 0, false, false, false);
		
		$html = '<span>------------------------</span><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Signature</span>';
		$pdf->SetFont('dejavusans', '', 14);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=0, $h=0, $x=150, $y=245, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);	
		
	}else{
		
		$html = '<span>------------------------</span><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Signature</span>';
		$pdf->SetFont('dejavusans', '', 14);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=0, $h=0, $x=150, $y=245, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);	
		
	}	

		//$pdf->Output('example_051.pdf', 'I');
		
		$rand = rand(1000,9999);
		$date = date('Y-m-d');
		$filename = $patient_id.'-'.$date.'-'.$rand;
		$filename2 = $patient_id.'-'.$date.'-'.$rand.'.pdf';
		$pdf->Output('/home/telehea2/telehealers.in/ppdf/'.$filename.'.pdf', 'FD');
		
		$sql_pdf = "update prescription set pdf = '$filename2' where prescription_id = '$p_id'";
		$this->db->query($sql_pdf);
		
		//die();	
			
			$message = '<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
    <center style="width: 100%; background-color: #f1f1f1;">
        <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
            &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <div style="max-width: 600px; margin: 0 auto;" class="email-container">
            <!-- BEGIN BODY -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tbody><tr>
                    <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody><tr>
                                <td class="logo" style="text-align: left;">
                                    <h1>
                                        <a href="https://telehealers.in/">
                                        <img src="https://telehealers.in/assets/uploads/images/telehe2.png">    
                                        </a>
                                    </h1>
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
                <tr>
                    </tr></tbody></table><table class="bg_white" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody><tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
                            <td valign="middle" width="100%" style="text-align:left; padding: 0 2.5em;">
                                <div class="product-entry">
                                    <div class="text">
                                        <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Dear '.$patient_name.':</h2>
										<p>Thanks for choosing telehealers.in</p>
										<p>We hope your consultation was well with '.$doctor_name.' </p>
                                        <p>Here you will find attachment of Prescription with this email</p>
										<p>Please download your Prescription from <a href="https://telehealers.in/Userlogin" target="_blank">Here</a></p>
										<p>&nbsp;</p>
										
                                        <p>Also you can login to the website to view it</p>
                                        <p>with below mentioned details from your account we have created:- </p>
										<p><b>Details of Login:-</b></p>
										<p>Url:  https://telehealers.in/Userlogin</p>
                                        
										
										<p>Keep in touch during this tough time! </p>
										<p>Kindly write us back without any hasitation if you find any issues at support@telehealers.in</p>
										
										
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody></table>
                
            
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tbody><tr>
                    <td class="bg_white" style="text-align: center;">
                        <p>Receive these email? You can <a href="#" style="color: rgba(0,0,0,.8);">Unsubscribe here</a></p>
                    </td>
                </tr>
            </tbody></table>

        </div>
    </center>


</body></html>';

		$file_path = '/home/telehea2/telehealers.in/ppdf/'.$filename2;	


		//$patient_email = 'raghuveer@ecomsolver.com';
		$ci->email->from('info@telehealers.in', 'telehealers');
		$list = array($patient_email);
		$ci->email->to($list);
		$this->email->reply_to('info@telehealers.in', 'telehealers');
		$ci->email->subject('Prescription Information');
		$ci->email->message($message);
		$this->email->attach($file_path);
		$ci->email->send();
		
		$ci->email->from('info@telehealers.in', 'telehealers');
		$list = array('info@telehealers.in');
		$ci->email->to($list);
		$this->email->reply_to('info@telehealers.in', 'telehealers');
		$ci->email->subject('Prescription Information');
		$ci->email->message($message);
		$ci->email->send();
		}
		$this->session->set_flashdata('message','<div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Prescription has been sent successfully!</strong>
              </div>');
		//die(); 
		redirect("admin/Prescription_controller/prescription_list");
	}
	

}
