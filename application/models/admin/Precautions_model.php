<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Precautions_model extends CI_model {



/*
|------------------------------------------------
|    save  data to resource_tbl
|------------------------------------------------
*/
    public function save_new_post($savedata)
    {
        $this->db->insert('precautions_tbl',$savedata);
    }

/*
|------------------------------------------------
|    get all post data form resource_tbl
|------------------------------------------------
*/
    public function get_all_post()
    {
         $result = $this->db->select('*')
              ->from('precautions_tbl')
              ->get()
              ->result(); 
          return $result;    
    }

    public function get_post_by_id($id)
    {
      return $resutl = $this->db->select('*')->from('precautions_tbl')->where('id',$id)->get()->row();
    }

    public function save_update_post($savedata,$id)
    {
      $this->db->where('id',$id)->update('precautions_tbl',$savedata);
    }

}    