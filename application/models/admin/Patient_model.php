<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_model extends CI_model {
    public function __construct() 
	{
		parent::__construct();
		$this->load->model('admin/Appointment_model','appointment_model');
	}
/*
|------------------------------------------------
|   chack user exist or not
|------------------------------------------------
*/
public function exists_user($patient_phone)
{
    return $this->db->where('patient_phone',$patient_phone)
    ->get('patient_tbl')
    ->num_rows();
}   

/*
|------------------------------------------------
|  save patient to patient_tbl
|  & updates doctor_patient_map
|------------------------------------------------
*/
public function save_patient($savedata)
{
    $insertSuccess = $this->db->insert('patient_tbl', $savedata);
    /** Make entry in doctor-patient-map */
    if ($insertSuccess) {
        $this->appointment_model->insertPatientDoctorMap(
            $savedata['patient_id'],$savedata['doctor_id']);
    }
}

/*
|------------------------------------------------
|  get_all_patient form patient_tbl
|------------------------------------------------
*/
 public function get_all_patient()
 {
      $query = $this->db->select('*')
      ->from("patient_tbl")
      ->get();
      $result = $query->result();
      return $result;
 }

/** Get patient ID from doctor_id($id).
*/
public function get_by_id_patient($id) {
    $query = "SELECT * FROM patient_tbl patients, doctor_patient_map dpm WHERE ".
        "  dpm.patient_id = patients.patient_id AND dpm.doctor_id = ".$id.
        " AND dpm.referee = 0" ;
    return $this->db->query($query)->result();
}

public function get_referral_patient($id){
    $query = "SELECT * FROM patient_tbl patients, doctor_patient_map dpm WHERE ".
        "  dpm.patient_id = patients.patient_id AND dpm.doctor_id = ".$id.
        " AND dpm.referee != 0" ;
    return $this->db->query($query)->result();
}
/*
|------------------------------------------------
|  get_patient_indevidual_info form patient_tbl
|------------------------------------------------
*/
public function get_patient_inde_info($patient_id)
{
  
        $query = $this->db->select("*")
       ->from("patient_tbl")
       ->where("patient_id",$patient_id)
       ->get();
       $result = $query->row();
        return $result;
 }

/*
|------------------------------------------------
|  save_edit_patient to patient_tbl
|------------------------------------------------
*/
 public function save_edit_patient($savedata,$patient_id)
 {
      $this->db->where('patient_id',$patient_id);
      $this->db->update('patient_tbl',$savedata);
 }

 public function get_patient_doc_info($patient_id){	

	$SQL = 'select * from patient_doc_tbl where patient_id = "'.$patient_id.'"';

	$query = $this->db->query($SQL);	

	$result = $query->result_array();	

	return $result;	  

 }
 
 
 public function get_patient_doc_info_by_doctor_id($patient_id, $doctor_id){	

	$SQL = 'select * from patient_doc_tbl where patient_id = "'.$patient_id.'" and doctor_id = "'.$doctor_id.'"';

	$query = $this->db->query($SQL);	

	$result = $query->result_array();	

	return $result;	  

 }
 
 
 public function 
 
 save_patient_doc($savedata){ 

 $this->db->insert('patient_doc_tbl', $savedata);
 
 }

 /** A Function to send patient docs to new doctor 
  * NOTE: All existing doctors will have their copy.
  * TODO: Take decision on wether to remove or add new rows.
 */
 public function transfer_patient_doc_to_new_doctor($patient_id, $referee_doctor, $referred_doctor) {
    $transfer_query = "INSERT INTO patient_doc_tbl SELECT ".
    "patient_doc_id, patient_id, ".$referred_doctor." as doctor_id,document, add_date".
    " FROM patient_doc_tbl WHERE patient_id = '".$patient_id."' ".
    " AND doctor_id = ".$referee_doctor ;
    return $this->db->query($transfer_query);
 }
 
 

}     