<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_model {

    public function authenticet($email=NULL,$password=NULL,$type=NULL)
    {
        if($type==1){

            $query = $this->db->select('log_info.*,doctor_tbl.*')
                ->from('log_info')
                ->join('doctor_tbl', 'doctor_tbl.log_id = log_info.log_id','left')
                ->where('email', $email)
                ->where('password', MD5($password))
                ->where('user_type', 1)
                ->where('active_status','1')
                ->limit(1)
                ->get()->row();
           if($query!=NULL) {
                return $query;
                } else {
                    return false;
                }


        } elseif($type==2) {
            /** Case of assistant. */
            $query = $this->db->select('log_info.*,users_tbl.*')
            ->from('log_info')
            ->join('users_tbl', 'users_tbl.log_id = log_info.log_id','left')
            ->where('log_info.email', $email)
            ->where('log_info.password', MD5($password))
            ->where('user_type', 2)
            ->where('log_info.active_status','1')
            ->limit(1)
            ->get()->row();
           
            if($query!=NULL) {
                return $query;
            } else {
                return false;
            }
        }elseif($type==3) {
            $query = $this->db->select('log_info.*,patient_tbl.*')
            ->from('log_info')
            ->join('patient_tbl', 'patient_tbl.log_id = log_info.log_id','left')
            ->where('log_info.email', $email)
            ->where('log_info.password', MD5($password))
            ->where('user_type', 3)
            ->where('log_info.active_status','1')
            ->limit(1)
            ->get()->row();
           
            if($query!=NULL) {
                return $query;
            } else {
                return false;
            }
        }else{
            return false;
        }
             
        
    }

}       