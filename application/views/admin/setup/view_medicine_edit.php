<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('edit_medicine');?></h1>
            <small><?php echo display('edit_medicine');?></small>
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

                <div class="panel-heading ">
                    <div class="panel-title" >
                        <h4><?php echo display('edit_medicine');?></h4>
                    </div>
                </div>

                    <div class="panel-body">
                        <div class="portlet-body form">
                            <?php 
                              $msg = $this->session->flashdata('message');
                               if($msg){
                                   echo htmlspecialchars_decode($msg);
                               }
                                $attributes = array('class' => 'form-horizontal','role'=>'form');
                                echo form_open_multipart('admin/Setup_controller/save_edit_medicine', $attributes);                
                            ?>
                            
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="text-danger">*</span><?php echo display('medicine_name');?> :</label>
                                    <div class="col-md-5">
                                        <input type="text" name="medicine_name" class="form-control" value="<?php  echo $medicine->medicine_name; ?>" placeholder="<?php echo display('medicine_name');?>" required > 
                                        <?php echo form_error('medicine_name', '<div class=" text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php  echo html_escape($medicine->medicine_id);?>"> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('medicine_description');?> :</label>
                                    <div class="col-md-5">
                                         <textarea name="description"  class="form-control" rows="6"><?php  echo html_escape($medicine->med_description); ?></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="text-center">
                                <input type="submit" class="btn btn-primary" value="<?php echo display('update');?>">
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

