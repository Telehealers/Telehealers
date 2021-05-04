<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Web_setup_controller extends CI_Controller {

/*
|--------------------------------------
|   constructor funcion
|--------------------------------------
*/ 
	public function __construct() 
	{
		parent::__construct();
		$this->load->library('session');
		 $session_id = $this->session->userdata('session_id'); 
	    if($session_id == NULL ){
	     redirect('logout');
	    }
	   $this->load->model('admin/Web_setup_model','web_setup_model');
     $this->load->model('web/Home_view_model','home_view_model');
	}


#------------------------------------------------
#       header setup
#------------------------------------------------
	public function header_setting()
	{
        $data['info'] = $this->home_view_model->Home_satup();
		//echo "<pre>";print_r($data);die();
		$this->load->view('admin/_header',$data);
		$this->load->view('admin/_left_sideber');
		$this->load->view('admin/websetting/view_header_setup');
		$this->load->view('admin/_footer');
	}



#------------------------------------------------
#       header update or insert
#------------------------------------------------
  public function save_header(){

    #-----------------------------------------#
    $data1 = array('name' => 'phone',
                  'details' => $this->input->post('phone',TRUE) 
                  );
    $checkDeata1 = $this->web_setup_model->checkPreview('phone');
    if(!empty($checkDeata1)){
       $this->db->where('name','phone')
        ->update('web_pages_tbl',$data1);
    } else {
      $this->db->insert('web_pages_tbl',$data1);
    }

    #-----------------------------------------#
    //checkPreview email 
    #-----------------------------------------#  
    $checkDeata2 = $this->web_setup_model->checkPreview('email');
    $data2 = array('name' => 'email',
                  'details' => $this->input->post('email',TRUE) 
                  );
    if(!empty($checkDeata2)){
       $this->db->where('name','email')
        ->update('web_pages_tbl',$data2);
    } else {
      $this->db->insert('web_pages_tbl',$data2);
    }

    #-----------------------------------------# 
    //checkPreview facebook  
    #-----------------------------------------#
    $checkDeata3 = $this->web_setup_model->checkPreview('facebook');
    $data3 = array('name' => 'facebook',
                  'details' => $this->input->post('facebook',TRUE) 
                  );
    if(!empty($checkDeata3)){
       $this->db->where('name','facebook')
        ->update('web_pages_tbl',$data3);
    } else {
      $this->db->insert('web_pages_tbl',$data3);
    }
    #-----------------------------------------#
    //checkPreview twitter
    #-----------------------------------------#
    $checkDeata4 = $this->web_setup_model->checkPreview('twitter');
    $data4 = array('name' => 'twitter',
                  'details' => $this->input->post('twitter',TRUE) 
                  );
    if(!empty($checkDeata4)){
       $this->db->where('name','twitter')
        ->update('web_pages_tbl',$data4);
    } else {
      $this->db->insert('web_pages_tbl',$data4);
    }
    #-----------------------------------------#
    //checkPreview linkedin
    #-----------------------------------------#
    $checkDeata5 = $this->web_setup_model->checkPreview('linkedin');
    $data5 = array('name' => 'linkedin',
                  'details' => $this->input->post('linkedin',TRUE) 
                  );
    if(!empty($checkDeata5)){
       $this->db->where('name','linkedin')
        ->update('web_pages_tbl',$data5);
    } else {
      $this->db->insert('web_pages_tbl',$data5);
    }
    #-----------------------------------------#
    //checkPreview youtube
    #-----------------------------------------#
    $checkDeata6 = $this->web_setup_model->checkPreview('youtube');
    $data6 = array('name' => 'youtube',
                  'details' => $this->input->post('youtube',TRUE) 
                  );

    if(!empty($checkDeata6)){
       $this->db->where('name','youtube')
        ->update('web_pages_tbl',$data6);
    } else {
      $this->db->insert('web_pages_tbl',$data6);
    }

    #-----------------------------------------#
    //checkPreview google
    #-----------------------------------------#
    $checkDeata7 = $this->web_setup_model->checkPreview('google');
    $data7 = array('name' => 'google',
                  'details' => $this->input->post('google',TRUE) 
                  );
    if(!empty($checkDeata7)){
       $this->db->where('name','google')
        ->update('web_pages_tbl',$data7);
    } else {
      $this->db->insert('web_pages_tbl',$data7);
    }
    #-----------------------------------------#
    //checkPreview hotline
    #-----------------------------------------#
    $checkDeata8 = $this->web_setup_model->checkPreview('hotline');
    $data8 = array('name' => 'hotline',
                  'details' => $this->input->post('hotline',TRUE) 
                  );
    if(!empty($checkDeata8)){
       $this->db->where('name','hotline')
        ->update('web_pages_tbl',$data8);
    } else {
      $this->db->insert('web_pages_tbl',$data8);
    }
    #-----------------------------------------#
          //checkPreview working_des
    #-----------------------------------------#
    $checkDeata10 = $this->web_setup_model->checkPreview('working_des');
    $data10 = array('name' => 'working_des',
                  'details' => $this->input->post('working_des',TRUE) 
                  );
    if(!empty($checkDeata10)){
       $this->db->where('name','working_des')
        ->update('web_pages_tbl',$data10);
    } else {
      $this->db->insert('web_pages_tbl',$data10);
    }

    #-----------------------------------------#
    #-----------------------------------------#
          // get picture data
          if (@$_FILES['picture']['name']){
              $config['upload_path']   = './assets/uploads/images/';
              $config['allowed_types'] = 'gif|jpg|jpeg|png';
              $config['overwrite']     = false;
              $config['max_size']      = 1024;
              $config['remove_spaces'] = true;
              $config['max_filename']   = 10;
              $config['file_ext_tolower'] = true;
              $this->load->library('upload', $config);
              if (!$this->upload->do_upload('picture')){
                  $this->session->set_flashdata('exception',"<div class='alert alert-danger msg'>".display('image_upload_msg')."</div>");
              redirect('admin/Web_setup_controller/header_setting');
              } else {
              $data = $this->upload->data();
              $image = base_url($config['upload_path'].$data['file_name']);
              }
            } else {
              $image = $this->input->post('pic',TRUE);
            }

      //checkPreview logo
      $checkDeata9 = $this->web_setup_model->checkPreview('logo');
      $data9 = array('name' => 'logo',
                  'picture' => $image 
                  );
      if(!empty($checkDeata7)){
        $this->db->where('name','logo')
          ->update('web_pages_tbl',$data9);
      } else {
          $this->db->insert('web_pages_tbl',$data9);
      }

    #-----------------------------------------#
      //appointment picture
    #-----------------------------------------#
          // get picture data
          if (@$_FILES['app_img']['name']){
              $config['upload_path']   = './assets/uploads/images/';
              $config['allowed_types'] = 'gif|jpg|jpeg|png';
              $config['overwrite']     = false;
              $config['max_size']      = 1024;
              $config['remove_spaces'] = true;
              $config['max_filename']   = 10;
              $config['file_ext_tolower'] = true;
              $this->load->library('upload', $config);
              if (!$this->upload->do_upload('app_img')){
                  $this->session->set_flashdata('exception',"<div class='alert alert-danger msg'>".display('image_upload_msg')."</div>");
              redirect('admin/Web_setup_controller/header_setting');
              } else {
              $data = $this->upload->data();
              $image = base_url($config['upload_path'].$data['file_name']);
              }
            } else {
              $image = $this->input->post('app_pic',TRUE);
            }
      
      //checkPreview app_image
      $checkDeata12 = $this->web_setup_model->checkPreview('app_image');
      $data12 = array('name' => 'app_image',
                  'picture' => $image 
                  );

      if(!empty($checkDeata12)){
        $this->db->where('name','app_image')
          ->update('web_pages_tbl',$data12);
      } else {
          $this->db->insert('web_pages_tbl',$data12);
      }

    #-----------------------------------------#
      //about picture
    #-----------------------------------------#
          // get picture data
          if (@$_FILES['about_img']['name']){
              $config['upload_path']   = './assets/uploads/images/';
              $config['allowed_types'] = 'gif|jpg|jpeg|png';
              $config['overwrite']     = false;
              $config['max_size']      = 1024;
              $config['remove_spaces'] = true;
              $config['max_filename']   = 10;
              $config['file_ext_tolower'] = true;

              $this->load->library('upload', $config);

              if (!$this->upload->do_upload('about_img')){
              $this->session->set_flashdata('exception',"<div class='alert alert-danger msg'>".display('image_upload_msg')."</div>");
              redirect('admin/Web_setup_controller/header_setting');
              } else {
              $data = $this->upload->data();
              $image = base_url($config['upload_path'].$data['file_name']);
              }
            } else {
              $image = $this->input->post('about_pic',TRUE);
            }
         
      //checkPreview about_img
      $checkDeata12 = $this->web_setup_model->checkPreview('about_img');    
      $data12 = array('name' => 'about_img',
                  'picture' => $image 
                );

      if(!empty($checkDeata12)){
        $this->db->where('name','about_img')
          ->update('web_pages_tbl',$data12);
      } else {
          $this->db->insert('web_pages_tbl',$data12);
      }

      //checkPreview google_map
      $checkDeata14 = $this->web_setup_model->checkPreview('google_map');
      $data14 = array('name' => 'google_map',
                  'details' => $this->input->post('google_map',FALSE)
                  );

      if(!empty($checkDeata14)){
        $this->db->where('name','google_map')
          ->update('web_pages_tbl',$data14);
      } else {
          $this->db->insert('web_pages_tbl',$data14);
      }


      //checkPreview total_appointment_details
      $checkDeata15 = $this->web_setup_model->checkPreview('total_appointment_details');   
      $data15 = array('name' => 'total_appointment_details',
                  'details' => $this->input->post('total_appoin',TRUE)
                  );

      if(!empty($checkDeata15)){
        $this->db->where('name','total_appointment_details')
          ->update('web_pages_tbl',$data15);
      } else {
          $this->db->insert('web_pages_tbl',$data15);
      }

      //checkPreview today_appointment_details
      $checkDeata15 = $this->web_setup_model->checkPreview('today_appointment_details');
      $data16 = array('name' => 'today_appointment_details',
                  'details' => $this->input->post('today_appoin',TRUE)
                  );

      if(!empty($checkDeata15)){
        $this->db->where('name','today_appointment_details')
          ->update('web_pages_tbl',$data16);
      } else {
          $this->db->insert('web_pages_tbl',$data16);
      }

      //checkPreview total_patient_details
      $checkDeata17 = $this->web_setup_model->checkPreview('total_patient_details');
      $data17 = array('name' => 'total_patient_details',
                  'details' => $this->input->post('tota_patient',TRUE)
                  );

      if(!empty($checkDeata17)){
        $this->db->where('name','total_patient_details')
          ->update('web_pages_tbl',$data17);
      } else {
          $this->db->insert('web_pages_tbl',$data17);
      }

      //checkPreview address
      $checkDeata18 = $this->web_setup_model->checkPreview('address');
      $data18 = array('name' => 'address',
                  'details' => $this->input->post('address',TRUE)
                  );

      if(!empty($checkDeata18)){
        $this->db->where('name','address')
          ->update('web_pages_tbl',$data18);
      } else {
          $this->db->insert('web_pages_tbl',$data18);
      }


      //checkPreview twitter_post
      $checkDeata18 = $this->web_setup_model->checkPreview('twitter_post');
      $data19 = array('name' => 'twitter_post',
                  'details' => $this->input->post('twitter_post',FALSE)
                  );

      if(!empty($checkDeata18)){
        $this->db->where('name','twitter_post')
          ->update('web_pages_tbl',$data19);
      } else {
          $this->db->insert('web_pages_tbl',$data19);
      }

	//checkPreview theraphists_title
      $checkDeata17 = $this->web_setup_model->checkPreview('theraphists_title');
      $data17 = array('name' => 'theraphists_title',
                  'details' => $this->input->post('theraphists_title',TRUE)
                  );

      if(!empty($checkDeata17)){
        $this->db->where('name','theraphists_title')
          ->update('web_pages_tbl',$data17);
      } else {
          $this->db->insert('web_pages_tbl',$data17);
      }
	  
	  //checkPreview theraphists_sub_title
      $checkDeata17 = $this->web_setup_model->checkPreview('theraphists_sub_title');
      $data17 = array('name' => 'theraphists_sub_title',
                  'details' => $this->input->post('theraphists_sub_title',TRUE)
                  );

      if(!empty($checkDeata17)){
        $this->db->where('name','theraphists_sub_title')
          ->update('web_pages_tbl',$data17);
      } else {
          $this->db->insert('web_pages_tbl',$data17);
      }
	  
	   //checkPreview commitements_title
      $checkDeata17 = $this->web_setup_model->checkPreview('commitements_title');
      $data17 = array('name' => 'commitements_title',
                  'details' => $this->input->post('commitements_title',TRUE)
                  );

      if(!empty($checkDeata17)){
        $this->db->where('name','commitements_title')
          ->update('web_pages_tbl',$data17);
      } else {
          $this->db->insert('web_pages_tbl',$data17);
      }
	  
	   //checkPreview commitements_sub_title
      $checkDeata17 = $this->web_setup_model->checkPreview('commitements_sub_title');
      $data17 = array('name' => 'commitements_sub_title',
                  'details' => $this->input->post('commitements_sub_title',TRUE)
                  );

      if(!empty($checkDeata17)){
        $this->db->where('name','commitements_sub_title')
          ->update('web_pages_tbl',$data17);
      } else {
          $this->db->insert('web_pages_tbl',$data17);
      }
	  
	   //checkPreview testimonials_title
      $checkDeata17 = $this->web_setup_model->checkPreview('testimonials_title');
      $data17 = array('name' => 'testimonials_title',
                  'details' => $this->input->post('testimonials_title',TRUE)
                  );

      if(!empty($checkDeata17)){
        $this->db->where('name','testimonials_title')
          ->update('web_pages_tbl',$data17);
      } else {
          $this->db->insert('web_pages_tbl',$data17);
      }
	  
	   //checkPreview testimonials_sub_title
      $checkDeata17 = $this->web_setup_model->checkPreview('testimonials_sub_title');
      $data17 = array('name' => 'testimonials_sub_title',
                  'details' => $this->input->post('testimonials_sub_title',TRUE)
                  );

      if(!empty($checkDeata17)){
        $this->db->where('name','testimonials_sub_title')
          ->update('web_pages_tbl',$data17);
      } else {
          $this->db->insert('web_pages_tbl',$data17);
      }
	  
	   //checkPreview testimonials_text
      $checkDeata17 = $this->web_setup_model->checkPreview('testimonials_text');
      $data17 = array('name' => 'testimonials_text',
                  'details' => $this->input->post('testimonials_text',TRUE)
                  );

      if(!empty($checkDeata17)){
        $this->db->where('name','testimonials_text')
          ->update('web_pages_tbl',$data17);
      } else {
          $this->db->insert('web_pages_tbl',$data17);
      }
	  
	  //checkPreview blog_title
      $checkDeata17 = $this->web_setup_model->checkPreview('blog_title');
      $data17 = array('name' => 'blog_title',
                  'details' => $this->input->post('blog_title',TRUE)
                  );

      if(!empty($checkDeata17)){
        $this->db->where('name','blog_title')
          ->update('web_pages_tbl',$data17);
      } else {
          $this->db->insert('web_pages_tbl',$data17);
      }
	  
	  //checkPreview blog_text
      $checkDeata17 = $this->web_setup_model->checkPreview('blog_text');
      $data17 = array('name' => 'blog_text',
                  'details' => $this->input->post('blog_text',TRUE)
                  );

      if(!empty($checkDeata17)){
        $this->db->where('name','blog_text')
          ->update('web_pages_tbl',$data17);
      } else {
          $this->db->insert('web_pages_tbl',$data17);
      }
    #-----------------------------------------#
      //Footer Logo
    #-----------------------------------------#
          // get picture data
          if (@$_FILES['footer_picture']['name']){
              $config['upload_path']   = './assets/uploads/images/';
              $config['allowed_types'] = 'gif|jpg|jpeg|png';
              $config['overwrite']     = false;
              $config['max_size']      = 1024;
              $config['remove_spaces'] = true;
              $config['max_filename']   = 10;
              $config['file_ext_tolower'] = true;

              $this->load->library('upload', $config);

              if (!$this->upload->do_upload('footer_picture')){
                $this->session->set_flashdata('exception',"<div class='alert alert-danger msg'>".display('image_upload_msg')."</div>");
              redirect('admin/Web_setup_controller/header_setting');
              } else {
              $data = $this->upload->data();
              $image = base_url($config['upload_path'].$data['file_name']);
              }
            } else {
              $image = $this->input->post('footer_pic');
            }

    
      //checkPreview footer_picture
      $checkDeata20 = $this->web_setup_model->checkPreview('footer_picture');
      $data20 = array('name' => 'footer_picture',
              'picture' => $image
              );

      if(!empty($checkDeata20)){

        $this->db->where('name','fabicon')
          ->update('web_pages_tbl',$data20);
          
      } else {
          $this->db->insert('web_pages_tbl',$data20);
      }    
      // Custom work end .

          // get picture data
          if (@$_FILES['fabicon']['name']){
              $config['upload_path']   = './assets/uploads/images/';
              $config['allowed_types'] = 'gif|jpg|jpeg|png';
              $config['overwrite']     = false;
              $config['max_size']      = 1024;
              $config['remove_spaces'] = true;
              $config['max_filename']   = 10;
              $config['file_ext_tolower'] = true;

              $this->load->library('upload', $config);

              if (!$this->upload->do_upload('fabicon')){
                $this->session->set_flashdata('exception',"<div class='alert alert-danger msg'>".display('image_upload_msg')."</div>");
              redirect('admin/Web_setup_controller/header_setting');
              } else {
              $data = $this->upload->data();
              $image = base_url($config['upload_path'].$data['file_name']);
              }
            } else {
              $image = $this->input->post('fabicon_pic',TRUE);
            }

    
              //checkPreview fabicon
              $checkDeata20 = $this->web_setup_model->checkPreview('fabicon');
              $data20 = array('name' => 'fabicon',
                'picture' => $image
              );

      if(!empty($checkDeata20)){

        $this->db->where('name','fabicon')
          ->update('web_pages_tbl',$data20);
          
      } else {
          $this->db->insert('web_pages_tbl',$data20);
      }    

      #-------------------------------
      // footer option copy right
      $checkDeata21 = $this->web_setup_model->checkPreview('copy_right');
      $data21 = array('name' => 'copy_right',
              'details' => $this->input->post('copy_right',TRUE)
              );
      if(!empty($checkDeata21)){

        $this->db->where('name','copy_right')
          ->update('web_pages_tbl',$data21);
          
      } else {
          $this->db->insert('web_pages_tbl',$data21);
      }//end copy right 

      #-------------------------------
      // website title
      $checkDeata22 = $this->web_setup_model->checkPreview('website_title');
      $data22 = array('name' => 'website_title',
              'details' => $this->input->post('website_title',TRUE)
              );
      if(!empty($checkDeata22)){

        $this->db->where('name','website_title')
          ->update('web_pages_tbl',$data22);
          
      } else {
          $this->db->insert('web_pages_tbl',$data22);
      }//end title

      #-------------------------------
      // website timezone
      $checkDeata23 = $this->web_setup_model->checkPreview('timezone');
      $data23 = array('name' => 'timezone',
              'details' => $this->input->post('timezone',TRUE)
              );
      if(!empty($checkDeata23)){

        $this->db->where('name','timezone')
          ->update('web_pages_tbl',$data23);
          
      } else {
          $this->db->insert('web_pages_tbl',$data23);
      }//end timezone

      $this->session->set_flashdata('message','<div class="alert alert-success msg">'.display('website_setup_msg').'</div>');
      redirect('admin/Web_setup_controller/header_setting');

  }


#------------------------------------------------
#       save slider
#------------------------------------------------
  public function save_slider()
  {
        $slider['headline'] = $this->input->post('headline',TRUE);
        $slider['details'] = $this->input->post('details',TRUE);
        $slider['sequence'] = $this->input->post('sequence',TRUE);

        $filesCount = count($_FILES['picture']['name']);
            for($i = 0; $i < $filesCount; $i++){

                $_FILES['userFile']['name'] = $_FILES['picture']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['picture']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['picture']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['picture']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['picture']['size'][$i];



              $config['upload_path']   = './assets/uploads/images/';
              $config['allowed_types'] = 'gif|jpg|jpeg|png';
              $config['overwrite']     = false;
              $config['max_size']      = 1024;
              $config['remove_spaces'] = true;
              $config['max_filename']   = 10;
              $config['file_ext_tolower'] = true;
                
              $this->load->library('upload', $config);
              $this->upload->initialize($config);

              if (!$this->upload->do_upload('userFile')){
                  $this->session->set_flashdata('exception',"<div class='alert alert-danger msg'>".$this->upload->display_errors()."</div>");
                    redirect('admin/Web_setup_controller/slider_list');
              } else {
              $data = $this->upload->data();
              $image = base_url($config['upload_path'].$data['file_name']);
               

                $slidData = array(
                    'heading'=> $slider['headline'][$i],
                    'details'=> $slider['details'][$i],
                    'sequence'=> $slider['sequence'][$i],
                    'picture'=>$image
                );
            }
          $this->db->insert('slider',$slidData);

        }
        $this->session->set_flashdata('message_s','<div class="alert alert-success msg">'.display('slider_ste_msg').'</div>');
        redirect('admin/Web_setup_controller/slider_list');
  }



#------------------------------------------------
#       view slider list
#------------------------------------------------
  public function slider_list()
  {
      $data['slider'] = $this->web_setup_model->get_slider();
      $this->load->view('admin/_header',$data);
      $this->load->view('admin/_left_sideber');
      $this->load->view('admin/websetting/view_slider_list');
      $this->load->view('admin/_footer');
  }

#------------------------------------------------
#       Slider view edit
#------------------------------------------------
  public function slider_edit($id)
  {
    $data['info'] = $this->web_setup_model->get_slider_by_id($id);
    $this->load->view('admin/_header',$data);
    $this->load->view('admin/_left_sideber');
    $this->load->view('admin/websetting/view_slider_edit');
    $this->load->view('admin/_footer');
  }


#------------------------------------------------
#       delete slider
#------------------------------------------------
  public function delete_slider($id)
  {
      $this->db->where('id',$id)
            ->delete('slider');
      $this->session->set_flashdata('message','<div class="alert alert-success msg"> '.display('delete_mgs').'</div>');
      redirect('admin/Web_setup_controller/slider_list');
  }

#------------------------------------------------
#       save edit slider
#------------------------------------------------
  public function save_edit_slider()
  {
    // get picture data
    if (@$_FILES['picture']['name']){
        $config['upload_path']   = './assets/uploads/images/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['overwrite']     = false;
        $config['max_size']      = 1024;
        $config['remove_spaces'] = true;
        $config['max_filename']   = 10;
        $config['file_ext_tolower'] = true;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('picture')){
            $this->session->set_flashdata('exception',"<div class='alert alert-danger msg'>".$this->upload->display_errors()."</div>");
         redirect('admin/Web_setup_controller/slider_list');
        } else {

        $data = $this->upload->data();
        $image = base_url($config['upload_path'].$data['file_name']);
        
        }
      } else {
        $image = $this->input->post('pic',TRUE);
      }

    $id = $this->input->post('id',TRUE);
    $data = array(
                  'heading' => $this->input->post('head_line',TRUE),
                  'details' => $this->input->post('details',TRUE),
                  'sequence' => $this->input->post('sequence',TRUE),
                  'picture' => $image
                  );

  $this->db->where('id',$id)
        ->update('slider',$data);

  $this->session->set_flashdata('message','<div class="alert alert-success msg"> '.display('update_msg').'</div>');
   redirect('admin/Web_setup_controller/slider_list');
  }


