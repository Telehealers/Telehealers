<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment_model extends CI_model {


    public function Check_appointment($date=NULL,$patient=NULL){
      
       return $result = $this->db->select('*')
        ->from('appointment_tbl')
        ->where('date',$date)
        ->where('patient_id',$patient)
        ->get()->result();
    }

    /* Get available doctors
      input query_parameters {Object}: Includes booking_time ({sql datetime}, 
        sample:"YYYY-MM-DD Hr:Min:Sec" e.g. "2021-05-25 10:00:32"), 
        preferred_languages(array of languages, e.g. array("English", "Hindi")).
      returns: db->query("..."), containing doctors available according 
        to query_parameters ordered randomly with preferred language
        docs on top. 
        NOTE: rows with bias_reduction < 0, are rows with other languages.
        REMARKS: We can also add bias which sort rows according to preferred,
          common and other languages.
    */
    public function GetAvailableDoctors($query_parameters) {
      $language_filter = '';
      foreach($query_parameters->preferred_languages as $language) {
        if ($language_filter == '') {
          $language_filter = '(language LIKE "%'.$language.'%")';
        } else {
          $language_filter = ' + (language LIKE "%'.$language.'%")';
        }
      }
      $booking_time = $query_parameters->booking_time;
      return $this->db->query(
        'SELECT *, '.
        '(IF('.$language_filter.', RAND(), -RAND())) as bias_reduction_score '. //Doctor selection bias reduction logic
        'FROM doctor_tbl WHERE doctor_id IN ('.
        'SELECT sched.doctor_id FROM schedul_setup_tbl sched WHERE '.
        'sched.day = DAYOFWEEK('.$booking_time.') AND CAST(sched.start_time AS TIME) <= "'.
        $booking_time.'" AND CAST(sched.end_time AS TIME) >= ADDTIME("'.
        $booking_time.'", SEC_TO_TIME(sched.per_patient_time * 60))) AND '.
        'doctor_id NOT IN (SELECT bookings.doctor_id FROM '.
        'appointment_tbl bookings, doctor_tbl as docs, schedul_setup_tbl schedule '.
        'WHERE bookings.doctor_id = docs.doctor_id AND '.
        'schedule.doctor_id = bookings.doctor_id AND '.
        'bookings.get_date_time <=  "'.$booking_time.'" AND "'.$booking_time.
        '" <= ADDTIME(bookings.get_date_time, SEC_TO_TIME(schedule.per_patient_time*60))) '.
        'ORDER BY bias_reduction_score;');
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
		
		return $result;        }



}    