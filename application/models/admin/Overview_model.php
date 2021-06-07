<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Overview_model extends CI_model {



#-----------------------------------
 	 public function email_list(){
 	 	return $data = $this->db->select('*')
 	 	->from('email_delivery')
 	 	->get()
 	 	->result();
 	 }
#----------------------------------
	public function total_sms(){
		
 	 	$cus_result = $this->db->select("*")
	 	 	->from('custom_sms_info')
	 	 	->get()
	 	 	->num_rows();
	 	$auto = $this->db->select("*")
	 	 	->from('sms_delivery')
	 	 	->get()
	 	 	->num_rows();
	 	 	return $total = $cus_result+$auto;
			
	}	

	public function today_sms(){
		$cus_result = $this->db->select("*")
	 	 	->from('custom_sms_info')
	 	 	->like('sms_date_time',date("Y-m-d"))
	 	 	->get()
	 	 	->num_rows();
	 	$auto = $this->db->select("*")
	 	 	->from('sms_delivery')
	 	 	->like('delivery_date_time',date("Y-m-d"))
	 	 	->get()
	 	 	->num_rows();
	 	return $total = $cus_result+$auto;
	}

	public function coustom_sms(){
		return $cus_result = $this->db->select("*")
	 	 	->from('custom_sms_info')
	 	 	->get()
	 	 	->result();
	 	
	}	

	public function auto_sms(){
		return $auto = $this->db->select("*")
	 	 	->from('sms_delivery')
	 	 	->get()
	 	 	->result();
	 	 	
	}	
#----------------------------------	

	#------------------------------------#
	# count all patient
	#------------------------------------#	
 	 public function total_patient()
 	 {
 	 	return	$this->db->count_all_results('patient_tbl');
 	 }
	 
	 public function total_patient_by_doc($user_id)
 	 {
 	 	$result = $this->db->select("*")
	 	 	->from('patient_tbl')
	 	 	->where('doctor_id', $user_id)
	 	 	->get()->num_rows();
			return $result; 
 	 }

 	 #--- get last 30 day patient 
 	 public function patient_30_day(){
 	 	$result = $this->db->select("*")
	 	 	->from('patient_tbl')
	 	 	->where('create_date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()')
	 	 	->get()->num_rows();
			return $result; 
 	 }
 	 #--- get last 15 day patient 
 	 public function patient_15_day(){
 	 	$result = $this->db->select("*")
	 	 	->from('patient_tbl')
	 	 	->where('create_date BETWEEN DATE_SUB(NOW(), INTERVAL 15 DAY) AND NOW()')
	 	 	->get()->num_rows();
			return $result; 
 	 }
 	 #--- get last 7 day patient
 	 public function patient_7_day(){
 	 	$result = $this->db->select("*")
	 	 	->from('patient_tbl')
	 	 	->where('create_date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()')
	 	 	->get()->num_rows();
			return $result; 
 	 }

 	 #--- today patient
 	 public function today_patient(){
 	 	$date = date("Y-m-d");
 	 	$result = $this->db->select("*")
	 	 	->from('patient_tbl')
	 	 	->like('create_date',$date)
	 	 	->get()
	 	 	->result();

			return $result; 
 	 }
	 
	 public function today_patient_by_doc($doctor_id){
 	 	$date = date("Y-m-d");
 	 	$result = $this->db->select("*")
	 	 	->from('patient_tbl')
			->where('doctor_id',$doctor_id)
	 	 	->like('create_date',$date)
	 	 	->get()
	 	 	->result();

			return $result; 
 	 }

#-----------------------------------------------
 	 #--- today prescription 
 	 public function today_prescription(){
 	 	$date = date("Y-m-d");
		$this->db->select("prescription.*,patient_tbl.*");
        $this->db->from("prescription");
        $this->db->join('patient_tbl', 'patient_tbl.patient_id = prescription.patient_id','left'); 
        $this->db->where('prescription.doctor_id',$this->session->userdata('doctor_id'));
        $this->db->like('prescription.create_date_time',$date);
        $query = $this->db->get();
        $result = $query->result();
        return $result;	
			
 	 }
	 
	  public function today_prescription_doc_id($doctor_id){
 	 	$date = date("Y-m-d");
		$this->db->select("prescription.*,patient_tbl.*");
        $this->db->from("prescription");
        $this->db->join('patient_tbl', 'patient_tbl.patient_id = prescription.patient_id','left'); 
        $this->db->where('prescription.doctor_id',$this->session->userdata('doctor_id'));
        $this->db->like('prescription.create_date_time',$date);
        $query = $this->db->get();
        $result = $query->result();
        return $result;	
			
 	 }

 	 #--- total prescription 
 	 public function total_prescription(){
 	 	$date = date("Y-m-d");
 	 	$result = $this->db->select("*")
	 	 	->from('prescription')
	 	 	->get()->num_rows();
			return $result; 
 	 }
	 
	  public function total_prescription_doc_id($doctor_id_){
 	 	$date = date("Y-m-d");
 	 	$result = $this->db->select("*")
	 	 	->from('prescription')
			->where('doctor_id',$doctor_id_)
	 	 	->get()->num_rows();
			return $result; 
 	 }
#---------------------------------------------


 	 public function total_appointment()
 	 {
	 	 	$result = $this->db->select("*")
	 	 	->from('appointment_tbl')
	 	 	->get()->num_rows();
			return $result;
 	 }	public function total_appointment_by_id($id) 	 {	 	 	$result = $this->db->select("*")	 	 	->from('appointment_tbl')						->where('doctor_id',$id)	 	 	->get()->num_rows();			return $result; 	 }
#------------------------------------#
# count to_day_appointment
#------------------------------------#	
 	public function to_day_appointment()
 	{
	 	    $tow_day = date('Y-m-d');
			
              $result = $this->db->select("action_serial.*,doctor_tbl.*,
                  patient_tbl.*,
                  venue_tbl.*,")

                  ->from('action_serial')

                  ->join('patient_tbl', 'patient_tbl.patient_id = action_serial.patient_id','left')
                  
                  ->join('doctor_tbl', 'doctor_tbl.doctor_id = action_serial.doctor_id','left')
                  
                  ->join('venue_tbl', ' venue_tbl.venue_id = action_serial.venue_id','left')
                  ->where('action_serial.date',$tow_day)
                  ->get()
                  ->result();
          return $result; 
 	}		
	/** A function to return appointment scheduled today.*/
	public function to_day_appointment_by_id($id) {
		$today = date('Y-m-d');
		$query = "SELECT apt.*, doc.*, patient.*, venue.* FROM appointment_tbl apt, ".
		"doctor_tbl doc, patient_tbl patient, venue_tbl venue WHERE ".
		"venue.venue_id = apt.venue_id AND doc.doctor_id = apt.doctor_id AND".
		" patient.patient_id = apt.patient_id AND apt.doctor_id = ".
		$id." AND apt.date = '".$today."'";
		return $this->db->query($query)->result();
	}



#------------------------------------#
# count to_day_get_appointment
#------------------------------------#	
 	 public function to_day_get_appointment()
 	 {
		$today = date('Y-m-d');
		$query = "SELECT apt.*, doc.*, patient.*, venue.*, sched.* FROM appointment_tbl apt, ".
		"doctor_tbl doc, patient_tbl patient, venue_tbl venue, schedul_setup_tbl sched WHERE ".
		"venue.venue_id = apt.venue_id AND doc.doctor_id = apt.doctor_id AND sched.schedul_id = apt.schedul_id AND ".
		" patient.patient_id = apt.patient_id ".
		" AND CAST(apt.get_date_time AS DATE) = '"."$today"."'";
		return $this->db->query($query)->result();
 	 }	 

	/** Get appointments booked today for doctor_id = $id */
	public function to_day_get_appointment_by_id($id) 	 { 
		$today = date('Y-m-d');
		$query = "SELECT apt.*, doc.*, patient.*, venue.*, sched.* FROM appointment_tbl apt, ".
			"doctor_tbl doc, patient_tbl patient, venue_tbl venue, schedul_setup_tbl sched WHERE ".
			"venue.venue_id = apt.venue_id AND doc.doctor_id = apt.doctor_id AND sched.schedul_id = apt.schedul_id AND ".
			" patient.patient_id = apt.patient_id AND apt.doctor_id = ".
			$id." AND CAST(apt.get_date_time AS DATE) = '"."$today"."'";
		return $this->db->query($query)->result();
	}

#-------------------------------------
 	 public function last_30(){
 	 	$result = $this->db->select("*")
	 	 	->from('appointment_tbl')
	 	 	->where('date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()')
	 	 	->get()->num_rows();
			return $result; 
 	    }

 	 public function last_15(){
 	 	$result = $this->db->select("*")
	 	 	->from('appointment_tbl')
	 	 	->where('date BETWEEN DATE_SUB(NOW(), INTERVAL 15 DAY) AND NOW()')
	 	 	->get()->num_rows();
			return $result; 
 	    } 

 	 public function last_7(){
 	 	$result = $this->db->select("*")
	 	 	->from('appointment_tbl')
	 	 	->where('date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()')
	 	 	->get()->num_rows();
			return $result; 
 	    }       



} 	 