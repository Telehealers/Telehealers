<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_model extends CI_model {

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
|------------------------------------------------
*/
public function save_patient($savedata)
{
      $this->db->insert('patient_tbl', $savedata);
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

public function get_by_id_patient($id){
	$query = $this->db->select('*')
      ->from("patient_tbl")
	  ->where('doctor_id',$id)
      ->get();
    $result = $query->result();
	$sql = "select a.* from patient_tbl as a, appointment_tbl as b where b.doctor_id = '$id' and b.patient_id = a. patient_id";
	$res = $this->db->query($sql);
	//$result = $res->result_array();
	$result = $query->result();
	//echo $sql;die();
    return $result;
}

public function get_referral_patient($id){
	$query = $this->db->select('*')
      ->from("patient_tbl")
	  ->where('ref_doc_id',$id)
      ->get();
      $result = $query->result();
      return $result;
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
 
 

}     