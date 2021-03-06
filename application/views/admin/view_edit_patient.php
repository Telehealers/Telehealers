

<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('edit_patient'); ?></h1>
            <small><?php echo display('edit_patient'); ?></small>
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
            <div  class="panel panel-default panel-form">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo display('edit_patient');?></h4>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="portlet-body form">
                        <?php 
                         $mag = $this->session->flashdata('message');
                          if($mag !=''){
                              echo "<div class='alert alert-success msg'>".html_escape($mag)."</div><br>";
                          }
                            $attributes = array('class' => 'form-horizontal','name'=>'p_info','role'=>'form');
                            echo form_open_multipart('admin/Patient_controller/edit_save_patient', $attributes);                
                        ?>
                        
                            <div class="form-body">

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="text-danger">* </span> <?php echo display('name');?> </label>
                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control" value="<?php echo html_escape($patient_info->patient_name); ?>" placeholder="<?php echo display('name');?>" required=""> 
                                        <span class="text-danger"><?php echo form_error('name'); ?> </span>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="text-danger">* </span><?php echo display('age');?></label>
                                    <div class="col-md-6">
                                    <input type="text" name="age" id="age" value="<?php echo html_escape($patient_info->age); ?>"  class="form-control"
                                    placeholder="<?php echo display('age'); ?>                ">
                                     </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="text-danger">* </span><?php echo display('phone_number');?></label>
                                    <div class="col-md-6">
                                        <input type="number" value="<?php echo html_escape($patient_info->patient_phone);?>"  name="phone" class="form-control" placeholder="<?php echo display('phone_number');?>"> 
                                        <span class="text-danger"><?php echo form_error('phone'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> <?php echo display('sex');?></label>
                                    <div class="col-md-6">
                                        <input type="radio" id="checkbox2_5" name="gender" <?php echo (html_escape($patient_info->sex)=='Male')?'checked':'' ?> required value="Male">
                                        <label for="checkbox2_5"> <?php echo display('male');?></label>
                                        <input type="radio" id="checkbox2_10" name="gender" required <?php echo (html_escape($patient_info->sex)=='Female')?'checked':'' ?> value="Female">
                                        <label for="checkbox2_10"> <?php echo display('female');?></label>

                                        <input type="radio" id="checkbox2_0" name="gender" required <?php echo (html_escape($patient_info->sex)=='other')?'checked':'' ?> value="other">
                                        <label for="checkbox2_0"> <?php echo display('others');?></label>
                                    </div>
                                </div>

                                
                                    </div>
                                </div>

                                


                                <input type='hidden' name="patient_id" value="<?php echo html_escape($patient_info->patient_id); ?>">
                                <input type='hidden' name="image" value="<?php echo html_escape($patient_info->picture); ?>">

                            </div>

                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-success"><?php echo display('update');?></button>
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

