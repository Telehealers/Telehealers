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
    
    /*
    |------------------------------------------------
    |    save appointment data to appointment_tbl
    |------------------------------------------------
    */
    public function SaveAppoin($savedata)
    {
        $this->db->insert('appointment_tbl',$savedata);
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