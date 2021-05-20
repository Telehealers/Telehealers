<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'../zoom/config.php';

class Welcome extends CI_Controller {
/*
|--------------------------------------
|   constructor funcion
|--------------------------------------
*/ 
	public function __construct() 
	{
		parent::__construct();
		$this->load->library('email');
		
		$info= $this->db->select('*')->from('web_pages_tbl')->where('name','website_on_off')->get()->row();
    
        if($info->details=='off'){
          redirect('login');
        }
        //Load Home_view_model
        $this->load->model('web/Home_view_model','home_view_model');
        // //Load Overview model
         $this->load->model('admin/Overview_model','overview_model');
        // //Load venue model
        // $this->load->model('admin/Venue_model','venue_model');
        // //load appointment model
        // $this->load->model('admin/Appointment_model','appointment_model');
        // //Load Basic model
  //       $this->load->model('admin/basic_model','basic_model');
  //       //Load Schedule model
  //       $this->load->model('admin/Schedule_model','schedule_model');
  //       //Load Patient model
         $this->load->model('admin/Patient_model','patient_model');
  //       // Load sms setup model
  //       $this->load->model('admin/Sms_setup_model','sms_setup_model');
		// // Load Doctor model
		// $this->load->model('admin/Doctor_model','doctor_model');
  //       //
  //       $this->load->library('Smsgateway');
		
        $this->load->model('admin/email/Email_model','email_model');
        $this->load->library('email');
  }



/*
|--------------------------------------
|   View home page in the website
|--------------------------------------
*/
	public function index($patient_id=NULL)
	{
		/* $ci = get_instance();
		$ci->load->library('email');
		$config['protocol'] = "tls";
		$config['smtp_host'] = "smtp-relay.sendinblue.com";
		$config['smtp_port'] = "587";
		$config['smtp_user'] = "ravi@wishtech.com.br"; 
		$config['smtp_pass'] = "UnW0wjEBALXxq4C5";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		$ci->email->initialize($config);
		$ci->email->from('raghuveer@ecomsolver.com', 'telehealers');
		$list = array('raghu10raj@gmail.com');
		$ci->email->to($list);
		$this->email->reply_to('raghuveer@ecomsolver.com', 'Explendid Videos');
		$ci->email->subject('This is an email test');
		$ci->email->message('It is working. Great!');
		if($ci->email->send()){
			echo "mail send...";
		}else{
			echo "mail not send...";
		} */

		

        //get_schedule_list
       // $data['schedule'] = $this->schedule_model->get_schedule_list();
        //setup information
        $data['info'] = $this->home_view_model->Home_satup();
        //get doctor_info
       // $data['doctor_info'] = $this->home_view_model->doctor_info();
        //load slider
        $data['slider'] = $this->home_view_model->Slider(); 
        //total_appointment
       // $data['total_appointment'] = $this->overview_model->total_appointment();
        //total_patient
       // $data['total_patient'] = $this->overview_model->total_patient();
        //to_day_appointment
        //$data['to_day_appointment'] = $this->overview_model->to_day_appointment();
        //to_day_get_appointment
        //$data['to_day_get_appointment'] = $this->overview_model->to_day_get_appointment();
        // testimonial
        $data['testimonial'] = $this->db->get('testimonial')->result();
		$data['faq'] = $this->db->get('faq')->result();
        $data['theraphists'] = $this->db->get('theraphists')->result();
        //echo "<pre>";print_r($data['theraphists']);die();
        $data['commitements'] = $this->db->get('commitements')->result();
        // Post
        $data['post'] = $this->home_view_model->get_all_post();
		//get venue list
        //$data['venue'] = $this->venue_model->get_venue_list();
		
		//$data['service'] = $this->db->get('service')->result();
		
		//get doctor list for appointmaent
		//$data['doctor_info_for_appo'] = $this->doctor_model->getDoctorListByselect();

		  $meta_sql = "select * from metadata where id = '1'";
		$res_meta = $this->db->query($meta_sql);
		$data['meta_info'] = $res_meta->result_array();
      

        #------view page----------
        $this->load->view('home',$data);
	}

/*
|--------------------------------------
|   patient id genaretor
|--------------------------------------
*/
  function randstrGen($mode=null,$len=null)
  {
        $result = "";
        if($mode == 1):
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 2):
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        elseif($mode == 3):
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 4):
        $chars = "0123456789";
        endif;
        $charArray = str_split($chars);
        for($i = 0; $i < $len; $i++) {
        $randItem = array_rand($charArray);
        $result .="".$charArray[$randItem];
        }
        return $result;
  }


