<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1>Create New Doctor</h1>
            <small>Create New Doctor</small>
            <ol class="breadcrumb">
                <li><a target="_blank" href="<?php echo base_url();?>"><i class="pe-7s-home"></i> <?php echo display('site_view')?></a></li>
                <li class="active"><a href="<?php echo base_url();?>admin/Dashboard"><?php echo display('deashbord');?></a></li>
            </ol>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <!--  form area -->
        <div class="col-sm-12">
            <div class="panel panel-bd">
                <div class="panel-heading ">
                    <div class="panel-title" >
                        <h4>Create New Doctor</h4>
                    </div>
               </div>

                <div class="panel-body">
                    <div class="portlet-body form">

                        <?php if(validation_errors()){?>
                                <div class="alert alert-danger"><?php echo validation_errors();?></div>
                        <?php }?>

                        <?php 
                            $mag = $this->session->flashdata('message');
                            if($mag !=''){
                                echo htmlspecialchars_decode($mag);
                            }
                            $attributes = array('class' => 'form-horizontal','name'=>'d_info','role'=>'form');
                            echo form_open_multipart('admin/Doctor_controller/add_new_doctor', $attributes);                
                        ?>
                            <div class="form-body">
							
								<div class="form-group" style="display:none;">
                                    <label class="col-md-3 control-label"><span class="text-danger"> * </span> Fees</label>
                                    <div class="col-md-7">
                                       <input type="number"  requeird name="fees" value="100"  class="form-control" placeholder="">
                                     </div>
                                </div>
								
							
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Registration Number </label>
                                    <div class="col-md-7">
                                        <input type="text" name="registration_number" class="form-control" value="" placeholder="Registration Number"> 
                                     <?php echo form_error('name', '<div class=" text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="text-danger"> * </span> <?php echo display('doctor_name');?> </label>
                                    <div class="col-md-7">
                                        <input type="text" name="name" class="form-control" value="<?php echo html_escape(@$doctor_info->doctor_name); ?>" placeholder="<?php echo display('doctor_name');?>" required> 
                                     <?php echo form_error('name', '<div class=" text-danger">', '</div>'); ?>
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label class="col-md-3 control-label"><span class="text-danger"> * </span> <?php echo display('email');?>:</label>
                                    <div class="col-md-6">
                                        <input type="text" name="email" required value="<?php echo set_value('email'); ?>" class="form-control" > 
                                        <span class="text-danger" ><?php echo form_error('email'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="text-danger"> * </span> <?php echo display('password');?>:</label>
                                    <div class="col-md-6">
                                        <input type="text" name="password" required value="<?php echo set_value('password'); ?>" class="form-control" > 
                                        <span class="text-danger" ><?php echo form_error('password'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('designation');?></label>
                                    <div class="col-md-7">
                                        <input type="text" name="designation" value="<?php echo html_escape(@$doctor_info->designation); ?>" class="form-control" placeholder="<?php echo display('designation');?>"> </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('degrees');?></label>
                                    <div class="col-md-7">
                                        <input type="text" name="degree" value="<?php echo html_escape(@$doctor_info->degrees); ?>" class="form-control" placeholder="<?php echo display('degrees');?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> <span class="text-danger"> * </span> <?php echo display('department');?> </label>
                                    <div class="col-md-7">
                                        <select class="form-control" name="department">
										<?php foreach($depart_info as $department){?>
										<option value="<?php echo $department->department_id;?>"><?php echo $department->department_name;?></option>
										<?php } ?>
										</select>
									</div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('specialist');?></label>
                                    <div class="col-md-7">
                                        <input type="text" name="specialist" value="<?php echo html_escape(@$doctor_info->specialist); ?>" class="form-control" placeholder="<?php echo display('specialist');?>"> 
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('doctor_experience');?></label>
                                    <div class="col-md-7">
                                        <input type="text" name="doctor_exp" value="<?php echo html_escape(@$doctor_info->doctor_exp); ?>" class="form-control" placeholder="<?php echo display('doctor_experience');?>"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('service_place');?></label>
                                    <div class="col-md-7">
                                        <input type="text" name="service_place" value="<?php echo html_escape(@$doctor_info->service_place); ?>" class="form-control" placeholder="<?php echo display('service_place');?>"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('birth_date');?></label>
                                    <div class="col-md-7">
                                       <input type="text" requeird name="birth_date" value="<?php echo html_escape(@$doctor_info->birth_date); ?>"  class="form-control datepicker1" placeholder="<?php echo display('date_placeholder');?>">
                                     </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="text-danger"> * </span><?php echo display('phone_number');?></label>
                                    <div class="col-md-7">
                                        <input type="number" required  name="phone" value="<?php echo html_escape(@$doctor_info->doctor_phone); ?>" class="form-control" placeholder="<?php echo display('phone_number');?>" required> 
                                     <?php echo form_error('phone', '<div class=" text-danger">', '</div>'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('sex');?></label>
                                    <div class="col-md-7">
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" id="checkbox2_5" <?php echo (html_escape(@$doctor_info->sex)=='Male')?'checked':'' ?> name="gender" value="Male" class="md-radiobtn">
                                                <label for="checkbox2_5">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> <?php echo display('male');?>
                                                </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="checkbox2_10" name="gender" value="Female" <?php echo (html_escape(@$doctor_info->sex)=='Female')?'checked':'' ?> class="md-radiobtn">
                                                <label for="checkbox2_10">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> <?php echo display('female');?> 
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('blood_group');?> </label>
                                    <div class="col-md-7">
                                        <select class="form-control" name="blood_group">
                                            <option value=''>--Select Blood Group--</option>
                                            <option value='A+' <?php echo (html_escape(@$doctor_info->blood_group)=='A+'?'selected':'');?>>A+</option>
                                            <option value='A-' <?php echo (html_escape(@$doctor_info->blood_group)=='A-'?'selected':'');?>>A-</option>
                                            <option value='B+' <?php echo (html_escape(@$doctor_info->blood_group)=='B+'?'selected':'');?>>B+</option>
                                            <option value='B-' <?php echo (html_escape(@$doctor_info->blood_group)=='B-'?'selected':'');?>>B-</option>
                                            <option value='O+' <?php echo (html_escape(@$doctor_info->blood_group)=='O+'?'selected':'');?>>O+</option>
                                            <option value='O-' <?php echo (html_escape(@$doctor_info->blood_group)=='O-'?'selected':'');?>>O-</option>
                                            <option value='AB+' <?php echo (html_escape(@$doctor_info->blood_group)=='AB+'?'selected':'');?>>AB+</option>
                                            <option value='AB-' <?php echo (html_escape(@$doctor_info->blood_group)=='AB-'?'selected':'');?>>AB-</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('address');?></label>
                                    <div class="col-md-7">
                                         <textarea name="address" value="<?php echo html_escape(@$doctor_info->address); ?>" 
                                            class="form-control" rows="3"><?php echo html_escape(@$doctor_info->address); ?></textarea>
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label class="col-md-3 control-label">Language</label>
                                    <div class="col-md-7">
									<?php foreach($doc_language as $val){?>
										<input type="checkbox" name="language[]" value="<?php echo $val; ?>" />&nbsp;<?php echo $val; ?>
									<?php }?>		
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label class="col-md-3 control-label">Meeting URL</label>
                                    <div class="col-md-7">
                                        <input type="text" name="meet_url" value="<?php echo html_escape(@$doctor_info->meet_url); ?>" class="form-control" placeholder="Meeting URL"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('about_me');?></label>
                                    <div class="col-md-7">
                                        <textarea name="about_me" value="<?php echo html_escape(@$doctor_info->about_me); ?>"
                                          id="summernote" class=" form-control" rows="4"><?php echo html_escape(@$doctor_info->about_me); ?>
                                         </textarea>

                                        <span class="text-danger"><?php echo form_error('about_me'); ?> </span>
                                    </div>
                                </div>
								

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('picture');?></label>
                                    <div class="col-md-7">
                                        <img src="<?php echo html_escape(@$doctor_info->picture);?>" width="200px">
                                        <input type="file" name="picture"> 
                                         <span>[ jpg,png,jpeg,gif and max size is 1MB]</span>
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label class="col-md-3 control-label">Signature</label>
                                    <div class="col-md-7">
                                        <img src="<?php echo html_escape(@$doctor_info->picture2);?>" width="200px">
                                        <input type="file" name="picture2"> 
                                         <span>[ jpg,png,jpeg,gif and max size is 1MB]</span>
                                    </div>
                                </div>

                                <input type='hidden' name="doctor_id" value="<?php echo html_escape(@$doctor_info->doctor_id); ?>">
                                <input type='hidden' name="image" value="<?php echo html_escape(@$doctor_info->picture); ?>">
								<input type='hidden' name="image2" value="<?php echo html_escape(@$doctor_info->picture2); ?>">
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-success"><?php echo display('submit')?></button>
                                </div>
                            </div>
                            
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>            
    </section>
</div>

