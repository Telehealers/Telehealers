<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_controller extends CI_Controller {
  #------------------------------------------------
  #       construction function
  #------------------------------------------------
	public function __construct() 
	{
		parent::__construct();
	  $this->load->model('admin/Ajax_model','ajax_model');
	}


  public function patternSetData($pattern=NULL)
  {

    if($pattern=='pattern_one'){
          $patternData = array(
            'h_height' => 250, 
            'h_width' => 800,
            'f_height' => 200,
            'f_width' => 800,
            'content1_height' =>300,
            'content1_width' => 270,
            'content2_height' => 300,
            'content2_width' => 520
           );
    } elseif ($pattern=='pattern_two') {
        $patternData = array(
            'h_height' => 250, 
            'h_width' => 800,
            'f_height' => 200,
            'f_width' => 800,
            'content1_height' =>300,
            'content1_width' => 800,
            'content2_height' => 300,
            'content2_width' => 800
          );
    }      
    echo json_encode($patternData);
  }



  public function patternSetDataEdit($pattern=NULL)
  {
      $result = $this->db->select('*')
      ->from('print_pattern')
      ->where('pattern_no', $pattern)
      ->where('doctor_id', $this->session->userdata('doctor_id'))
      ->get()
      ->row();

      echo json_encode($result);
  }

  public function medicine_selection() {
    if (!empty($_GET['term'])){
      $keyword = $_GET['term']; 
      $result = $this->db->select('medicine_id,medicine_name')
      ->from('medecine_info')
      ->like('medicine_name', $keyword)
      ->get()
      ->result();

      echo  '[';
      if(!empty($result)) {
            $addComa=false;
            foreach ($result as $value) {
              if ($addComa) {
                echo ",";
              }
              $addComa = true;
              echo '{"value":"'.$value->medicine_id.'", "label":"'.$value->medicine_name.'"}';
            }
            // echo '<ul>';
        }
        echo ']';
      }
  }

  #------------------------------------------------
  #       medicine_sajetion
  #------------------------------------------------
  public function medicine_sajetion()
  {
    if (!empty($_GET['keyword'])){
      $keyword = $_GET['keyword']; 
      $result = $this->db->select('*')
      ->from('medecine_info')
      ->like('medicine_name', $keyword)
      ->get()
      ->result();
      
         if(!empty($result)) {
            echo  '<ul class="country-list" id="country-list">';
            $i=1;
            foreach ($result as $value) {
              echo '<li value="'.$value->medicine_id.'">'.$value->medicine_name.'</li>';
            }
            echo '<ul>';
        }
    }
  }

    #------------------------------------------------
    #       test_sajetion
    #------------------------------------------------
    public function test_sajetion()
    {
        if (! empty($_GET['keyword'])) {
          $keyword = $_GET['keyword'];
          $result = $this->db->select('*')->from('test_name_tbl')->like('test_name',$keyword)->get()->result();
              
            if(!empty($result)) {
                echo  '<ul class="country-list" id="country-list">';
                $i=1;
                foreach ($result as $value) {
                     echo '<li value="'.$value->test_id.'">'.$value->test_name.'</li>';
                }
                echo '<ul>';
            }
        }
    }


  public function test_selection() {
      if (!empty($_GET['term'])){
        $keyword = $_GET['term']; 
        $result = $this->db->select('test_id,test_name')
        ->from('test_name_tbl')
        ->like('test_name', $keyword)
        ->get()
        ->result();

        $tests = array();
        echo  '[';
        if(!empty($result)) {
              $addComa=false;
              foreach ($result as $value) {
                if ($addComa) {
                  echo ",";
                }
                $addComa = true;
                echo '{"value":"'.$value->test_id.'", "label":"'.$value->test_name.'"}';
              }
              // echo '<ul>';
          }
          echo ']';
        }
     }

     #doctor selection 
    public function doctor_selection() {
      if (!empty($_GET['term'])){
        $keyword = $_GET['term']; 
        $result = $this->db->select('doctor_id,doctor_name')
        ->from('doctor_tbl')
        ->like('doctor_name', $keyword)
        ->get()
        ->result();

        $tests = array();
        echo  '[';
        if(!empty($result)) {
              $addComa=false;
              foreach ($result as $value) {
                if ($addComa) {
                  echo ",";
                }
                $addComa = true;
                echo '{"value":"'.$value->doctor_id.'", "label":"'.$value->doctor_name.'"}';
              }
              // echo '<ul>';
          }
          echo ']';
        }
     }

    #------------------------------------------------
    #       advice_selection
    #------------------------------------------------
    public function advice_selection()
    {
        if (!empty($_GET['term'])) {
            $keyword = $_GET['term'];
            $result = $this->db->select('advice_id,advice')
            ->from('doctor_advice')
            ->like('advice',$keyword)
            ->get()
            ->result();
                
            $tests = array();
            echo  '[';
            if(!empty($result)) {
              $addComa=false;
              foreach ($result as $value) {
                if ($addComa) {
                  echo ",";
                }
                $addComa = true;
                
                echo '{"value":"'.$value->advice_id.'", "label":"'.$value->advice.'"}';
              }
              // echo '<ul>';
          }
          echo ']';
        }
  }

      public function patient_selection()
    {
        $doctor_id = $this->session->userdata('doctor_id');

        if (!empty($_GET['term'])) {
            $keyword = $_GET['term'];
            $result=null;
            if($doctor_id=='1'){
              $result = $this->db->select('patient_id,patient_name')
            ->from('patient_tbl')
            ->like('patient_name',$keyword)
            ->get()
            ->result();  
            }
            else{
            $result = $this->db->select('patient_id,patient_name')
            ->from('patient_tbl')
            ->where('doctor_id',$doctor_id)
            ->like('patient_name',$keyword)
            ->get()
            ->result();
            }    
            $tests = array();
            echo  '[';
            if(!empty($result)) {
              $addComa=false;
              foreach ($result as $value) {
                if ($addComa) {
                  echo ",";
                }
                $addComa = true;
                
                echo '{"value":"'.$value->patient_id.'", "label":"'.$value->patient_name.'"}';
              }
              // echo '<ul>';
          }
          echo ']';
        }
  }


    #------------------------------------------------
    #       Company_sajetion
    #------------------------------------------------
    public function Company_sajetion()
    {
        if (!empty($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
                $result = $this->db->select('*')->from('medicine_company_info')->like('company_name',$keyword)->get()->result();
              
                if(!empty($result)) {
                echo  '<ul class="country-list" id="country-list">';
                $i=1;
                foreach ($result as $value) {
                  echo '<li value="'.$value->company_id.'">'.$value->company_name.'</li>';
                }
                echo '<ul>';
            }
        }
    }

  #------------------------------------------------
  #       group_sajetion
  #------------------------------------------------

  public function group_sajetion()
  {
      if (!empty($_GET['keyword'])) {
      $keyword = $_GET['keyword'];
       $result = $this->db->select('*')->from('medicine_group_tbl')->like('group_name',$keyword)->get()->result();
          
         if(!empty($result)) {
          echo  '<ul class="country-list" id="group-list">';
          $i=1;
          foreach ($result as $value) {
              echo '<li id="group-list" value="'.$value->med_group_id.'" >'.$value->group_name.'</li>';
          }
          echo '<ul>';
         }
      }
  }

  #------------------------------------------------
  #       load_patient_info
  #------------------------------------------------
  public function load_patient_info($patient_id)
  {
      $result = $this->ajax_model->get_patient_name($patient_id);
  		if(!empty($result)) {
  		      echo json_encode($result);

  		} else {
  		      echo 0; 
  		} 
  }

  #------------------------------------------------
  #       get_patinet_name
  #------------------------------------------------

	public function get_patinet_name($patient_id=NULL)
	{
		$result = $this->ajax_model->get_patient_name($patient_id);
		
		//echo $patient_id;die();

	    if(!empty($result)) {
	      echo $result->patient_name;
	    } else {
	      echo 0; 
	    } 
	}

  public function get_patinet_id($patient_id=NULL){
    $result = $this->ajax_model->get_patient_id($patient_id);

    if($result!='') {
        echo '<div class="alert alert-danger">
                   <strong>MESSAGE!</strong>
                    <p>'.display('patient_id_exist_msg').'</p>
                </div>';
    } else {
        echo 0; 
    } 
  }

  #------------------------------------------------
  #       get_doctor
  #------------------------------------------------		
  public function get_doctor($dpt_id=NULL)
  {
    $hospital_id = $this->session->userdata('hospital_id');
    $result = $this->db->select('
          doctor_tbl.doctor_id,
          doctor_tbl.doctor_name
          ')
          ->from('hospital_doctor')
          ->join('doctor_tbl','doctor_tbl.doctor_id = hospital_doctor.doctor_id')
          ->join('department_tbl','department_tbl.department_id = doctor_tbl.department_id')
          ->where('hospital_doctor.hospital_id',$hospital_id)  
          ->where('doctor_tbl.department_id',$dpt_id)  
          ->where('hospital_doctor.h_status',1)  
          ->where('hospital_doctor.d_status',1)  
          ->get()
          ->result();
          echo '<option value="">--Select Doctor--</option>';
         foreach ($result as $value) {
         echo ' <option value="'.$value->doctor_id.'">'.$value->doctor_name.'</option>';
         }
  }

#------------------------------------------------
#      get Venue 
#------------------------------------------------
  	
  public function get_venue($dc_id=NULL)
  {
    $result = $this->db->select('venue_tbl.venue_name,venue_tbl.venue_id')
    ->from('schedul_setup_tbl')
    ->join('venue_tbl','venue_tbl.venue_id = schedul_setup_tbl.venue_id')
    ->where('schedul_setup_tbl.doctor_id',$dc_id)
    ->where('schedul_setup_tbl.visibility',1)
    ->where('schedul_setup_tbl.status',1)
      ->group_by('schedul_setup_tbl.venue_id') 
    ->order_by('venue_tbl.venue_name','asc')
    ->get()
    ->result();

    if($result) {
      echo '<option value="">--Select venue--</option>';
      foreach ($result as $value) {
           echo ' <option value="'.$value->venue_id.'">'.$value->venue_name.'</option>';
         }
      } else {
      echo display('venue_empty_msg');
    }
  }

  #------------------------------------------------
  #       get schedul
  #------------------------------------------------
  	
  public function get_schedul($venue_id =NULL, $date=NULL, $doctor_id=NULL)
  {
      $this->ajax_model->get_appointment($venue_id,$date,$doctor_id);
  }
  
  public function get_schedul2($venue_id =NULL, $date=NULL, $doctor_id=NULL)
  {
      $this->ajax_model->get_appointment($venue_id,$date,$doctor_id);
  }
  
  #------------------------------------------------
  #       action set
  #------------------------------------------------

  public function action_set($val=NULL,$id=NULL)
  {
    $this->liveModel->get_action($val,$id);
  }

  #------------------------------------------------
  #       age_to_birthdate
  #------------------------------------------------
  public function age_to_birthdate($age=NULL)
  {
    echo $bith_date =  $end_time = date('Y-m-d', strtotime("-$age year"));
  }

#--------------------------------------

  public function get_teamplate($teamplate_id=NULL){
    
    $row = $this->db->select('*')
    ->from('sms_teamplate')
    ->where('teamplate_id',$teamplate_id)
    ->get()
    ->row();
    echo'<label class="col-md-3 control-label"></label>
    <div class="col-md-9">
             <textarea name="teamplate" class="form-control" rows="4" co>'.@$row->teamplate.'</textarea>
        </div>';
  } 


 #-----------------------------

  public function getInfo($id=NULL){
    $result = $this->db->select("action_serial.*,doctor_tbl.*,
            patient_tbl.*,
            venue_tbl.*,")
              ->from('action_serial')
              ->join('patient_tbl', 'patient_tbl.patient_id = action_serial.patient_id')
              ->join('doctor_tbl', 'doctor_tbl.doctor_id = action_serial.doctor_id')
              ->join('venue_tbl', ' venue_tbl.venue_id = action_serial.venue_id')
              ->where('action_serial.appointment_id',$id)
              ->get()->row();

        echo json_encode($result);
  }

#----------------------------------------
# appointment to sms
#-----------------------------------------
public function sendSms(){
      
    // load sms gateway
    $this->load->library('Smsgateway');

    $appointment_id = $this->input->post('appointment_id',TRUE);
    $appointment_date = $this->input->post('appointment_date',TRUE);
    $sequence = $this->input->post('sequence',TRUE);
    $teamplate_id = $this->input->post('teamplate_id',TRUE);
    $doctor_name = $this->input->post('doctor_name',TRUE);
    $patient_name = $this->input->post('name',TRUE);
    $patient_id = $this->input->post('patient_id',TRUE);
    $patient_phone = $this->input->post('to',TRUE);
    $teamplate = $this->input->post('teamplate',TRUE);
    $gateway_id = $this->input->post('sms_gateway_id',TRUE);
    $gateway = $this->input->post('gateway',TRUE);
    $per_patient_time = $this->input->post('per_patient_time',TRUE);
    $start_time = $this->input->post('start_time',TRUE);


    $sequence_time = $sequence;

    // get gateway information
    $sms_gateway_info = $this->db->select('*')->from('sms_gateway')->where('gateway_id',$gateway_id)->get()->row();


        #---------------------------     
        // sms_setting    
        if(!empty($sms_gateway_info)) {

             $template = $this->smsgateway->template([
                 'doctor_name'      => $doctor_name,
                 'appointment_id'   => $appointment_id,
                 'patient_name'     => $patient_name,
                 'patient_id'       => $patient_id,
                 'sequence'         => $sequence, 
                 'appointment_date' => date('d F Y',strtotime($appointment_date)),
                 'message'          => $teamplate
            ]); 
              

             $this->smsgateway->send([
                 'apiProvider' => $sms_gateway_info->provider_name,
                 'username'    => $sms_gateway_info->user,
                 'password'    => $sms_gateway_info->password,
                 'from'        => $sms_gateway_info->authentication,
                 'to'          => $patient_phone,
                 'message'     => $template
             ]);

            //custom_sms_info
            $data_save = array(
                'reciver' => $patient_phone,
                'gateway' => $sms_gateway_info->provider_name,
                'message' => $template,
                'sms_date_time' => date("Y-m-d h:i:s")
            );
            $this->db->insert('custom_sms_info',$data_save);
        }
        echo json_encode(array('status'=>1));    
  }


}