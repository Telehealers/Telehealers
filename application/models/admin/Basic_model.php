<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Basic_model extends CI_model {

#----------------------------------------
#       patient appointment print info
#----------------------------------------
    public function get_appointment_print_result($appointment_id)
    {
        
       $query_result = $this->db->select("action_serial.*,
            patient_tbl.*,
            venue_tbl.*,doctor_tbl.doctor_name,doctor_tbl.department,doctor_department_info.department_name")
              ->from('action_serial')
              ->join('patient_tbl', 'patient_tbl.patient_id = action_serial.patient_id','left')
              ->join('doctor_tbl', 'doctor_tbl.doctor_id = action_serial.doctor_id','left')			                ->join('doctor_department_info', 'doctor_tbl.department = doctor_department_info.department_id','left')
              ->join('venue_tbl', ' venue_tbl.venue_id = action_serial.venue_id','left')
              ->where('action_serial.appointment_id',$appointment_id)
              ->get()->row();

       return $query_result;
         
    }

    
}       