#------------------------------------------------
#      website_on_off
#------------------------------------------------
 public function website_on_off()
  {
    $data['info']= $this->db->select('*')->from('web_pages_tbl')->where('name','website_on_off')->get()->row();

    $this->load->view('admin/_header',$data);
    $this->load->view('admin/_left_sideber');
    $this->load->view('admin/websetting/view_website_on_off');
    $this->load->view('admin/_footer');
  }

#------------------------------------------------
#      save_off
#------------------------------------------------
  public function save_off()
  {
      $data = array('name' => 'website_on_off',
                  'details' => 'off',
                  'status' => 0
                  );

        $this->db->where('name','website_on_off')
          ->update('web_pages_tbl',$data);
          redirect('admin/Web_setup_controller/website_on_off');
  }

#------------------------------------------------
#      save_on
#------------------------------------------------
  public function save_on()
  {
      $data = array('name' => 'website_on_off',
                  'details' => 'on',
                  'status' => 1
                  );

        $this->db->where('name','website_on_off')
          ->update('web_pages_tbl',$data);
          redirect('admin/Web_setup_controller/website_on_off');
  }
 
#------------------------------------------------
#      save_api
#------------------------------------------------ 
  public function save_api()
  {  
    $checkD = $this->web_setup_model->checkPreview('third_party_api');
    $data_api = array('name' => 'third_party_api',
                  'details' => $this->input->post('thard_parti_api',FALSE),
                  'status' => 1
                  );
      if(!empty($checkD)){
        $this->db->where('name','third_party_api')
          ->update('web_pages_tbl',$data_api);
          
      } else {
          $this->db->insert('web_pages_tbl',$data_api);
      } 
      redirect('admin/Web_setup_controller/website_on_off');    
  }

#------------------------------------------------
#      remove_api
#------------------------------------------------
  public function remove_api()
  {
    $data = array('name' => 'third_party_api',
                  'details' => '',
                  'status' => 1
                  );
     $this->db->where('name','third_party_api')
          ->update('web_pages_tbl',$data);
          redirect('admin/Web_setup_controller/website_on_off');
  }

  


}