<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('emergency_stop_setup');?></h1>
            <small><?php echo display('emergency_stop_setup');?></small>
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
                        <h4><?php echo display('emergency_stop_setup');?></h4>
                    </div>
                </div>
                
                <div class="panel-body">
                    <div class="portlet-body form">
                    <?php 
                        $mag = $this->session->userdata('message');
                        if($mag){
                            echo htmlspecialchars_decode($mag);
                        }
                        $attributes = array('class' => 'form-horizontal','role'=>'form');
                         echo form_open('admin/Emergency_stop_controller/save_emergency_stop',$attributes);                
                    ?>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="text-danger">*</span><?php echo display('stop_date');?> :</label>
                                    <div class="col-md-7">
                                        <input type="text" value="" name="stop_date" class="form-control datepicker1" placeholder="<?php echo display('date_placeholder');?>" autocomplete="off" required="" >
                                            <?php echo form_error('stop_date', '<div class=" text-danger">', '</div>'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="text-danger">*</span><?php echo display('schedule_date');?> :</label>
                                    <div class="col-md-7">
                                        <input type="text" value="" name="schedul_date" placeholder="<?php echo display('date_placeholder');?>" class="form-control datepicker1" autocomplete="off" required="">
                                        <?php echo form_error('schedul_date', '<div class="  text-danger">', '</div>'); ?>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="text-danger">*</span><?php echo display('message');?> :</label>
                                    <div class="col-md-7">
                                         <textarea name="message" class="ckeditor form-control"  required=""></textarea>
                                         <?php echo form_error('message', '<div class="  text-danger">', '</div>'); ?>
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
    </div> <!-- /#page-wrapper -->            
    </section>
</div>







