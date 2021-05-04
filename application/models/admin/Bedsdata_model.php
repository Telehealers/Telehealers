<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bedsdata_model extends CI_model {



/*
|------------------------------------------------
|    save  data to resource_tbl
|------------------------------------------------
*/
    public function save_new_post($savedata)
    {
        $this->db->insert('beds_data',$savedata);
    }

/*
|------------------------------------------------
|    get all post data form resource_tbl
|------------------------------------------------
*/
    public function get_all_post()
    {
         $result = $this->db->select('*')
              ->from('beds_data')
              ->get()
              ->result(); 
          return $result;    
    }

    public function get_post_by_id($id)
    {
      return $resutl = $this->db->select('*')->from('beds_data')->where('id',$id)->get()->row();
    }

    public function save_update_post($savedata,$id)
    {
      $this->db->where('id',$id)->update('beds_data',$savedata);
    }

}    