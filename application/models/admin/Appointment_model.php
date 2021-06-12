<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment_model extends CI_model {


    public function Check_appointment($date=NULL,$patient=NULL){
      
       return $result = $this->db->select('*')
        ->from('appointment_tbl')
        ->where('date',$date)
        ->where('patient_id',$patient)
        ->get()->result();
    }
	
	public function Check_appointment_with_doctor($date=NULL,$patient=NULL,$doc_id=NULL){
      
       return $result = $this->db->select('*')
        ->from('appointment_tbl')
        ->where('date',$date)
        ->where('patient_id',$patient)
		->where('doctor_id',$doc_id)
        ->get()->result();
    }
    
    /** A function to save appointment as in input(savedata) into appointment_tbl.
     * NOTE: This function ensures atomicity and therefore other function doesn't need
     *  to caller function doesn't need to consider failure case where 2 appointment of 
     *  same slot is booked twice. 
    */
    public function SaveAppoin($savedata)
    {
        $date = array_key_exists('date', $savedata)? $savedata['date']:""; 
        $patient_id = array_key_exists('patient_id', $savedata)? $savedata['patient_id']:""; 
        $appointment_id = array_key_exists('appointment_id', $savedata)? $savedata['appointment_id']:""; 
        $schedul_id = array_key_exists('schedul_id', $savedata)? $savedata['schedul_id']:0; 
        $sequence = array_key_exists('sequence', $savedata)? $savedata['sequence']:""; 
        $venue_id = array_key_exists('venue_id', $savedata)? $savedata['venue_id']:""; 
        $doctor_id = array_key_exists('doctor_id', $savedata)? $savedata['doctor_id']:""; 
        $problem = array_key_exists('problem', $savedata)? $savedata['problem']:""; 
        $service = array_key_exists('service', $savedata)? $savedata['service']:""; 
        $servicetype = array_key_exists('servicetype', $savedata)? $savedata['servicetype']:"";
        $symt1 = array_key_exists('symt1', $savedata)? $savedata['symt1']:"";
        $symt2 = array_key_exists('symt2', $savedata)? $savedata['symt2']:"";
        //$get_by = array_key_exists('get_by', $savedata)? $savedata['get_by']:0; 
		$get_by = 0; 
        $get_date_time = array_key_exists('get_date_time', $savedata)? $savedata['get_date_time']:""; 
        $status = array_key_exists('status', $savedata)? $savedata['status']:1; 
        
        $insert_query = "INSERT INTO appointment_tbl (appointment_id, patient_id, venue_id, doctor_id,".
            " schedul_id, problem, service, servicetype, symt1, symt2, get_date_time, get_by, date, status, sequence) ".
            "SELECT '".$appointment_id."' as appointment_id, '".$patient_id."' as patient_id, ".
                $venue_id." as venue_id, ".$doctor_id." as doctor_id, ".$schedul_id." as schedul_id, '".
                $problem."' as problem, '".$service."' as service, '".$servicetype."' as servicetype, '".
                $symt1."' as symt1, '".$symt2."' as symt2, '".$get_date_time."' as get_date_time, "
                .$get_by." as get_by, '".$date."' as date, ".$status." as status, '".
                $sequence."' as sequence WHERE 1 NOT IN (".
                "SELECT 1 FROM appointment_tbl apt, schedul_setup_tbl schedule".
                " WHERE apt.doctor_id = schedule.doctor_id AND ".
                " schedule.doctor_id = ".$savedata["doctor_id"].
                " AND apt.sequence <= '".$savedata["sequence"]."' AND ".
                " '".$savedata["sequence"]."' <= ADDTIME(apt.sequence, schedule.per_patient_time)".
                " AND apt.date = '".$date."')"
            ;
        return $this->db->query($insert_query) ;
    }

    public function Save_sms_info($save_sms_info){
      $this->db->insert('sms_info',$save_sms_info);
    }

    // save email information in email_info table
    public function Save_email_info($save_email_info){
      $this->db->insert('email_info',$save_email_info);
    }

    /*
    |------------------------------------------------
    |    get all appointment data form appointment_tbl
    |------------------------------------------------
    */
    public function get_appointment_list()
    {
		$result = $this->db->select("appointment_tbl.*,doctor_tbl.*,
                  patient_tbl.*,
                  venue_tbl.*,")
                  ->from('appointment_tbl')
                  ->join('patient_tbl', 'patient_tbl.patient_id = appointment_tbl.patient_id','left')
                  ->join('doctor_tbl', 'doctor_tbl.doctor_id = appointment_tbl.doctor_id','left')
                  ->join('venue_tbl', ' venue_tbl.venue_id = appointment_tbl.venue_id','left')
                  ->get()->result(); 
				  
        return $result;    
    }

	public function get_appointment_list_referral()
    {
		$result = $this->db->select("appointment_referral.*,appointment_tbl.*,doctor_tbl.*,
                  patient_tbl.*,
                  venue_tbl.*,")
                  ->from('appointment_referral')
				  ->join('appointment_tbl', 'appointment_tbl.appointment_id = appointment_referral.appointment_id','left')
                  ->join('patient_tbl', 'patient_tbl.patient_id = appointment_tbl.patient_id','left')
                  ->join('doctor_tbl', 'doctor_tbl.doctor_id = appointment_tbl.doctor_id','left')
                  ->join('venue_tbl', ' venue_tbl.venue_id = appointment_tbl.venue_id','left')
                  ->get()->result(); 
				  
        return $result;    
    }	

	public function get_appointment_list_by_id($id)    {

        $result = $this->db->select("appointment_tbl.*,doctor_tbl.*, 
		patient_tbl.*,                 
		venue_tbl.*,")               
		->from('appointment_tbl')			
		->where('doctor_tbl.doctor_id',$id)  
		->join('patient_tbl', 'patient_tbl.patient_id = appointment_tbl.patient_id','left')
		->join('doctor_tbl', 'doctor_tbl.doctor_id = appointment_tbl.doctor_id','left')
		->join('venue_tbl', ' venue_tbl.venue_id = appointment_tbl.venue_id','left')
		->get()->result();       
		
		return $result;       

	}
	
	public function get_appointment_list_by_id_referral($id)    {

        $result = $this->db->select("appointment_referral.*,appointment_tbl.*,doctor_tbl.*, 
		patient_tbl.*,                 
		venue_tbl.*,")               
		 ->from('appointment_referral')
		->where('appointment_referral.referral_to',$id)  
		->join('appointment_tbl', 'appointment_tbl.appointment_id = appointment_referral.appointment_id','left')
		->join('patient_tbl', 'patient_tbl.patient_id = appointment_tbl.patient_id','left')
		->join('doctor_tbl', 'doctor_tbl.doctor_id = appointment_tbl.doctor_id','left')
		->join('venue_tbl', ' venue_tbl.venue_id = appointment_tbl.venue_id','left')
		->get()->result();       
		
		return $result;       

	}

	public function check_appointment_referral($id){
		
		$SQL = "select * from appointment_referral where appointment_id = '".$id."'";
		$query = $this->db->query($SQL);
		$result = $query->result_array();	
		return $result;
	}

	public function SaveReferralAppointment($savedata)
    {
        $this->db->insert('appointment_referral',$savedata);
    }
	
	public function UpdateReferralAppointment($savedata,$id){
		
		$this->db->where('id', $id);
        
		$this->db->update('appointment_referral', $savedata);
	}
	
	public function getdoctordata($id){
		$doctor_name = '';
		$doc_email = '';
		$SQL = "select log_id,doctor_name from doctor_tbl where doctor_id = '".$id."'";
		$query = $this->db->query($SQL);
		$result = $query->result_array();
		if(is_array($result) && count($result)>0){
			$doctor_name = $result[0]['doctor_name'];
			$log_id = $result[0]['log_id'];
			$sql_log = "select email from log_info where log_id = '".$log_id."'";
			$query_log = $this->db->query($sql_log);
			$result_log = $query_log->result_array();
			if(is_array($result_log) && count($result_log)>0){
				$doc_email = $result_log[0]['email'];
			}
		}
		$data['doctor_name'] = $doctor_name;
		$data['doc_email'] = $doc_email;
		return $data;
	}
}    