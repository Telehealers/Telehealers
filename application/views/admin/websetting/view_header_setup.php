
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('web_setting');?></h1>
            <small><?php echo display('web_setting');?></small>
           <ol class="breadcrumb">
                  <li><a target="_blank" href="<?php echo base_url();?>"><i class="pe-7s-home"></i> <?php echo display('site_view')?></a></li>
                  <li class="active"><a href="<?php echo base_url();?>admin/Dashboard"><?php echo display('deashbord');?></a></li>
              </ol>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <!--  form area-->
        <div class="col-sm-12">
            <div class="panel panel-default panel-form">

                 <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo display('web_setting');?></h4>
                    </div>
                </div>

                
                <div class="panel-body">
                    <div class="portlet-body form">

                        <?php 
                             $msg = $this->session->flashdata('message');
                              if($msg !=''){
                                  echo htmlspecialchars_decode($msg);
                              }
                              if($this->session->flashdata('exception')!=""){
                                 echo $this->session->flashdata('exception');
                            }
                            $attributes = array('class' => 'form-horizontal','role'=>'form');
                            echo form_open_multipart('admin/Web_setup_controller/save_header', $attributes);                
                        ?>

                         
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('phone_number');?></label>
                                    <div class="col-md-8">
                                        <input type="number" value="<?php echo (!empty(html_escape($info->phone->details))?html_escape($info->phone->details):null); ?>" name="phone" class="form-control"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> <?php echo display('email');?></label>
                                    <div class="col-md-8">
                                        <input type="email" value="<?php echo (!empty(html_escape($info->email->details))?html_escape($info->email->details):null); ?>" name="email" class="form-control"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                   <label class="col-md-3 control-label"><?php echo display('address');?> </label>
                                   <div class="col-md-8">
                                   <textarea class="form-control" name="address" ><?php echo (!empty(html_escape($info->address->details))?html_escape($info->address->details):null); ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('time_zone_setup');?> :</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="timezone">
                                            <option value="">--<?php echo display('time_setup');?>--</option>
                                            <?php 
                                                $zones = timezone_identifiers_list();
                                                $i = 0;
                                                foreach($zones as $name){
                                                    echo'<option '.($name==$info->timezone->details?'selected':'').' value="'.$name.'">'.$name.'</option>'; 
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                   <label class="col-md-3 control-label"><?php echo display('facebook_link');?></label>
                                   <div class="col-md-8">
                                        <input type="text" value="<?php echo (!empty(html_escape($info->facebook->details))?html_escape($info->facebook->details):null); ?>" name="facebook"  class="form-control"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                   <label class="col-md-3 control-label"><?php echo display('twitter_link');?></label>
                                   <div class="col-md-8">
                                        <input type="text" value="<?php echo (!empty(html_escape($info->twitter->details))?html_escape($info->twitter->details):null); ?>" name="twitter"  class="form-control"> 
                                    </div>
                                </div>


                                <div class="form-group">
                                   <label class="col-md-3 control-label"><?php echo display('youtube_link');?></label>
                                   <div class="col-md-8">
                                        <input type="text" value="<?php echo (!empty(html_escape($info->youtube->details))?html_escape($info->youtube->details):null); ?>" name="youtube"  class="form-control"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                   <label class="col-md-3 control-label"><?php echo display('linkedin_link');?></label>
                                   <div class="col-md-8">
                                        <input type="text" value="<?php echo (!empty(html_escape($info->linkedin->details))?html_escape($info->linkedin->details):null); ?>" name="linkedin"  class="form-control"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                   <label class="col-md-3 control-label">Instagram Link</label>
                                   <div class="col-md-8">
                                        <input type="text" value="<?php echo (!empty(html_escape($info->google->details))?html_escape($info->google->details):null); ?>" name="google"  class="form-control"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                   <label class="col-md-3 control-label">About Description</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control"  name="working_des" rows="8" cols="24"><?php echo (!empty(html_escape($info->working_des->details))?html_escape($info->working_des->details):null); ?></textarea>
                                        <span class="text-warning">The element with a maximum length of 600 characters</span>
                                    </div>
                                </div>
								
								 <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('about_image');?></label>
                                    <div class="col-md-8">
                                        <img width="100" src="<?php echo (!empty(html_escape($info->about_img->picture))?html_escape($info->about_img->picture):null); ?>">
                                        <input type="file" name="about_img">  
                                        <span>[size - 539*464(pixel)]</span>       
                                        <input type="hidden" name="about_pic" value="<?php echo (!empty(html_escape($info->about_img->picture))?html_escape($info->about_img->picture):null); ?>">      
                                    </div>
                                </div>

                                 <div class="form-group">
                                   <label class="col-md-3 control-label"><?php echo display('hotline');?></label>
                                   <div class="col-md-8">
                                        <input type="text" value="<?php echo (!empty(html_escape($info->hotline->details))?html_escape($info->hotline->details):null); ?>" name="hotline"  class="form-control"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                   <label class="col-md-3 control-label"><?php echo display('copy_right');?></label>
                                   <div class="col-md-8">
                                      <textarea name="copy_right"  class="form-control"><?php echo (!empty(html_escape($info->copy_right->details))?html_escape($info->copy_right->details):null); ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('logo');?> </label>
                                    <div class="col-md-8">
                                        <img src="<?php echo (!empty(html_escape($info->logo->picture))?html_escape($info->logo->picture):null); ?>">
                                        <input type="file" name="picture">  
                                         <span>[300*100 jpg,png,jpeg,gif and max size is 1MB]</span>     
                                        <input type="hidden" name="pic" value="<?php echo (!empty(html_escape($info->logo->picture))?html_escape($info->logo->picture):null); ?>">      
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('footer_logo');?> </label>
                                    <div class="col-md-8">
                                        <img src="<?php echo (!empty(html_escape($info->footer_picture->picture))?html_escape($info->footer_picture->picture):null); ?>" width="100">
                                        <input type="file" name="footer_picture"> 
                                        <span>[300*100 jpg,png,jpeg,gif and max size is 1MB]</span>       
                                        <input type="hidden" name="footer_pic" value="<?php echo (!empty(html_escape($info->footer_picture->picture))?html_escape($info->footer_picture->picture):null); ?>">      
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('favicon');?> </label>
                                    <div class="col-md-8">
                                        <img width="50" src="<?php echo (!empty(html_escape($info->fabicon->picture))?html_escape($info->fabicon->picture):null); ?>">
                                        <input type="file" name="fabicon">  
                                        <span>[48*48 jpg,png,jpeg,gif and max size is 1MB]</span>      
                                        <input type="hidden" name="fabicon_pic" value="<?php echo (!empty(html_escape($info->fabicon->picture))?html_escape($info->fabicon->picture):null); ?>">      
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('website_title');?> </label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="website_title" value="<?php echo (!empty(html_escape($info->website_title->details))?html_escape($info->website_title->details):null); ?>">      
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('appointment_image');?></label>
                                    <div class="col-md-8">
                                        <img width="100" src="<?php echo (!empty(html_escape($info->app_image->picture))?html_escape($info->app_image->picture):null); ?>">
                                        <input type="file" name="app_img">
                                        <span>[723*955, jpg,png,jpeg,gif and max size is 1MB]</span>        
                                        <input type="hidden" name="app_pic" value="<?php echo (!empty(html_escape($info->app_image->picture))?html_escape($info->app_image->picture):null); ?>">      
                                    </div>
                                </div>

                               

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('google_map');?></label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="google_map" rows="3" cols="4"><?php echo (!empty(htmlspecialchars_decode($info->google_map->details))?htmlspecialchars_decode($info->google_map->details):null); ?></textarea>     
                                    </div>
                                </div>


                                <div class="form-group">
                                   <label class="col-md-3 control-label"><?php echo display('total_appointment_details');?> </label>
                                   <div class="col-md-8">
                                        <input type="text" value="<?php echo (!empty(html_escape($info->total_appointment_details->details))?html_escape($info->total_appointment_details->details):null); ?>" name="total_appoin" maxlength="60" class="form-control"> 
                                        <span class="text-warning">The element with a maximum length of 60 characters</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-md-3 control-label"><?php echo display('today_appointment_details');?> </label>
                                   <div class="col-md-8">
                                        <input type="text" value="<?php echo (!empty(html_escape($info->today_appointment_details->details))?html_escape($info->today_appointment_details->details):null); ?>" name="today_appoin" maxlength="60" class="form-control"> 
                                        <span class="text-warning">The element with a maximum length of 60 characters</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                   <label class="col-md-3 control-label"><?php echo display('total_patient_details');?> </label>
                                   <div class="col-md-8">
                                        <input type="text" value="<?php echo (!empty(html_escape($info->total_patient_details->details))?html_escape($info->total_patient_details->details):null); ?>" name="tota_patient" maxlength="60" class="form-control"> 
                                        <span class="text-warning">The element with a maximum length of 60 characters</span>
                                    </div>
                                </div>
								
								<div class="form-group">
                                   <label class="col-md-3 control-label">Doctors Title </label>
                                   <div class="col-md-8">
                                        <input type="text" value="<?php echo (!empty(html_escape($info->theraphists_title->details))?html_escape($info->theraphists_title->details):null); ?>" name="theraphists_title" maxlength="60" class="form-control"> 
                                    </div>
                                </div>
								
								<div class="form-group">
                                   <label class="col-md-3 control-label">Doctors Sub Title </label>
                                   <div class="col-md-8">
                                        <input type="text" value="<?php echo (!empty(html_escape($info->theraphists_sub_title->details))?html_escape($info->theraphists_sub_title->details):null); ?>" name="theraphists_sub_title" maxlength="60" class="form-control"> 
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Twitter Page Url</label>
                                    <div class="col-md-8">
                                        <input type="text" name="twitter_post" class="form-control" value='<?php echo (!empty(htmlspecialchars_decode($info->twitter_post->details))?htmlspecialchars_decode($info->twitter_post->details):null); ?>'>
                                        
                                    </div>
                                </div>
								
								<div class="form-group">
                                   <label class="col-md-3 control-label">Commitements Title </label>
                                   <div class="col-md-8">
                                        <input type="text" value="<?php echo (!empty(html_escape($info->commitements_title->details))?html_escape($info->commitements_title->details):null); ?>" name="commitements_title" maxlength="60" class="form-control"> 
                                    </div>
                                </div>
								
								<div class="form-group">
                                   <label class="col-md-3 control-label">Commitements Sub Title </label>
                                   <div class="col-md-8">
                                        <input type="text" value="<?php echo (!empty(html_escape($info->commitements_sub_title->details))?html_escape($info->commitements_sub_title->details):null); ?>" name="commitements_sub_title" maxlength="60" class="form-control"> 
                                    </div>
                                </div>
								
								<div class="form-group">
                                   <label class="col-md-3 control-label">Testimonials Title </label>
                                   <div class="col-md-8">
                                        <input type="text" value="<?php echo (!empty(html_escape($info->testimonials_title->details))?html_escape($info->testimonials_title->details):null); ?>" name="testimonials_title" maxlength="60" class="form-control"> 
                                    </div>
                                </div>
								
								<div class="form-group">
                                   <label class="col-md-3 control-label">Testimonials Sub Title </label>
                                   <div class="col-md-8">
                                        <input type="text" value="<?php echo (!empty(html_escape($info->testimonials_sub_title->details))?html_escape($info->testimonials_sub_title->details):null); ?>" name="testimonials_sub_title" maxlength="60" class="form-control"> 
                                    </div>
                                </div>
								
								<div class="form-group">
                                   <label class="col-md-3 control-label">Testimonials Text </label>
                                   <div class="col-md-8">
                                        <input type="text" value="<?php echo (!empty(html_escape($info->testimonials_text->details))?html_escape($info->testimonials_text->details):null); ?>" name="testimonials_text" maxlength="60" class="form-control"> 
                                    </div>
                                </div>
								
								<div class="form-group">
                                   <label class="col-md-3 control-label">Blog Title </label>
                                   <div class="col-md-8">
                                        <input type="text" value="<?php echo (!empty(html_escape($info->blog_title->details))?html_escape($info->blog_title->details):null); ?>" name="blog_title" maxlength="60" class="form-control"> 
                                    </div>
                                </div>
								
								<div class="form-group">
                                   <label class="col-md-3 control-label">Blog Text </label>
                                   <div class="col-md-8">
                                        <input type="text" value="<?php echo (!empty(html_escape($info->blog_text->details))?html_escape($info->blog_text->details):null); ?>" name="blog_text" maxlength="60" class="form-control"> 
                                    </div>
                                </div>
								
								
                            </div>

                              <div class="form-group row">
                                  <div class="col-sm-offset-3 col-sm-6">
                                        <button type="reset" class="btn btn-danger"><?php echo display('reset');?></button>
                                        <button type="submit" class="btn btn-success"><?php echo display('submit');?></button>
                                  </div>
                              </div>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </div>           
    </section>
</div>