#-----------------------------------------------
#    random coad genaretor of appointmaent id
#----------------------------------------------  
function randstrGenapp($len) 
{
    $result = "";
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    $charArray = str_split($chars);
    for($i = 0; $i < $len; $i++) {
            $randItem = array_rand($charArray);
            $result .="".$charArray[$randItem];
    }
    return $result;
}

/*
|--------------------------------------
|     view  print_appointment_info
|--------------------------------------
*/ 
    public function print_appointment_info()
    {
        $data['info'] = $this->home_view_model->Home_satup();
        $appointment_id = $this->session->userdata('appointment_id');

        $data['print'] = $this->basic_model->get_appointment_print_result($appointment_id);

    	
    		if($data){
             	 $this->load->view('public/patient_appointment_info',$data); 
            }else{
                redirect('Welcome');
            } 
    }
/*
|--------------------------------------
|     print registration save
|--------------------------------------
*/   

public function registration()
{
      $this->form_validation->set_rules('name', 'Name', 'trim|required');
      $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|min_length[6]|max_length[15]');
      $this->form_validation->set_rules('email', 'Email', 'required' );
      if ($this->form_validation->run()==true) {
         #------------------------------------------------#
          $exists_user = $this->patient_model->exists_user(
              $this->input->post('phone',true)); 
          if($exists_user == true){
            // user exists then show alert to login 
                echo 0 ;

                    }
          else{
            //create patient
            $create_date = date('Y-m-d h:i:s');
            $patient_id = "P".date('y').strtoupper($this->randstrGenapp(5));
            $log_id = $this->db->insert_id();
            $email=$this->input->post('email',true);
            $log_data = array(
                'email' => $email,
                'password' => '',
                'user_type' => '3'
            );  
            $this->db->insert('log_info', $log_data);   
            $log_id = $this->db->insert_id();   
            $savedata =  array(
            'patient_id'    => $patient_id,
            'log_id'    => $log_id,
            'patient_name' => $this->input->post('name',true),
            'patient_email' => $this->input->post('email',true),
            'patient_phone' => $this->input->post('phone',true), 
            'sex' => $this->input->post('gender',true),
            'create_date'=>$create_date
            );

            $savedata = $this->security->xss_clean($savedata); 
            $this->patient_model->save_patient($savedata);
            //redirect('Welcome');
            echo 1;
        }
    }
}

 function template($config1 = null){
        $newStr = $config1['message'];
        foreach ($config1 as $key => $value) {
            $newStr = str_replace("%$key%", $value, $newStr);
        } 
        return $newStr; 
    }
/*
|---------------------------------
| GET POST BY ID
|---------------------------------
*/
	public function post_by_id($id)
	{
		$result = $this->db->select('*')
        ->from('blog_tbl')
        ->where('id',$id)
        ->get()
        ->row();
		echo json_encode($result);
	}
