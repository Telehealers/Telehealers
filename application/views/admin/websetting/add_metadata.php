
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1>Add New</h1>
            <small>Add New</small>
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
                        <h4>Add New</h4>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="portlet-body form">
                        <?php 
                            $msg = $this->session->flashdata('message');
                              if($msg !=''){
                                  echo $msg;
                              }
                               if($this->session->flashdata('exception')!=""){
                                 echo $this->session->flashdata('exception');
                            }

                            $attributes = array('class' => 'form-horizontal','role'=>'form');
                            echo form_open_multipart('admin/metadata/save_post', $attributes);                
                         ?>
                        
                            <div class="form-body">
						<?php //echo "<pre>";print_r(services); ?>
								<div class="form-group">
                                    <label class="col-md-2 control-label"><span class="text-danger">*</span>Page : </label>
                                    <div class="col-md-10">
                                        <select name="page">
											<option>Home Page</option>
											<option>Appointment Page</option>
											<option>Contact Us Page</option>
										</select> 
                                        
                                    </div>
                                </div>
								

                                <div class="form-group">
                                    <label class="col-md-2 control-label"><span class="text-danger">*</span>Page Title: </label>
                                    <div class="col-md-10">
                                        <input type="text" name="page_title" class="form-control" value="<?php echo set_value('page_title'); ?>" placeholder="Title" required> 
                                        <span class="error-msg"><?php echo form_error('page_title'); ?> </span>
                                    </div>
                                </div>	

								<div class="form-group">
                                    <label class="col-md-2 control-label"><span class="text-danger">*</span>Meta Title : </label>
                                    <div class="col-md-10">
                                        <input type="text" name="meta_title" class="form-control" value="<?php echo set_value('meta_title'); ?>" placeholder="Title" required> 
                                        <span class="error-msg"><?php echo form_error('meta_title'); ?> </span>
                                    </div>
                                </div>		

								<div class="form-group">
                                    <label class="col-md-2 control-label"><span class="text-danger">*</span>Meta Keywords : </label>
                                    <div class="col-md-10">
                                        <input type="text" name="meta_keywords" class="form-control" value="<?php echo set_value('meta_keywords'); ?>" placeholder="Title" required> 
                                        <span class="error-msg"><?php echo form_error('meta_keywords'); ?> </span>
                                    </div>
                                </div>	

								<div class="form-group">
                                    <label class="col-md-2 control-label"><span class="text-danger">*</span>Meta Description : </label>
                                    <div class="col-md-10">
                                        <input type="text" name="meta_description" class="form-control" value="<?php echo set_value('meta_description'); ?>" placeholder="Title" required> 
                                        <span class="error-msg"><?php echo form_error('meta_description'); ?> </span>
                                    </div>
                                </div>									

																
						
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-offset-2 col-sm-6">
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
