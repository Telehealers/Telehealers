<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('add_new_user');?></h1>
            <small><?php echo display('add_new_user');?></small>
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
                        <h4><?php echo display('add_new_user');?></h4>
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
                            $attributes = array('class' => 'form-horizontal');
                            echo form_open_multipart('admin/Users_controller/save_user', $attributes);                
                         ?>
                        
                            <div class="form-body">															
							
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> <span class="text-danger">*</span>  <?php echo display('full_name');?> :</label>
                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control" required value="<?php echo set_value('name'); ?>"> 
                                        <span class="text-danger" ><?php echo form_error('name'); ?> </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> <?php echo display('email');?>:</label>
                                    <div class="col-md-6">
                                        <input type="text" name="email" required value="<?php echo set_value('email'); ?>" class="form-control"> 
                                        <span class="text-danger" ><?php echo form_error('email'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> <?php echo display('password');?>:</label>
                                    <div class="col-md-6">
                                        <input type="text" name="password" required value="<?php echo set_value('password'); ?>" class="form-control" > 
                                        <span class="text-danger" ><?php echo form_error('password'); ?></span>
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> <span class="text-danger">*</span> <?php echo display('birth_date');?>:</label>
                                    <div class="col-md-4 ">
                                       <input type="text" name="birth_date" required class="form-control datepicker1 birth_date" >
                                    </div>
                                    <div class="col-md-2 ">
                                       <input type="text" name="old" id="old" class="form-control" placeholder="<?php echo display('age');?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label"> <span class="text-danger">*</span>  <?php echo display('phone_number');?>:</label>
                                    <div class="col-md-6">
                                        <input type="number"  name="phone" value="<?php echo set_value('phone'); ?>" class="form-control" > 
                                        <span class="text-danger" ><?php echo form_error('phone'); ?></span>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label"> <?php echo display('sex');?></label>
                                    <div class="col-md-6">
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" id="checkbox2_5" name="gender" required value="Male" class="md-radiobtn">
                                                <label for="checkbox2_5">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> <?php echo display('male');?>
                                                </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="checkbox2_10" name="gender" required value="Female" class="md-radiobtn">
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
                                    <label class="col-md-3 control-label"><?php echo display('blood_group');?> :</label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="blood_group">
                                            <option value=''>--<?php echo display('blood_group');?>--</option>
                                            <option value='A+'>A+</option>
                                            <option value='A-'>A-</option>
                                            <option value='B+'>B+</option>
                                            <option value='B-'>B-</option>
                                            <option value='O+'>O+</option>
                                            <option value='O-'>O-</option>
                                            <option value='AB+'>AB+</option>
                                            <option value='AB-'>AB-</option>
                                            <option value='Unknown'>Unknown</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo display('address');?>:</label>
                                    <div class="col-md-6">
                                         <textarea name="address"  value="<?php echo set_value('address'); ?>" class="form-control" rows="6"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('picture');?>:</label>
                                    <div class="col-md-6">
                                        <input type="file" name="picture">       
                                    </div>
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


<script src="<?php echo base_url()?>assets/admin_script.js" type="text/javascript"></script>