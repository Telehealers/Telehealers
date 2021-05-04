<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('email_template');?></h1>
            <small><?php echo display('email_template');?></small>
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
                $msg = $this->session->flashdata('message');
                if($msg){
                    echo htmlspecialchars_decode($msg);
                } 
            ?>
            <div  class="panel panel-default panel-form">

                <div class="panel-heading ">
                    <div class="panel-title" >
                        <h4><?php echo display('email_template');?></h4>
                    </div>
                </div>

                
                <div class="panel-body">
                    <div class="portlet-body form">
                    
                    <?php 
                        $attributes = array('class' => 'form-horizontal','id' => 'MyForm','role'=>'form');
                        echo form_open_multipart('admin/email/Email/save_template', $attributes);  
                    ?>
                        
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><span class="text-danger">*</span><?php echo display('template_name');?> : </label>
                                <div class="col-md-10">
                                    <input type="text"  class="form-control" value="" required="1" name="template_name" placeholder="<?php echo display('template_name');?>">
                                </div>
                            </div> 

                            <div class="form-group">
                                <label class="col-md-2 control-label"><span class="text-danger">*</span><?php echo display('sms_template');?> : </label>
                                <div class="col-md-10">
                                     <textarea name="template" class="form-control" required="1" rows="6"></textarea>
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




