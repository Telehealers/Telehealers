
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('change_password');?></h1>
            <small><?php echo display('change_password');?></small>
            <ol class="breadcrumb">
                <li><a target="_blank" href="<?php echo base_url();?>"><i class="pe-7s-home"></i> <?php echo display('site_view')?></a></li>
                <li class="active"><a href="<?php echo base_url();?>admin/Dashboard"><?php echo display('deashbord');?></a></li>
            </ol>
        </div>
    </section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
        <?php
            $mag = $this->session->flashdata('message');
            $errormessage = $this->session->flashdata('errormessage');
                if($mag!='') {
                    echo '<div class="alert alert-success alert-dismissable ">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            <strong>WOW!</strong>'.html_escape($mag).'
                        </div>';
                    $this->session->unset_userdata('message');
                }
                if($errormessage!='') {
                    echo '<div class="alert alert-block alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <p>'.html_escape($errormessage).'</p>
                    </div>';
                    $this->session->unset_userdata('errormessage');
                }
        ?>

            <div  class="panel panel-default ">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo display('change_password');?></h4>
                    </div>
                </div>
                
                <div class="panel-body">
                    <div class="portlet-body form">


                        <?php 
                            $attributes = array('class' => 'form-horizontal','role'=>'form');
                            echo form_open('admin/Setting_controller/change_password_save', $attributes);  
                        ?>
                            <div class="form-body">
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('old_password');?></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control "  name="old_password" required > 
                                     <span class="text-danger"><?php echo form_error('old_password'); ?> </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('new_password');?></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control " name="new_password" required > 
                                   <span class="text-danger"><?php echo form_error('new_password'); ?> </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('confirm_password');?></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control " name="confirm_password" required > 
                                    <span class="text-danger"><?php echo form_error('confirm_password'); ?> </span>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="form-actions text-right">
                                <button type="submit" class="text-right btn btn-success"><?php echo display('change');?></button>
                            </div>

                        <?php echo form_close()?>
                    </div>
                </div>
            </div>
        </div>
    </div>            
    </section>
</div>



