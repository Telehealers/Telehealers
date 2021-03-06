<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Schedule_model extends CI_model {
/*
|--------------------------------------------------------------
|  Schedule data save to schedul_setup_tbl
|--------------------------------------------------------------
*/

 	 public function insert_schedule($savedata)
     {
	 	 $this->db->insert('schedul_setup_tbl', $savedata);
 	 }

/*
|--------------------------------------------------------------
|   Get all Schedule data 
|--------------------------------------------------------------
*/
    public function get_schedule_list()
    {
        $query = $this->db->select('schedul_setup_tbl.*,venue_tbl.*')
            ->from('schedul_setup_tbl')
            ->join('venue_tbl','venue_tbl.venue_id=schedul_setup_tbl.venue_id','left')
            ->where('schedul_setup_tbl.visibility','1')
            ->get();
             if($query->num_rows()>0){
                    return $query->result();
             }else{
                    return false;
            }
    }
	
	public function get_schedule_list_by_doc_id($doctor_id)
    {
        $query = $this->db->select('schedul_setup_tbl.*,venue_tbl.*')
            ->from('schedul_setup_tbl')
            ->join('venue_tbl','venue_tbl.venue_id=schedul_setup_tbl.venue_id','left')
            ->where('schedul_setup_tbl.visibility','1')
			->where('schedul_setup_tbl.doctor_id',$doctor_id)
            ->get();
             if($query->num_rows()>0){
                    return $query->result();
             }else{
                    return false;
            }
    }

/*
|--------------------------------------------------------------
|    Get indevidule Schedule data 
|--------------------------------------------------------------
*/
 	public function get_inde_schedul_list($s_id)
    {
        return $query = $this->db->select('*')
            ->from('schedul_setup_tbl')
            ->where('schedul_id',$s_id)
            ->get()->row();
                 
 	}



/*
|--------------------------------------------------------------
|       Save edit Schedule data  schedul_setup_tbl
|--------------------------------------------------------------
*/
 	 public function save_edit_schedul($savedata,$s_id)
     {
 	 	$this->db->where('schedul_id',$s_id);
        $this->db->update('schedul_setup_tbl',$savedata);
 	 }

}