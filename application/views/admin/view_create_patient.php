
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('add_new_patient'); ?></h1>
            <small><?php echo display('add_new_patient'); ?></small>
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
                        <h4><?php echo display('add_new_patient');?></h4>
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
                        echo form_open_multipart('admin/Patient_controller/save_patient', $attributes);                
                    ?>
                        
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="text-danger"> * </span> <?php echo display('name'); ?> </label>
                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>" required placeholder="<?php echo display('name'); ?>" > 
                                        <span class="text-danger"><?php echo form_error('name'); ?> </span>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="text-danger"> * </span> <?php echo display('patient_id'); ?> </label>
                                    <div class="col-md-6">
                                        <input type="text" onkeyup="load_patient_id()" id="patient_id" autocomplete="off" name="patient_id" class="form-control" required value="<?php echo set_value('patient_id'); ?>" placeholder="<?php echo display('patient_id'); ?>"> 
                                        <span class="text-danger"><?php echo form_error('patient_id'); ?> </span>
                                        <span class="p_id"></span>
                                    </div>
                                </div>

 -->                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="text-danger"> * </span> <?php echo display('email'); ?></label>
                                    <div class="col-md-6">
                                        <input type="text" name="email" value="<?php echo set_value('email'); ?>" class="form-control" required placeholder="<?php echo display('email'); ?>"> 
                                        <span class="text-danger"><?php echo form_error('email'); ?></span>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="text-danger"> * </span> <?php echo display('birth_date'); ?></label>
                                    <div class="col-md-4 ">
                                       <input type="text" name="birth_date" value="" class="form-control datepicker1 birth_date"  placeholder="<?php echo display('date_placeholder'); ?>">
                                    </div> -->
                                    <div class="form-group">

                                    <label class="col-md-3 control-label"> <?php echo display('age'); ?></label>
                                    <div class="col-md-4 ">
                                       <input type="text" name="old" id="old" class="form-control" placeholder="<?php echo display('age'); ?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label"> <span class="text-danger"> * </span> <?php echo display('phone_number'); ?></label>
                                    <div class="col-md-6">
                                        <input type="tel"  name="phone" value="<?php echo set_value('phone'); ?>" class="form-control" required placeholder="<?php echo display('phone_number'); ?>"> 
                                        <span class="text-danger"><?php echo form_error('phone'); ?></span>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label"> <?php echo display('sex'); ?></label>
                                    <div class="col-md-6">
                                        <input type="radio" id="checkbox2_5" name="gender" required value="Male">
                                        <label for="checkbox2_5"> <?php echo display('male'); ?></label>
                                        <input type="radio" id="checkbox2_10" name="gender" required value="Female">
                                        <label for="checkbox2_10"> <?php echo display('female'); ?></label>

                                        <input type="radio" id="checkbox2_0" name="gender" required value="other">
                                        <label for="checkbox2_0"> <?php echo display('others'); ?></label>
                                    </div>
                                </div>
                               
                             


                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="reset" class="btn btn-danger"><?php echo display('reset')?></button>
                                    <button type="submit" class="btn btn-success"><?php echo display('submit')?></button>
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