/*
|---------------------------------
| GET SLIDER BY ID
|---------------------------------
*/
	public function slider_by_id($id)
	{
		$result = $this->db->select('*')
        ->from('slider')
        ->where('id',$id)
        ->get()
        ->row();
		echo json_encode($result);
	}
	
	public function contactEmail(){
		$ci = get_instance();
	    $ci->load->library('email');
		$config['protocol'] = "tls";
		$config['smtp_host'] = "inpro8.fcomet.com";
		$config['smtp_port'] = "465";
		$config['smtp_user'] = "info@telehealers.in"; 
		$config['smtp_pass'] = "Ajay@1234%";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		$ci->email->initialize($config);
		
		
		//echo "test...here...";die();
		$full_name = $this->input->post('full_name',TRUE);
		$email_id = $this->input->post('email_id',TRUE);
		$subject = $this->input->post('subject',TRUE);
		$message2 = $this->input->post('message',TRUE);
		//$full_name = 'raghuveer singh';
		//$to = $info->email->details;
		$to = 'info@telehealers.in';
		
		$message = '<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
    <center style="width: 100%; background-color: #f1f1f1;">
        <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
            &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <div style="max-width: 600px; margin: 0 auto;" class="email-container">
            <!-- BEGIN BODY -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tbody><tr>
                    <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody><tr>
                                <td class="logo" style="text-align: left;">
                                    <h1>
                                        <a href="https://telehealers.in/">
                                        <img src="https://telehealers.in/assets/uploads/images/telehe2.png">    
                                        </a>
                                    </h1>
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
                <tr>
                    </tr></tbody></table><table class="bg_white" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody><tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
                            <td valign="middle" width="100%" style="text-align:left; padding: 0 2.5em;">
                                <div class="product-entry">
                                    <div class="text">
                                        <h2 style="text-align:left;margin-top:30px;font-weight:600;color:#356d82">Contact Information:</h2>
                                        <p>Full Name: '.$full_name.'</p>
                                        <p>Email ID: '.$email_id.',</p>
										<p>Subject: '.$subject.',</p>
										<p>Message: '.$message2.',</p>
									</div>
                                </div>
                            </td>
                        </tr>
                    </tbody></table>
                
            
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tbody><tr>
                    <td class="bg_white" style="text-align: center;">
                        <p>Receive these email? You can <a href="#" style="color: rgba(0,0,0,.8);">Unsubscribe here</a></p>
                    </td>
                </tr>
            </tbody></table>

        </div>
    </center>


</body></html>';

			$ci->email->from('info@telehealers.in', 'telehealers');
			$list = array($email_id);
			$ci->email->to('telehealers@gmail.com');
			$this->email->reply_to('info@telehealers.in', 'telehealers');
			$ci->email->subject('Contact Us Information from telehealers.in');
			$ci->email->message($message);
			$ci->email->send();
			echo 'Your details has been submited successfully.';
		
	}
	
	public function getservicetype(){
		
		$services = $this->input->post('services',TRUE);
		$sql = "select id from service where title = '".$services."'";
		$res = $this->db->query($sql);
		$result = $res->result_array();
		if(is_array($result) && count($result)>0){
			$service_id = $result[0]['id'];
		}
		$con = '';
		if($service_id>0){
			$sql_st = "select * from servicetype where service = '".$service_id."'";
			$res_st = $this->db->query($sql_st);
			$result_st = $res_st->result_array();
			$i=0;
			if(is_array($result_st) && count($result_st)>0){
				foreach($result_st as $res){
					$i++;
					$service_id = $res['id'];
					$servicetype = $res['servicetype'];
					$doctors = $res['doctors'];
					if($i==1){
						$con .= '<li><button type="button" class="btn_choose_sent bg_btn_chose_1"><input type="radio" value="'.$servicetype.'" name="servicetype" checked="checked" />'.$servicetype.'</button></li>';
					}else{
						$con .= '<li><button type="button" class="btn_choose_sent bg_btn_chose_1"><input type="radio" value="'.$servicetype.'" name="servicetype" />'.$servicetype.'</button></li>';	
					}
					
				}
			}	
		}
		echo $con;
	}
	
	public function getservicetypedoctor(){
		
		$servicestype = $this->input->post('servicestype',TRUE);
		$sql = "select id,doctors from servicetype where title = '".$servicestype."'";
		$res = $this->db->query($sql);
		$result = $res->result_array();
		if(is_array($result) && count($result)>0){
			$service_id = $result[0]['id'];
			$doctors    = $result[0]['doctors'];
		}
		$con = '';
		if($service_id>0){
			$sql_st = "select * from servicetype where service = '".$service_id."'";
			$res_st = $this->db->query($sql_st);
			$result_st = $res_st->result_array();
			if(is_array($result_st) && count($result_st)>0){
				foreach($result_st as $res){
					$service_id = $res['id'];
					$servicetype = $res['servicetype'];
					$doctors = $res['doctors'];
					$con .= '<li><button type="button" class="btn_choose_sent bg_btn_chose_1"><input type="radio" name="servicetype" value="'.$servicetype.'" checked />'.$servicetype.'</button></li>';
				}
			}	
		}
		echo $con;
	}
	
	public function getdoctorforappointment(){
		$servicestype = $this->input->post('servicestype',TRUE);
		$lang_set_val = $this->input->post('lang_set_val',TRUE);
		$doctors='';
		//echo "lang_set_val--".$lang_set_val;die();
		$sql = "select id,doctors from servicetype where servicetype = '".$servicestype."'";
		$res = $this->db->query($sql);
		$result = $res->result_array();
		
		if(is_array($result) && count($result)>0){
			$service_id = $result[0]['id'];
			$doctors    = $result[0]['doctors'];
		}
		//echo "<pre>";print_r($doctors);die();
		$doctors_arr = explode(',',$doctors);
		$con = '<div class="row">';
		//echo "<pre>";print_r($doctors_arr);die();
		$i=0;
		$with_lng=array();
		$without_lng=array();
		//$doctors_arr=array(58);
		//echo "<pre>";
		if($lang_set_val!=""){
			$lang_set_arr_new = array();
			$lang_set_arr = explode(',',$lang_set_val);
			if(is_array($lang_set_arr) && count($lang_set_arr)>0){
				foreach($lang_set_arr as $val){
					$lang_set_arr_new[] = trim($val);
				}
			}
			//echo "<pre>";print_r($lang_set_arr);die();
			if(is_array($doctors_arr) && count($doctors_arr)>0){
				foreach($doctors_arr as $doc){
					$sql_ln = "select doc_id,language from doctor_tbl where doctor_id = '".$doc."'";
					//echo $sql_ln;
					$res_ln = $this->db->query($sql_ln);
					$result_ln = $res_ln->result_array();
					if(is_array($result_ln) && count($result_ln)>0){
						$language = $result_ln[0]['language'];
						if($language!=""){
							$language_arr = explode(',',$language);
							foreach($language_arr as $val){
								if(in_array(trim($val),$lang_set_arr_new)){
									$with_lng[] = $doc;
								}else{
									$without_lng[] = $doc;
								}
							}	
						}else{
							$without_lng[] = $doc;	
						}
					}	
				}
				$doctors_arr_2=array();
				//echo "<pre>";print_r($with_lng);die();
				foreach($with_lng as $val){
					$doctors_arr_2[] = $val;
				}
				foreach($without_lng as $val){
					$doctors_arr_2[] = $val;
				}
			}else{
				$doctors_arr_2=array();
				foreach($doctors_arr as $val){
					$doctors_arr_2[] = $val;
				}
			}
		}else{
			$doctors_arr_2=array();
			foreach($doctors_arr as $val){
				$doctors_arr_2[] = $val;
			}
		}
		//echo "<pre>";print_r($with_lng);
		$doctors_arr_2 = array_unique($doctors_arr_2);
		//echo "<pre>";print_r($doctors_arr_2);
		
		
		if(is_array($doctors_arr_2) && count($doctors_arr_2)>0){
			foreach($doctors_arr_2 as $doc){
				$i++;
				$sql_doc = "select doc_id,doctor_name,doc_id,language,degrees,picture from doctor_tbl where doctor_id = '".$doc."'";
				//echo $sql_doc;
				$res_doc = $this->db->query($sql_doc);
				$result_doc = $res_doc->result_array();
				if(is_array($result_doc) && count($result_doc)>0){
					$doc_id = $result_doc[0]['doc_id'];
					$doctor_name    = $result_doc[0]['doctor_name'];
					$doc_id    = $result_doc[0]['doc_id'];
					$language    = $result_doc[0]['language'];
					$picture    = $result_doc[0]['picture'];
					$degrees    = $result_doc[0]['degrees'];
					if($picture==""){
					    $picture = 'https://www.telehealers.in/web_assets2/images/user_img.png';
					}
					if($i==1){
						$con .= '<div class="col-md-6"><div class="doc_box"><span class="image_dr"><img src="'.$picture.'" alt="#"></span><span class="content"><h5> '.$doctor_name.' </h5><p>'.$language.'</p><div class="select_dr"><input type="radio" checked="checked" name="doctor_id" value="'.$doc.'">Take an Appointment</div></span></div></div>';
					}else{
						$con .= '<div class="col-md-6"><div class="doc_box"><span class="image_dr"><img src="'.$picture.'" alt="#"></span><span class="content"><h5> '.$doctor_name.' </h5><p>'.$language.'</p><div class="select_dr"><input type="radio" name="doctor_id" value="'.$doc.'">Take an Appointment</div></span></div></div>';
					}
					
				} 
			}
		}
		$con .= "</div>";
		echo $con;
	}
	
	public function getdoctorforappointment2(){
		$servicestype = $this->input->post('servicestype',TRUE);
		$lang_set_val = $this->input->post('lang_set_val',TRUE);
		//echo "lang_set_val--".$lang_set_val;die();
		$sql = "select id,doctors from servicetype where servicetype = '".$servicestype."'";
		$res = $this->db->query($sql);
		$result = $res->result_array();
		if(is_array($result) && count($result)>0){
			$service_id = $result[0]['id'];
			$doctors    = $result[0]['doctors'];
		}
		//echo "<pre>";print_r($doctors);die();
		$doctors_arr = explode(',',$doctors);
		$con = '<div class="row">';
		//echo "<pre>";print_r($doctors_arr);die();
		$i=0;
		$with_lng=array();
		$without_lng=array();
		//$doctors_arr=array(58);
		//echo "<pre>";
		if($lang_set_val!=""){
			$lang_set_arr = explode(',',$lang_set_val);
			//echo "<pre>";print_r($lang_set_arr);die();
			if(is_array($doctors_arr) && count($doctors_arr)>0){
				foreach($doctors_arr as $doc){
					$sql_ln = "select doc_id,language from doctor_tbl where doctor_id = '".$doc."'";
					//echo $sql_ln;
					$res_ln = $this->db->query($sql_ln);
					$result_ln = $res_ln->result_array();
					if(is_array($result_ln) && count($result_ln)>0){
						$language = $result_ln[0]['language'];
						if($language!=""){
							$language_arr = explode(',',$language);
							foreach($language_arr as $val){
								if(in_array(trim($val),$lang_set_arr)){
									$with_lng[] = $doc;
								}else{
									$without_lng[] = $doc;
								}
							}	
						}else{
							$without_lng[] = $doc;	
						}
					}	
				}
			}
			$doctors_arr_2=array();
			foreach($with_lng as $val){
				$doctors_arr_2[] = $val;
			}
			foreach($without_lng as $val){
				$doctors_arr_2[] = $val;
			}
		}else{
			$doctors_arr_2=array();
			foreach($doctors_arr as $val){
				$doctors_arr_2[] = $val;
			}
		}
		//echo "<pre>";print_r($with_lng);
		$doctors_arr_2 = array_unique($doctors_arr_2);
		//echo "<pre>";print_r($doctors_arr_2);
		
		
		if(is_array($doctors_arr_2) && count($doctors_arr_2)>0){
			foreach($doctors_arr_2 as $doc){
				$i++;
				$sql_doc = "select doc_id,doctor_name,doc_id,language,degrees,picture from doctor_tbl where doctor_id = '".$doc."'";
				//echo $sql_doc;
				$res_doc = $this->db->query($sql_doc);
				$result_doc = $res_doc->result_array();
				if(is_array($result_doc) && count($result_doc)>0){
					$doc_id = $result_doc[0]['doc_id'];
					$doctor_name    = $result_doc[0]['doctor_name'];
					$doc_id    = $result_doc[0]['doc_id'];
					$language    = $result_doc[0]['language'];
					$picture    = $result_doc[0]['picture'];
					$degrees    = $result_doc[0]['degrees'];
					if($picture==""){
					    $picture = 'https://www.telehealers.in/web_assets2/images/user_img.png';
					}
					if($i==1){
						$con .= '<div class="col-md-6"><div class="doc_box"><span class="image_dr"><img src="'.$picture.'" alt="#"></span><span class="content"><h5> '.$doctor_name.' </h5><p>&nbsp;</p><div class="select_dr"><input type="radio" checked="checked" name="doctor_id" value="'.$doc.'">Take an Appointment</div></span></div></div>';
					}else{
						$con .= '<div class="col-md-6"><div class="doc_box"><span class="image_dr"><img src="'.$picture.'" alt="#"></span><span class="content"><h5> '.$doctor_name.' </h5><p>&nbsp;</p><div class="select_dr"><input type="radio" name="doctor_id" value="'.$doc.'">Take an Appointment</div></span></div></div>';
					}
					
				} 
			}
		}
		$con .= "</div>";
		echo $con;
	}
	
	public function getPatientDetails(){
		$email = $this->input->post('email',TRUE);
		$sql = "select * from log_info where email = '".$email."'";
		$res = $this->db->query($sql);
		$result = $res->result_array();
		if(is_array($result) && count($result)>0){
			$log_id = $result[0]['log_id'];
			$user_type = $result[0]['user_type'];
			if($user_type==3){
			    $sql_pat = "select * from patient_tbl where log_id = '".$log_id."'";
    			$res_pat = $this->db->query($sql_pat);
    			$result_pat = $res_pat->result_array();
    			if(is_array($result_pat) && count($result_pat)>0){
    				$patient_name  = $result_pat[0]['patient_name'];
    				$patient_phone = $result_pat[0]['patient_phone'];
    				$sex   		   = $result_pat[0]['sex'];
    				$age    	   = $result_pat[0]['age'];
    			}
    			echo $patient_name.",".$patient_phone.",".$sex.",".$age;    
    		}
    		if($user_type==2){
    		    echo "2";    
    		}
    		if($user_type==1){
    		    echo "1";
    		}
				
		}else{
			echo "";
		}
		
	}
	
	public function getservicetypedoctorforimmde(){
		
		$servicestype = $this->input->post('servicestype',TRUE);
		$lang_set_val = $this->input->post('lang_set_val',TRUE);
		$sql = "select id,doctors from servicetype where servicetype = '".$servicestype."'";
		//echo "<pre>";print_r($lang_set_val);die(); 
		$res = $this->db->query($sql);
		$result = $res->result_array();
		
		$doctors='';
		if(is_array($result) && count($result)>0){
			$service_id = $result[0]['id'];
			$doctors    = $result[0]['doctors'];
		}
		$doctors_arr = explode(',',$doctors);
		//echo "<pre>";print_r($doctors_arr);die();
		$date	= date('d-m-Y');
		$timestamp = strtotime($date);
		$day1 = date('D', $timestamp); 
		$day = $this->hash_model->day_to_de($day1);
		$slot_arr =array();
		$with_lng=array();
		$without_lng=array();
		if($lang_set_val!=""){
			$lang_set_arr = explode(',',$lang_set_val);
			//echo "<pre>";print_r($lang_set_arr);die();
			if(is_array($doctors_arr) && count($doctors_arr)>0){
				foreach($doctors_arr as $doc){
					$sql_ln = "select doc_id,language from doctor_tbl where doctor_id = '".$doc."'";
					//echo $sql_ln;
					$res_ln = $this->db->query($sql_ln);
					$result_ln = $res_ln->result_array();
					if(is_array($result_ln) && count($result_ln)>0){
						$language = $result_ln[0]['language'];
						if($language!=""){
							$language_arr = explode(',',$language);
							foreach($language_arr as $val){
								if(in_array(trim($val),$lang_set_arr)){
									$with_lng[] = $doc;
								}else{
									$without_lng[] = $doc;
								}
							}	
						}else{
							$without_lng[] = $doc;	
						}
					}	
				}
			}
			$doctors_arr_2=array();
			foreach($with_lng as $val){
				$doctors_arr_2[] = $val;
			}
			foreach($without_lng as $val){
				$doctors_arr_2[] = $val;
			}
		}else{
			$doctors_arr_2=array();
			foreach($doctors_arr as $val){
				$doctors_arr_2[] = $val;
			}
		}
		//echo "<pre>".print_r($doctors_arr_2);die();
		//$doctors_arr=array(58);
		if(is_array($doctors_arr_2) && count($doctors_arr_2)>0){
			foreach($doctors_arr_2 as $doctor_id){
				//echo $day;
				$venue_id=3;
				//$doctor_id=14;
			
				$sql = "select * from schedul_setup_tbl where venue_id = '$venue_id' and doctor_id = '$doctor_id' and day = '".$day."'";
				//echo $sql;die();
				$res = $this->db->query($sql);
				$result_pat = $res->result_array();
				//echo "<pre>";print_r($result_pat);die();
				if(is_array($result_pat) && count($result_pat)>0){
					$start_time = $result_pat[0]['start_time'];
					$end_time = $result_pat[0]['end_time'];
					$schedul_id = $result_pat[0]['schedul_id'];
					$per_patient_time = $result_pat[0]['per_patient_time'];
					$start_time_f = strtotime($start_time);
					$end_time_f = strtotime($end_time);
					$total_m =  round(abs($end_time_f- $start_time_f) / 60,2);
					$slot_avi=array();
					for ($i = 1; $i <= $per_patient_time; $i++) {
						$m_time = $i-1;
						$time = ($m_time * $per_patient_time);
										   
						$date_f = date('Y-m-d',strtotime($date));							
						$patient_time =date('H:i', strtotime($start_time)+$time*60);
						$sql = "select * from appointment_tbl where venue_id = '$venue_id' and doctor_id = '$doctor_id' and date = '$date_f' and sequence = '$patient_time'"; 
						//echo $sql;	
						$res = $this->db->query($sql);
						$result_pat = $res->result_array();	
						//echo "<pre>";print_r($sql);die();
						if (is_array($result_pat) && count($result_pat)>0) {
							//echo '<button type="button" disabled class="btn '.$button_color.'">'.$patient_time.'</button>';
						} else {
							if(strtotime($patient_time)>=$start_time_f && strtotime($patient_time)<$end_time_f)
							$slot_avi[] = $patient_time;
						}
					}
					//echo "<pre>";print_r($slot_avi);die();
					if(is_array($slot_avi) && count($slot_avi)>0){
						date_default_timezone_set('Asia/Kolkata');
						$current_time = date('d-m-Y H:i');
						$current_time_f = date('H:i', strtotime($current_time));
						//$current_time_f = '14:14:00';
						$current_time_f_int = strtotime($current_time_f);
						//echo $current_time_f_int;
						foreach($slot_avi as $val){
							if(strtotime($val)>$current_time_f_int){
								//echo $val.",".$doctor_id;
								$slot_arr[] = array('doctor_id'=>$doctor_id,"slot"=>$val,"value"=>strtotime($val),'schedul_id'=>$schedul_id);
								break;
							}
						}
						//echo "<re>";print_r($slot_arr);	
					} 
				}else{
					echo ''; 	
				}
			}
			//shuffle($slot_arr);
			//echo "<pre>";print_r($slot_arr);
			if(is_array($slot_arr) && count($slot_arr)>0){
				echo $slot_arr[0]['doctor_id'].",".$slot_arr[0]['slot'].','.$slot_arr[0]['schedul_id'];	
			}else{
				echo '';
			}
			
		}else{
			echo ''; 	
		} 
	}
	
	public function getservicetypedoctorforimmde2(){
		
		$servicestype = $this->input->post('servicestype',TRUE);
		$lang_set_val = $this->input->post('lang_set_val',TRUE);
		$sql = "select id,doctors from servicetype where servicetype = '".$servicestype."'";
		//echo "<pre>";print_r($lang_set_val);die(); 
		$res = $this->db->query($sql);
		$result = $res->result_array();
		
		$doctors='';
		if(is_array($result) && count($result)>0){
			$service_id = $result[0]['id'];
			$doctors    = $result[0]['doctors'];
		}
		$doctors_arr = explode(',',$doctors);
		//echo "<pre>";print_r($doctors_arr);die();
		$date	= date('d-m-Y');
		$timestamp = strtotime($date);
		$day1 = date('D', $timestamp); 
		$day = $this->hash_model->day_to_de($day1);
		$slot_arr =array();
		$with_lng=array();
		$without_lng=array();
		if($lang_set_val!=""){
			$lang_set_arr = explode(',',$lang_set_val);
			//echo "<pre>";print_r($lang_set_arr);die();
			if(is_array($doctors_arr) && count($doctors_arr)>0){
				foreach($doctors_arr as $doc){
					$sql_ln = "select doc_id,language from doctor_tbl where doctor_id = '".$doc."'";
					//echo $sql_ln;
					$res_ln = $this->db->query($sql_ln);
					$result_ln = $res_ln->result_array();
					if(is_array($result_ln) && count($result_ln)>0){
						$language = $result_ln[0]['language'];
						if($language!=""){
							$language_arr = explode(',',$language);
							foreach($language_arr as $val){
								if(in_array(trim($val),$lang_set_arr)){
									$with_lng[] = $doc;
								}else{
									$without_lng[] = $doc;
								}
							}	
						}else{
							$without_lng[] = $doc;	
						}
					}	
				}
			}
			$doctors_arr_2=array();
			foreach($with_lng as $val){
				$doctors_arr_2[] = $val;
			}
			foreach($without_lng as $val){
				$doctors_arr_2[] = $val;
			}
		}else{
			$doctors_arr_2=array();
			foreach($doctors_arr as $val){
				$doctors_arr_2[] = $val;
			}
		}
		//echo "<pre>".print_r($doctors_arr_2);die();
		//$doctors_arr=array(58);
		if(is_array($doctors_arr_2) && count($doctors_arr_2)>0){
			foreach($doctors_arr_2 as $doctor_id){
				//echo $day;
				$venue_id=3;
				//$doctor_id=14;
			
				$sql = "select * from schedul_setup_tbl where venue_id = '$venue_id' and doctor_id = '$doctor_id' and day = '".$day."'";
				//echo $sql;die();
				$res = $this->db->query($sql);
				$result_pat = $res->result_array();
				//echo "<pre>";print_r($result_pat);die();
				if(is_array($result_pat) && count($result_pat)>0){
					$start_time = $result_pat[0]['start_time'];
					$end_time = $result_pat[0]['end_time'];
					$schedul_id = $result_pat[0]['schedul_id'];
					$per_patient_time = $result_pat[0]['per_patient_time'];
					$start_time_f = strtotime($start_time);
					$end_time_f = strtotime($end_time);
					$total_m =  round(abs($end_time_f- $start_time_f) / 60,2);
					$slot_avi=array();
					for ($i = 1; $i <= $per_patient_time; $i++) {
						$m_time = $i-1;
						$time = ($m_time * $per_patient_time);
										   
						$date_f = date('Y-m-d',strtotime($date));							
						$patient_time =date('H:i', strtotime($start_time)+$time*60);
						$sql = "select * from appointment_tbl where venue_id = '$venue_id' and doctor_id = '$doctor_id' and date = '$date_f' and sequence = '$patient_time'"; 
						//echo $sql;	
						$res = $this->db->query($sql);
						$result_pat = $res->result_array();	
						//echo "<pre>";print_r($sql);die();
						if (is_array($result_pat) && count($result_pat)>0) {
							//echo '<button type="button" disabled class="btn '.$button_color.'">'.$patient_time.'</button>';
						} else {
							if(strtotime($patient_time)>=$start_time_f && strtotime($patient_time)<$end_time_f)
							$slot_avi[] = $patient_time;
						}
					}
					//echo "<pre>";print_r($slot_avi);die();
					if(is_array($slot_avi) && count($slot_avi)>0){
						date_default_timezone_set('Asia/Kolkata');
						$current_time = date('d-m-Y H:i');
						$current_time_f = date('H:i', strtotime($current_time));
						//$current_time_f = '14:14:00';
						$current_time_f_int = strtotime($current_time_f);
						//echo $current_time_f_int;
						foreach($slot_avi as $val){
							if(strtotime($val)>$current_time_f_int){
								//echo $val.",".$doctor_id;
								$slot_arr[] = array('doctor_id'=>$doctor_id,"slot"=>$val,"value"=>strtotime($val),'schedul_id'=>$schedul_id);
								break;
							}
						}
						//echo "<re>";print_r($slot_arr);	
					} 
				}else{
					echo ''; 	
				}
			}
			//shuffle($slot_arr);
			//echo "<pre>";print_r($slot_arr);
			if(is_array($slot_arr) && count($slot_arr)>0){
				echo $slot_arr[0]['doctor_id'].",".$slot_arr[0]['slot'].','.$slot_arr[0]['schedul_id'];	
			}else{
				echo '';
			}
			
		}else{
			echo ''; 	
		} 
	}
	
	public function checkAppointment(){
		$p_email = $this->input->post('p_email',TRUE);
		$p_date = $this->input->post('p_date',TRUE);
		
		$patient_id = '';
		$sql = "select * from patient_tbl where patient_email = '$p_email' ";
		$res = $this->db->query($sql);
		$result = $res->result_array();
		if(is_array($result) && count($result)>0){
			$patient_id = $result[0]['patient_id'];
		}
		
		$check =  $this->appointment_model->Check_appointment($p_date,$patient_id);
		  
		if(!empty($check)){
			echo '1';
		}else{
			echo '0';
		}
		
	}
	
}
