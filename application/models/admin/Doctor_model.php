<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_model extends CI_model {

/*
|------------------------------------------------
|   get_doctor_info form doctor_tbl
|------------------------------------------------
*/
    public function get_doctor_info($doctor_id)
    {
        $doctor_id = $this->session->userdata('doctor_id');

        $query = $this->db->select('*')
        ->from('doctor_tbl')
        ->where('doctor_id',$doctor_id)
        ->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }		
	
	public function get_doctor_info2($doctor_id)    {

        $query = $this->db->select('*')->from('doctor_tbl')->where('doctor_id',$doctor_id)->get();        
		
		if ($query->num_rows() == 1) {

            return $query->row();        
			
		} else {

			return false;        
				
		}    
				
	}
				

/*
|------------------------------------------------
|    save_edit_dcotor_profile to doctor_tbl
|------------------------------------------------
*/
    public function save_edit_dcotor_profile($savedata,$doctor_id)
    {
        $this->db->where('doctor_id',$doctor_id)
        ->update('doctor_tbl',$savedata);
    }
	
	
	public function getDoctorDepartmentInfo()	 {	
	
	
	return	$this->db->select('*')->from('doctor_department_info')->get()->result();	 
	
	}

	public function getDoctorList()	 {

		$SQL = 'select a.* , b.department_name from doctor_tbl as a , doctor_department_info as b where a.department = b.department_id and a.doctor_id != "1" order by a.doctor_name ASC';				
		
		$query = $this->db->query($SQL);

		$result = $query->result_array();				
		
		return $result;	

	}

	public function getDoctorListByselect()	 {

		$SQL = 'select a.* , b.email from doctor_tbl as a , log_info as b where a.log_id = b.log_id and a.doctor_id != "1" and a.doctor_status = "1" order by a.doctor_name ASC';

		$query = $this->db->query($SQL);

		$result = $query->result_array();				
		
		return $result;

	}

	public function exists_doctor($user_phone,$birth_date)    {

        return $this->db->where('doctor_phone',$user_phone)->where('birth_date',$birth_date)->get('doctor_tbl')->num_rows();
		
	}
	
	public function getDoctorDepartmentByID($id){
		
		$SQL = "select * from doctor_department_info where department_id = '".$id."'";
		
		$query = $this->db->query($SQL);

		$result = $query->result_array();				
		
		return $result;
		
		
		
	}
	
	public function getDoctorListById($id)	 {

		$SQL = 'select a.* , b.email from doctor_tbl as a , log_info as b where a.log_id = b.log_id and a.doctor_id = "'.$id.'"';

		$query = $this->db->query($SQL);

		$result = $query->result_array();				
		
		return $result;

	}
	
	public function getDoctorlanguage(){
		
		$SQL = "select * from doctor_content where id = '2'";
		
		$query = $this->db->query($SQL);

		$result = $query->result_array();				
		$langArr = array();
		if(isset($result[0]['content']) && $result[0]['content'] != ""){
			$language = $result[0]['content'];
			$languageArr = explode(',',$language);
			foreach($languageArr as $val){
				$langArr[] = trim($val);
			}
		}
		return $langArr;
		
		
	}
	
}       